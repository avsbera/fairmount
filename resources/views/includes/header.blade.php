<div class="header" id="siteheader">
    <div class="container">
        <div>
            <div class="row">

                <!-- Nav start -->
                <nav class="navbar navbar-expand-lg navbar-light">
                  <div class="container d-flex align-items-center nav-3col">

                    <!-- LEFT: brand -->
                    <a class="navbar-brand py-0" href="{{ url('/') }}">
                      <img src="{{ asset('/') }}sitesetting_images/thumb/{{ $siteSetting->site_logo }}"
                          alt="{{ $siteSetting->site_name }}" style="height:40px;">
                    </a>

                    <!-- mobile toggler -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                            aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- CENTER + RIGHT collapse -->
                    <div class="collapse navbar-collapse flex-lg-row" id="mainNav">

                    <div class="d-lg-none text-end w-100 mb-2">
                        <button type="button" class="btn-close" aria-label="Close" data-bs-toggle="collapse" data-bs-target="#mainNav"></button>
                    </div>

                      <!-- CENTER: primary nav -->
                      <ul class="navbar-nav nav-center mx-lg-auto my-2 my-lg-0">
                        <li class="nav-item {{ Request::url() == route('index') ? 'active' : '' }}">
                          <a href="{{ url('/') }}" class="nav-link">Home</a>
                        </li>

                        @if(Auth::guard('company')->check())
                          <li class="nav-item {{ Request::url() == url('/job-seekers') ? 'active' : '' }}">
                            <a href="{{ url('/job-seekers') }}" class="nav-link">Browse Jobs</a>
                          </li>
                        @else
                          <li class="nav-item {{ Request::url() == url('/search-jobs') ? 'active' : '' }}">
                            <a href="{{ url('/search-jobs') }}" class="nav-link">Browse Jobs</a>
                          </li>
                        @endif

                        <li class="nav-item {{ Request::url() == url('/pricing') ? 'active' : '' }}">
                          <a href="{{ url('/pricing') }}" class="nav-link">Pricing</a>
                        </li>
                        <li class="nav-item {{ Request::url() == route('blogs') ? 'active' : '' }}">
                          <a href="{{ route('blogs') }}" class="nav-link">News</a>
                        </li>
                        <li class="nav-item {{ Request::url() == route('contact.us') ? 'active' : '' }}">
                          <a href="{{ route('contact.us') }}" class="nav-link">Contact Us</a>
                        </li>
                      </ul>

                      <!-- RIGHT: auth -->
                      <ul class="navbar-nav auth-nav ms-lg-0">
                        @if(Auth::check() && !Auth::guard('company')->check())
                          <li class="nav-item dropdown userbtn">
                            <a href="#" class="nav-link p-0" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ Auth::user()->printUserImage() }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                              <li><a href="{{ route('home') }}" class="dropdown-item"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                              <li><a href="{{ route('my.profile') }}" class="dropdown-item"><i class="fa fa-user"></i> My Profile</a></li>
                              <li><a href="{{ route('view.public.profile', Auth::user()->id) }}" class="dropdown-item"><i class="fa fa-eye"></i> View Public Profile</a></li>
                              <li><a href="{{ route('my.job.applications') }}" class="dropdown-item"><i class="fa fa-desktop"></i> My Job Applications</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                  onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                  <i class="fa fa-sign-out"></i> Logout
                                </a>
                              </li>
                            </ul>
                            <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display:none;">{{ csrf_field() }}</form>
                          </li>

                        @elseif(Auth::guard('company')->check())
                          <li class="nav-item me-2">
                            <a href="{{ route('post.job') }}" class="btn btn-primary btn-sm rounded-pill px-3">Post a job</a>
                          </li>
                          <li class="nav-item dropdown userbtn">
                            <a href="#" class="nav-link p-0" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ Auth::guard('company')->user()->printCompanyImage() }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                              <li><a href="{{ route('company.home') }}" class="dropdown-item"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                              <li><a href="{{ route('company.profile') }}" class="dropdown-item"><i class="fa fa-user"></i> Company Profile</a></li>
                              <li><a href="{{ route('post.job') }}" class="dropdown-item"><i class="fa fa-desktop"></i> Post Job</a></li>
                              <li><a href="{{ route('company.messages') }}" class="dropdown-item"><i class="fa fa-envelope"></i> Company Messages</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li>
                                <a href="{{ route('company.logout') }}" class="dropdown-item"
                                  onclick="event.preventDefault(); document.getElementById('logout-form-header1').submit();">
                                  <i class="fa fa-sign-out"></i> Logout
                                </a>
                              </li>
                            </ul>
                            <form id="logout-form-header1" action="{{ route('company.logout') }}" method="POST" style="display:none;">{{ csrf_field() }}</form>
                          </li>

                        @else
                          <li class="nav-item auth-login"><a href="javascript:void(0)" class="nav-link fw-semibold" data-bs-toggle="modal" data-bs-target="#headlogin">Login</a></li>
                          <li class="nav-item auth-register"><a href="javascript:void(0)" class="nav-link fw-semibold" data-bs-toggle="modal" data-bs-target="#headregister">Register</a></li>
                        @endif
                      </ul>
                    </div>
                  </div>
                </nav>


                <!-- Nav end -->

            </div>
        </div>

        <!-- row end -->

    </div>

    <!-- Header container end -->

