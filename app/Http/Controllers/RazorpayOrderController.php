<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Redirect;
use App\Package;
use Razorpay\Api\Api;
use App\Traits\CompanyPackageTrait;
use App\Traits\JobSeekerPackageTrait;
use App\Models\RazorpayTransaction;

class RazorpayOrderController extends Controller
{
    use CompanyPackageTrait;
    use JobSeekerPackageTrait;

    private $redirectTo = 'home';
    private $razorpayKey;
    private $razorpaySecret;

    public function __construct()
    {
        $this->razorpayKey = env('RAZORPAY_KEY');
        $this->razorpaySecret = env('RAZORPAY_SECRET');

        $this->middleware(function ($request, $next) {
            if (Auth::guard('company')->check()) {
                $this->redirectTo = 'company.home';
            }
            return $next($request);
        });
    }

    /** -------------------------------
     *  CREATE ORDER VIA AJAX
     *--------------------------------*/
    public function createOrderAjax(Request $request)
    {
        $request->validate([
            'package_id' => 'required|integer',
            'type' => 'required|string'
        ]);

        $package = Package::findOrFail($request->package_id);

        $buyer_id = '';
        $buyer_name = '';
        $buyer_email = '';

        if (Auth::guard('company')->check()) {
            $buyer_id = Auth::guard('company')->user()->id;
            $buyer_name = Auth::guard('company')->user()->name;
            $buyer_email = Auth::guard('company')->user()->email;
        } elseif (Auth::check()) {
            $buyer_id = Auth::user()->id;
            $buyer_name = Auth::user()->getName();
            $buyer_email = Auth::user()->email;
        }

        $api = new Api($this->razorpayKey, $this->razorpaySecret);

        try {
            $orderData = [
                'receipt' => 'order_' . $package->id . '_' . time(),
                'amount' => $package->package_price * 100,
                'currency' => 'INR',
                'notes' => [
                    'package_id' => $package->id,
                    'buyer_id' => $buyer_id,
                    'type' => $request->type
                ]
            ];

            $razorpayOrder = $api->order->create($orderData);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'key' => $this->razorpayKey,
                'package' => [
                    'id' => $package->id,
                    'title' => $package->package_title,
                    'price' => $package->package_price,
                ],
                'buyer' => [
                    'name' => $buyer_name,
                    'email' => $buyer_email,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to create Razorpay order: ' . $e->getMessage()
            ], 500);
        }
    }

    /** -------------------------------
     *  VERIFY PAYMENT AND ASSIGN PACKAGE
     *--------------------------------*/
    public function razorpayOrderPackage(Request $request)
    {
        try {
            $request->validate([
                'razorpay_payment_id' => 'required',
                'razorpay_order_id' => 'required',
                'razorpay_signature' => 'required',
                'package_id' => 'required',
                'type' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        try {
            $package = Package::findOrFail($request->package_id);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Package not found'
            ], 404);
        }

        $api = new Api($this->razorpayKey, $this->razorpaySecret);

        // Determine buyer details
        $buyer_id = null;
        $buyer_type = null;

        if (Auth::guard('company')->check()) {
            $buyer_id = Auth::guard('company')->user()->id;
            $buyer_type = 'App\Company'; // Adjust to your actual Company model namespace
        } elseif (Auth::check()) {
            $buyer_id = Auth::user()->id;
            $buyer_type = 'App\User'; // Adjust to your actual User model namespace
        }

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            // Verify payment signature
            $api->utility->verifyPaymentSignature($attributes);

            // Fetch payment details from Razorpay
            $payment = $api->payment->fetch($request->razorpay_payment_id);

            // Store transaction in database
            $transaction = RazorpayTransaction::create([
                'paid_for_id' => $buyer_id,
                'paid_for_type' => $buyer_type,
                'order_id' => $request->razorpay_order_id,
                'payment_id' => $request->razorpay_payment_id,
                'gateway' => 'razorpay',
                'body' => json_encode([
                    'package_id' => $package->id,
                    'package_title' => $package->package_title,
                    'package_price' => $package->package_price,
                    'type' => $request->type,
                    'amount' => $payment->amount / 100,
                    'currency' => $payment->currency,
                    'method' => $payment->method ?? null,
                ]),
                'destination' => $payment->email ?? null,
                'signature' => $request->razorpay_signature,
                'response' => json_encode($payment->toArray()),
                'status' => 'captured',
                'verified_at' => now(),
            ]);

            // Handle package assignment
            if (Auth::guard('company')->check()) {
                $company = Auth::guard('company')->user();
                $this->handleCompanyPackage($company, $package, $request->type);
            } elseif (Auth::check()) {
                $user = Auth::user();
                $this->handleJobSeekerPackage($user, $package, $request->type);
            }

            return response()->json([
                'success' => true,
                'redirect' => route($this->redirectTo),
                'transaction_id' => $transaction->id
            ]);

        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            \Log::error('Payment signature verification failed: ' . $e->getMessage());
            
            // Store failed transaction
            RazorpayTransaction::create([
                'paid_for_id' => $buyer_id,
                'paid_for_type' => $buyer_type,
                'order_id' => $request->razorpay_order_id,
                'payment_id' => $request->razorpay_payment_id,
                'gateway' => 'razorpay',
                'signature' => $request->razorpay_signature,
                'status' => 'failed',
                'response' => json_encode(['error' => $e->getMessage()]),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed. Please contact support.'
            ], 400);

        } catch (\Exception $e) {
            \Log::error('Payment processing error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed: ' . $e->getMessage()
            ], 400);
        }
    }

    private function handleCompanyPackage($company, $package, $type)
    {
        if ($package->package_for == 'cv_search') {
            if ($type == 'new') {
                $this->addCompanySearchPackage($company, $package, 'Razorpay');
            } else {
                $this->updateCompanySearchPackage($company, $package, 'Razorpay');
            }
        } else {
            if ($type == 'new') {
                $this->addCompanyPackage($company, $package, 'Razorpay');
            } else {
                $this->updateCompanyPackage($company, $package, 'Razorpay');
            }
        }
    }

    private function handleJobSeekerPackage($user, $package, $type)
    {
        if ($type == 'new') {
            $this->addJobSeekerPackage($user, $package);
        } else {
            $this->updateJobSeekerPackage($user, $package);
        }
    }

    /** -------------------------------
     *  FALLBACK VERIFY ENDPOINT
     *--------------------------------*/
    public function verifyRazorpayPayment(Request $request)
    {
        return $this->razorpayOrderPackage($request);
    }

    /** -------------------------------
     *  OLD FORM (OPTIONAL BACKUP)
     *--------------------------------*/
    public function razorpayOrderForm(Request $request, $package_id, $new_or_upgrade)
    {
        $package = Package::findOrFail($package_id);
        $buyer_name = Auth::check() ? Auth::user()->name : '';
        $buyer_email = Auth::check() ? Auth::user()->email : '';
        $api = new Api($this->razorpayKey, $this->razorpaySecret);
        $orderData = [
            'receipt' => 'order_' . $package_id . '_' . time(),
            'amount' => $package->package_price * 100,
            'currency' => 'INR'
        ];
        $razorpayOrder = $api->order->create($orderData);
        $razorpayOrderId = $razorpayOrder['id'];

        return view('razorpay.order_form', compact('package', 'razorpayOrderId', 'buyer_name', 'buyer_email', 'new_or_upgrade'));
    }
}