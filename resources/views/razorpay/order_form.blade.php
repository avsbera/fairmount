<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Razorpay Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: #f5f5f5;
        }
        .payment-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }
        .payment-details {
            margin-bottom: 20px;
        }
        .payment-details h2 {
            margin: 0 0 20px 0;
            color: #333;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            font-weight: bold;
            color: #666;
        }
        .detail-value {
            color: #333;
        }
        .pay-button {
            width: 100%;
            padding: 15px;
            background: #528FF0;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }
        .pay-button:hover {
            background: #3d7dd6;
        }
        .razorpay-logo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <div class="razorpay-logo">
            <h2>Razorpay Payment</h2>
        </div>
        
        <div class="payment-details">
            <div class="detail-row">
                <span class="detail-label">Package:</span>
                <span class="detail-value">{{ $package->package_title }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Amount:</span>
                <span class="detail-value">₹{{ $package->package_price }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Job Postings:</span>
                <span class="detail-value">{{ $package->package_num_listings }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Duration:</span>
                <span class="detail-value">{{ $package->package_num_days }} Days</span>
            </div>
        </div>

        <button id="rzp-button" class="pay-button">Pay Now</button>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": "{{ $package->package_price * 100 }}", // Amount in paise
            "currency": "INR",
            "name": "{{ config('app.name') }}",
            "description": "{{ $package->package_title }}",
            "order_id": "{{ $razorpayOrderId }}",
            "prefill": {
                "name": "{{ $buyer_name }}",
                "email": "{{ $buyer_email }}"
            },
            "theme": {
                "color": "#528FF0"
            },
            "handler": function (response) {
                // Send payment details to server for verification
                fetch("{{ route('razorpay.order.package') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature,
                        package_id: "{{ $package->id }}",
                        type: "{{ $new_or_upgrade }}"
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        alert('Payment verification failed. Please contact support.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please contact support.');
                });
            },
            "modal": {
                "ondismiss": function() {
                    alert('Payment cancelled');
                    window.location.href = "{{ route($redirectTo ?? 'home') }}";
                }
            }
        };

        var rzp = new Razorpay(options);
        
        document.getElementById('rzp-button').onclick = function(e) {
            e.preventDefault();
            rzp.open();
        }
    </script>
</body>
</html>