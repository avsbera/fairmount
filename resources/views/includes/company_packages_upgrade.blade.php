<div class="paypackages">
    <div class="four-plan">
        <h3>{{ __('Upgrade Your Job Package') }}</h3>
        <div class="row">
            @foreach($packages as $package)
                @if($package->package_price > 0)
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="boxes">
                        <li class="plan-name">{{ $package->package_title }}</li>
                        <li>
                            <div class="main-plan">
                                <div class="plan-price1-1">{{ $siteSetting->default_currency_code }}</div>
                                <div class="plan-price1-2">{{ $package->package_price }}</div>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                        <li class="plan-pages"><i class="far fa-check-square"></i> {{ __('Job Posting') }} {{ $package->package_num_listings }}</li>
                        <li class="plan-pages"><i class="far fa-check-square"></i> {{ __('Job Displayed for') }} {{ $package->package_num_days }} {{ __('Days') }}</li>
                        <li class="plan-pages"><i class="far fa-check-square"></i> {{ __('Highlights jobs on Demand') }}</li>
                        <li class="plan-pages"><i class="far fa-check-square"></i> {{ __('Premium Support 24/7') }}</li>

                        <li class="order razorpay">
                            <a href="javascript:void(0)" 
                               data-bs-toggle="modal" 
                               data-bs-target="#upgradePack{{ $package->id }}" 
                               class="reqbtn">
                               {{ __('Upgrade Now') }} <i class="fas fa-arrow-right"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Razorpay Modal -->
                    <div class="modal fade" id="upgradePack{{ $package->id }}" tabindex="-1" aria-labelledby="upgradePackLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('Upgrade Package') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="invitereval text-center">
                                        <h4>{{ __('Select Payment Method') }}</h4>
                                        <div class="totalpay">
                                            {{ __('Total to Pay:') }}
                                            <strong>{{ $siteSetting->default_currency_code }}{{ $package->package_price }}</strong>
                                        </div>
                                        <ul class="btn2s mt-3">
                                            <li class="order razorpay p-2">
                                                <button type="button" class="razorpay-btn"
                                                    data-id="{{ $package->id }}"
                                                    data-type="upgrade"
                                                    data-title="{{ $package->package_title }}"
                                                    data-price="{{ $package->package_price }}">
                                                    <i class="fas fa-credit-card"></i> {{ __('Pay with Razorpay') }}
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Razorpay Modal -->
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<!-- Razorpay Loader -->
<div id="razorpay-loader" style="display:none;">
    <div class="loader-overlay">
        <div class="spinner"></div>
        <div class="loader-text">Processing, please wait...</div>
    </div>
</div>

<style>
.btn2s .order.razorpay button {
    background: #528FF0;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}
.btn2s .order.razorpay button:hover {
    background: #3d7dd6;
}

/* Loader Styles */
#razorpay-loader {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}
.loader-overlay {
    text-align: center;
    color: white;
}
.spinner {
    border: 5px solid rgba(255, 255, 255, 0.3);
    border-top: 5px solid #fff;
    border-radius: 50%;
    width: 50px; height: 50px;
    margin: 0 auto 10px;
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
.loader-text {
    font-size: 16px;
    font-weight: 500;
}
</style>

<!-- Razorpay Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.razorpay-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            let packageId = this.dataset.id;
            let type = this.dataset.type;
            let loader = document.getElementById('razorpay-loader');

            // Show loader
            loader.style.display = 'flex';

            // Create Razorpay order
            fetch("{{ route('razorpay.create.order') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ package_id: packageId, type: type })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    loader.style.display = 'none';
                    alert(data.message || 'Order creation failed.');
                    return;
                }

                let options = {
                    "key": data.key,
                    "amount": data.package.price * 100,
                    "currency": "INR",
                    "name": "{{ config('app.name') }}",
                    "description": data.package.title,
                    "order_id": data.order_id,
                    "prefill": {
                        "name": data.buyer.name,
                        "email": data.buyer.email
                    },
                    "theme": { "color": "#528FF0" },
                    "handler": function (response) {
                        // Verify payment
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
                                package_id: data.package.id,
                                type: type
                            })
                        })
                        .then(res => res.json())
                        .then(resp => {
                            loader.style.display = 'none';
                            if (resp.success) {
                                window.location.href = resp.redirect;
                            } else {
                                alert('Payment verification failed.');
                            }
                        })
                        .catch(err => {
                            loader.style.display = 'none';
                            alert('Error verifying payment: ' + err);
                        });
                    },
                    "modal": {
                        "ondismiss": function() {
                            loader.style.display = 'none';
                            alert('Payment cancelled.');
                        }
                    }
                };

                loader.style.display = 'none';
                let rzp = new Razorpay(options);
                rzp.open();
            })
            .catch(err => {
                loader.style.display = 'none';
                alert('Error creating order: ' + err);
            });
        });
    });
});
</script>
