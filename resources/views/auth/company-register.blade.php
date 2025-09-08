@extends('layouts.app')

@section('content') 

<!-- Header start --> 

@include('includes.header') 

<!-- Header end --> 



<section class="register_background">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="register_outsectionn">
          <div class="row">
            <!-- Left Side -->
            <div class="col-lg-7">
              <div class="register_leftoutsection"></div>
            </div>

            <!-- Right Side -->
            <div class="col-lg-5">
              <div class="register_rightoutsection">
                <div class="register_rightoutsection1">

                  {{-- Flash Messages --}}
                  @include('flash::message')

                  <h1 class="ryac_txetdesign">{{ __('Register as an Employer') }}</h1>

                  {{-- Employer Register Form --}}
                  <form method="POST" action="{{ route('company.register') }}" class="mt-3">
                      @csrf
                      <input type="hidden" name="candidate_or_employer" value="employer" />

                      {{-- Name --}}
                      <input type="text" name="name" value="{{ old('name') }}"
                             class="input_flddesign @error('name') is-invalid @enderror"
                             placeholder="{{ __('Name') }}" required>
                      @error('name') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Email --}}
                      <input type="email" name="email" value="{{ old('email') }}"
                             class="input_flddesign @error('email') is-invalid @enderror"
                             placeholder="{{ __('Email') }}" required>
                      @error('email') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Password --}}
                      <input type="password" name="password"
                             class="input_flddesign @error('password') is-invalid @enderror"
                             placeholder="{{ __('Password') }}" required>
                      @error('password') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Password Confirmation --}}
                      <input type="password" name="password_confirmation"
                             class="input_flddesign @error('password_confirmation') is-invalid @enderror"
                             placeholder="{{ __('Password Confirmation') }}" required>
                      @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Subscribe to Newsletter --}}
                      @php
                        $is_checked = old('is_subscribed', 1) ? 'checked' : '';
                      @endphp
                      <div class="form-check mb-2">
                          <input type="checkbox" name="is_subscribed" value="1"
                                 class="form-check-input" {{ $is_checked }}>
                          <label class="form-check-label">{{ __('Subscribe to Newsletter') }}</label>
                      </div>
                      @error('is_subscribed') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Terms of Use --}}
                      <div class="form-check mb-3">
                          <input type="checkbox" name="terms_of_use" value="1"
                                 class="form-check-input">
                          <label class="form-check-label">
                              <a href="{{ url('cms/terms-of-use') }}">{{ __('I accept Terms of Use') }}</a>
                          </label>
                      </div>
                      @error('terms_of_use') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- reCAPTCHA --}}
                      <div class="form-group text-center mb-3 @error('g-recaptcha-response') has-error @enderror">
                          {!! app('captcha')->display() !!}
                          @error('g-recaptcha-response')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      {{-- Submit --}}
                      <div class="hbtn_designarea">
                          <button class="jhbtn_hdesign" type="submit">
                              <span>{{ __('Register') }}</span>
                          </button>
                      </div>
                  </form>

                  {{-- Already have account --}}
                  <div class="newuser">
                    <i class="fa fa-user"></i> {{ __('Have Account?') }}
                    <a href="{{ url('company-login') }}">{{ __('Sign in') }}</a>
                  </div>

                </div> <!-- register_rightoutsection1 -->
              </div>
            </div> <!-- Right Side -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('includes.footer')

@endsection 