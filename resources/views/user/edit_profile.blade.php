@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('My Profile')]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <div class="row">
            @include('includes.user_dashboard_menu')

            <div class="col-md-9 col-sm-8"> 
              
                        <div class="userccount">
                            <div class="formpanel mt0"> @include('flash::message') 
                                <!-- Personal Information -->
                                @include('user.inc.profile')                              
                            </div>
                        </div>
						
						<div class="userccount">
                            <div class="formpanel mt0">
                                @include('user.inc.summary')                                
                            </div>
                        </div>
						
						 
            </div>
        </div>
    </div>  
</div>
@include('includes.footer')
@endsection
@push('styles')
<style type="text/css">
    .userccount p{ text-align:left !important;}
</style>
@endpush
@push('scripts')
@include('includes.immediate_available_btn')

<script>
    $(document).on('click', '.btn-close', function() {
        $('.modal').css('display','none');
        $('.modal-backdrop').remove();
        $('.modal').removeAttr('style');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $('body').removeAttr('style');    
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userNameField = document.getElementById('user_name');
    const statusField = document.getElementById('user_name_status');
    const updateBtn = document.querySelector('button[type="submit"]');

    let typingTimer;
    const delay = 400; // ms delay after typing stops

    userNameField.addEventListener('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(checkUserName, delay);
    });

    function checkUserName() {
        const userName = userNameField.value.trim();
        if (!userName) {
            statusField.textContent = '';
            updateBtn.disabled = false;
            return;
        }

        fetch(`{{ route('check.username') }}?user_name=${encodeURIComponent(userName)}`)
            .then(res => res.json())
            .then(data => {
                if (data.available) {
                    statusField.textContent = '✅ Username available';
                    statusField.style.color = 'green';
                    updateBtn.disabled = false;
                } else {
                    statusField.textContent = '❌ Username already taken';
                    statusField.style.color = 'red';
                    updateBtn.disabled = true;
                }
            });
    }
});
</script>


@endpush