</div>






<?php /*?> ?>@if (!Auth::user() && !Auth::guard('company')->user())
    <div class="">my dive 2</div>
@endif<?php */?>




<!-- Login -->
<div class="modal fade mypremodal" id="headlogin" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-body">
                <div class="preuserinfo">
                    <h3>Login as</h3>
                    <a href="{{ route('login') }}" class="btn btn-yellow mt-3">Job Seeker</a>
                    <a href="{{ url('company-login') }}" class="btn btn-dark mt-3">Company</a>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Register -->
<div class="modal fade mypremodal" id="headregister" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-body">
                <div class="preuserinfo p-2 pb-4">
                    <h3>Register as a</h3>
                    <a href="{{ route('register') }}" class="btn btn-yellow mt-3">Job Seeker</a>
                    <a href="{{ url('company-register') }}" class="btn btn-dark mt-3">Company</a>
                </div>
            </div>

        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade mypremodal" id="preresume" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-body">
                <div class="preuserinfo">
                    <h3>Login or register to create your Resume/CV</h3>
                    <a href="{{ route('login') }}" class="btn btn-yellow mt-3">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-dark mt-3">Register</a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade mypremodal" id="prejobpost" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-body">
                <div class="preuserinfo ps-0 pe-0">
                    <h3>{{ __('Welcome to Employer Portal') }}</h3>
                    <p>Earn our user's trust. Get your account approved to start posting jobs</p>

                    @if (!Auth::user() && !Auth::guard('company')->user())
                        <a href="{{ url('company-login') }}" class="btn btn-yellow mt-3">Login</a>
                        <a href="{{ url('company-register') }}" class="btn btn-dark mt-3">Register</a>
                    @endif




                </div>
            </div>

        </div>
    </div>
</div>


<div class="mobilenav">
    <ul>
        <li><a href="{{ url('/') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                    fill="#5f6368">
                    <path
                        d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
                </svg>
                <span>Home</span>
            </a></li>


        @if (Auth::guard('company')->check())
            <li>
                <a href="{{ url('/job-seekers') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                        fill="#5f6368">
                        <path
                            d="M160-120q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720h160v-80q0-33 23.5-56.5T400-880h160q33 0 56.5 23.5T640-800v80h160q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160Zm0-80h640v-440H160v440Zm240-520h160v-80H400v80ZM160-200v-440 440Z" />
                    </svg>
                    <span>Talent</span>
                </a>
            </li>
        @else
            <li>
                <a href="{{ url('/search-jobs') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                        fill="#5f6368">
                        <path
                            d="M160-120q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720h160v-80q0-33 23.5-56.5T400-880h160q33 0 56.5 23.5T640-800v80h160q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160Zm0-80h640v-440H160v440Zm240-520h160v-80H400v80ZM160-200v-440 440Z" />
                    </svg>
                    <span>Jobs</span>
                </a>
            </li>
        @endif




        @if (!Auth::user() && !Auth::guard('company')->user())
            <li>
                <a href="{{ url('/companies') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                        fill="#5f6368">
                        <path
                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                    </svg>
                    <span>Companies</span>
                </a>
            </li>


            <li>
                <a href="javascript:void();" data-bs-toggle="modal" data-bs-target="#headlogin">
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                        fill="#5f6368">
                        <path
                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                    </svg>
                    <span>Login</span>
                </a>
            </li>
        @endif



        @if (Auth::check() && !Auth::guard('company')->check())
            <li>
                <a href="{{ route('my.messages') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                        fill="#5f6368">
                        <path
                            d="M880-80 720-240H320q-33 0-56.5-23.5T240-320v-40h440q33 0 56.5-23.5T760-440v-280h40q33 0 56.5 23.5T880-640v560ZM160-473l47-47h393v-280H160v327ZM80-280v-520q0-33 23.5-56.5T160-880h440q33 0 56.5 23.5T680-800v280q0 33-23.5 56.5T600-440H240L80-280Zm80-240v-280 280Z" />
                    </svg>
                    <span>Messages</span>
                </a>
            </li>
            <li>
                <a href="javascript:void();" class="openmbnav">
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                        fill="#5f6368">
                        <path
                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                    </svg>
                    <span>User</span>
                </a>
            </li>
        @elseif(Auth::guard('company')->check())
            <li>
                <a href="{{ route('company.messages') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                        fill="#5f6368">
                        <path
                            d="M880-80 720-240H320q-33 0-56.5-23.5T240-320v-40h440q33 0 56.5-23.5T760-440v-280h40q33 0 56.5 23.5T880-640v560ZM160-473l47-47h393v-280H160v327ZM80-280v-520q0-33 23.5-56.5T160-880h440q33 0 56.5 23.5T680-800v280q0 33-23.5 56.5T600-440H240L80-280Zm80-240v-280 280Z" />
                    </svg>
                    <span>Messages</span>
                </a>
            </li>
            <li>
                <a href="javascript:void();" class="openmbnav">
                    <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px"
                        fill="#5f6368">
                        <path
                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
        @endif




    </ul>
