<!-- Razorpay Checkout Script (Include only once per page) -->
@once
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
// Global flag to prevent multiple simultaneous requests
let razorpayProcessing = false;

function initiateRazorpayPayment(packageId, type) {
    if (razorpayProcessing) {
        console.log('Payment already in progress');
        return;
    }
    
    razorpayProcessing = true;
    
    // Show loading state
    const button = event.target.closest('a');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    button.style.pointerEvents = 'none';
    
    console.log('Creating Razorpay order for package:', packageId, 'type:', type);
    
    // Create Razorpay order
    fetch("{{ route('razorpay.create.order') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            package_id: packageId,
            type: type
        })
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || 'Failed to create order');
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Order created successfully:', data);
        
        if (!data.success) {
            throw new Error(data.message || 'Failed to create order');
        }
        
        // Initialize Razorpay checkout
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": data.amount,
            "currency": data.currency,
            "name": data.name,
            "description": data.description,
            "order_id": data.order_id,
            "prefill": data.prefill,
            "theme": {
                "color": "#528FF0"
            },
            "handler": function (response) {
                console.log('Payment successful:', response);
                // Verify payment on server
                verifyRazorpayPayment(response, packageId, type);
            },
            "modal": {
                "ondismiss": function() {
                    console.log('Payment modal dismissed');
                    // Reset button state
                    button.innerHTML = originalText;
                    button.style.pointerEvents = 'auto';
                    razorpayProcessing = false;
                },
                "escape": true,
                "backdropdismiss": false
            }
        };
        
        var rzp = new Razorpay(options);
        
        rzp.on('payment.failed', function (response){
            console.error('Payment failed:', response.error);
            alert('Payment failed: ' + response.error.description);
            button.innerHTML = originalText;
            button.style.pointerEvents = 'auto';
            razorpayProcessing = false;
        });
        
        rzp.open();
        
        // Reset button state after opening modal
        button.innerHTML = originalText;
        button.style.pointerEvents = 'auto';
    })
    .catch(error => {
        console.error('Error creating order:', error);
        alert('Unable to process payment: ' + error.message);
        button.innerHTML = originalText;
        button.style.pointerEvents = 'auto';
        razorpayProcessing = false;
    });
}

function verifyRazorpayPayment(response, packageId, type) {
    console.log('Verifying payment...');
    
    // Show loading indicator
    const loadingDiv = document.createElement('div');
    loadingDiv.id = 'razorpay-loading';
    loadingDiv.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);display:flex;align-items:center;justify-content:center;z-index:9999;';
    loadingDiv.innerHTML = '<div style="background:white;padding:30px;border-radius:10px;text-align:center;"><i class="fas fa-spinner fa-spin fa-3x" style="color:#528FF0;"></i><p style="margin-top:15px;font-size:16px;font-weight:bold;">Verifying payment...</p><p style="margin-top:5px;color:#666;">Please do not close this window</p></div>';
    document.body.appendChild(loadingDiv);
    
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
            package_id: packageId,
            type: type
        })
    })
    .then(res => {
        console.log('Verification response status:', res.status);
        if (!res.ok) {
            return res.json().then(err => {
                throw new Error(err.message || 'Verification failed');
            });
        }
        return res.json();
    })
    .then(data => {
        console.log('Verification response:', data);
        
        const loading = document.getElementById('razorpay-loading');
        if (loading) {
            document.body.removeChild(loading);
        }
        
        razorpayProcessing = false;
        
        if (data.success) {
            // Close all modals
            document.querySelectorAll('.modal').forEach(modal => {
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                }
            });
            
            // Remove modal backdrops
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                backdrop.remove();
            });
            
            // Show success message
            alert('Payment successful! Redirecting...');
            
            // Redirect after a short delay
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 500);
        } else {
            alert('Payment verification failed: ' + (data.message || 'Please contact support.'));
        }
    })
    .catch(error => {
        console.error('Error verifying payment:', error);
        
        const loading = document.getElementById('razorpay-loading');
        if (loading) {
            document.body.removeChild(loading);
        }
        
        razorpayProcessing = false;
        
        alert('An error occurred during payment verification: ' + error.message + '\nPlease contact support with your payment ID: ' + response.razorpay_payment_id);
    });
}
</script>
@endonce