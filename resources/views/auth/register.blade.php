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

                  <h1 class="ryac_txetdesign">{{ __('Register as a Candidate') }}</h1>

                  <form method="POST" action="{{ route('register') }}" class="mt-3">
                      @csrf
                      <input type="hidden" name="candidate_or_employer" value="candidate" />

                      {{-- First Name --}}
                      <input placeholder="{{ __('First Name') }}" name="first_name" type="text"
                             class="input_flddesign @error('first_name') is-invalid @enderror"
                             value="{{ old('first_name') }}" required>
                      @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Last Name --}}
                      <input placeholder="{{ __('Last Name') }}" name="last_name" type="text"
                             class="input_flddesign @error('last_name') is-invalid @enderror"
                             value="{{ old('last_name') }}" required>
                      @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Email --}}
                      <input placeholder="{{ __('Email') }}" name="email" type="email"
                             class="input_flddesign @error('email') is-invalid @enderror"
                             value="{{ old('email') }}" required>
                      @error('email') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Password --}}
                      <input placeholder="{{ __('Password') }}" name="password" type="password"
                             class="input_flddesign @error('password') is-invalid @enderror"
                             required>
                      @error('password') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Confirm Password --}}
                      <input placeholder="{{ __('Confirm Password') }}" name="password_confirmation" type="password"
                             class="input_flddesign @error('password_confirmation') is-invalid @enderror"
                             required>
                      @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Subscribe to Newsletter --}}
                      <label class="iatct_textdesign">
                          <input type="checkbox" name="is_subscribed" value="1"
                                 {{ old('is_subscribed', 1) ? 'checked' : '' }}>
                          {{ __('Subscribe to Newsletter') }}
                      </label>
                      @error('is_subscribed') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- Accept Terms --}}
                      <label class="iatct_textdesign">
                          <input type="checkbox" name="terms_of_use" value="1" required>
                          <a href="{{ url('cms/terms-of-use') }}" target="_blank">
                              {{ __('I accept Terms of Use') }}
                          </a>
                      </label>
                      @error('terms_of_use') <div class="text-danger">{{ $message }}</div> @enderror

                      {{-- reCAPTCHA --}}
                      <div class="form-group mb-3 @error('g-recaptcha-response') is-invalid @enderror">
                          {!! app('captcha')->display() !!}
                          @error('g-recaptcha-response') <div class="text-danger">{{ $message }}</div> @enderror
                      </div>

                      {{-- Submit Button --}}
                      <div class="hbtn_designarea">
                          <button class="jhbtn_hdesign" type="submit">
                              <span>{{ __('Register') }}</span>
                          </button>
                      </div>
                  </form>

                  {{-- Already have account --}}
                  <a href="{{ route('login') }}" class="fwrd_txetdesign">
                    {{ __('Have an Account? Sign in') }}
                  </a>

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