</div>








@if (Auth::check() && !Auth::guard('company')->check())
    <ul class="usernavdash" id="usermbnav">
        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"><i class="fa fa-tachometer"
                    aria-hidden="true"></i> {{ __('Dashboard') }}</a> </li>
        <li class="nav-item"><a href="{{ route('my.profile') }}" class="nav-link"><i class="fa fa-user"
                    aria-hidden="true"></i> {{ __('My Profile') }}</a> </li>
        <li class="nav-item"><a href="{{ route('view.public.profile', Auth::user()->id) }}" class="nav-link"><i
                    class="fa fa-eye" aria-hidden="true"></i> {{ __('View Public Profile') }}</a> </li>
        <li><a href="{{ route('my.job.applications') }}" class="nav-link"><i class="fa fa-desktop"
                    aria-hidden="true"></i> {{ __('My Job Applications') }}</a> </li>
        <li class="nav-item"><a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();"
                class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}</a> </li>
        <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </ul>
@elseif(Auth::guard('company')->check())
    <ul class="usernavdash" id="usermbnav">
        <li class="nav-item"><a href="{{ route('company.home') }}" class="nav-link"><i class="fa fa-tachometer"
                    aria-hidden="true"></i> {{ __('Dashboard') }}</a> </li>
        <li class="nav-item"><a href="{{ route('company.profile') }}" class="nav-link"><i class="fa fa-user"
                    aria-hidden="true"></i> {{ __('Company Profile') }}</a></li>
        <li class="nav-item"><a href="{{ route('post.job') }}" class="nav-link"><i class="fa fa-desktop"
                    aria-hidden="true"></i> {{ __('Post Job') }}</a></li>

        <li class="nav-item"><a href="{{ route('posted.jobs') }}" class="nav-link"><i class="fab fa-black-tie"></i>
                {{ __('Manage Jobs') }}</a></li>

        <li class="nav-item"><a href="{{ route('company.packages') }}" class="nav-link"><i class="fas fa-search"
                    aria-hidden="true"></i> {{ __('CV Search Packages') }}</a></li>

        <li class="nav-item"><a href="{{ url('/list-payment-history') }}" class="nav-link"><i
                    class="fas fa-file-invoice"></i> {{ __('Payment History') }}</a></li>

        <li class="nav-item"><a href="{{ route('company.unloced-users') }}" class="nav-link"><i class="fas fa-user"
                    aria-hidden="true"></i> {{ __('Unlocked Users') }}</a></li>
        <li class="nav-item"><a href="{{ route('company.followers') }}" class="nav-link"><i class="fas fa-users"
                    aria-hidden="true"></i> {{ __('Company Followers') }}</a></li>


        <li class="nav-item"><a href="{{ route('company.logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form-header1').submit();"
                class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> {{ __('Logout') }}</a> </li>
        <form id="logout-form-header1" action="{{ route('company.logout') }}" method="POST"
            style="display: none;">
            {{ csrf_field() }}
        </form>
    </ul>
@endif
