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

                  <h1 class="ryac_txetdesign">{{ __('Candidate Login') }}</h1>

                  {{-- Social Login --}}
                  <div class="socialLogin">
                      <a href="{{ url('login/jobseeker/google')}}" class="gp"><i class="fa-brands fa-google"></i></a>
                      <a href="{{ url('login/jobseeker/facebook')}}" class="fb"><i class="fab fa-facebook"></i></a>
                      <a href="{{ url('login/jobseeker/twitter')}}" class="tw">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                          <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path>
                        </svg>
                      </a>
                  </div>

                  <div class="divider-text-center"><span>{{ __('Or login with your account') }}</span></div>

                  {{-- Login Form --}}
                  <form method="POST" action="{{ route('login') }}">
                      @csrf
                      <input type="hidden" name="candidate_or_employer" value="candidate" />

                      <input placeholder="{{ __('Email Address') }}" 
                             id="email" type="email" name="email" 
                             class="input_flddesign @error('email') is-invalid @enderror"
                             value="{{ old('email') }}" required autofocus>
                      @error('email') <div class="text-danger">{{ $message }}</div> @enderror

                      <input placeholder="{{ __('Password') }}" 
                             id="password" type="password" name="password" 
                             class="input_flddesign @error('password') is-invalid @enderror" 
                             required>
                      @error('password') <div class="text-danger">{{ $message }}</div> @enderror

                      <div class="mb-3">
                          <i class="fas fa-lock"></i> {{ __('Forgot Your Password?') }} 
                          <a href="{{ route('password.request') }}">{{ __('Click here') }}</a>
                      </div>

                      <div class="hbtn_designarea">
                          <button class="jhbtn_hdesign" type="submit">
                              <span>{{ __('Login') }}</span>
                          </button>
                      </div>
                  </form>

                  {{-- Register Link --}}
                  <div class="newuser">
                    <i class="fa fa-user"></i> {{ __('New User?') }} 
                    <a href="{{ route('register') }}">{{ __('Register Here') }}</a>
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
