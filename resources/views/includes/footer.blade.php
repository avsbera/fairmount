      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12 footerdf_outsection" style="margin: 0 !important;">
                  <div class="footerdf_outsection1">
                      <div class="container">
                          <div class="row">
                              <div class="col-lg-4">
                                  <div class="footerleft_jxoutsection">
                                      <a href="/">
                                          <img src="https://fairmount.haasil.in/frontend/images/Fair_Mount_Logo.png" class="footerdxlogo_design">
                                      </a>
                                      <p class="gjfooterp_textdesign">
                                          It is a long established fact that a reader will be distracted by the readable
                                          content of a page when looking at its layout. The point of using Lorem Ipsum
                                          is that it has a more-or-less normal distribution of letters, as opposed to
                                          using 'Content here, content here', making it look like readable English.
                                      </p>
                                      <ul class="gfootersocial_plnkarea">
                                          <li>
                                              <a href="#">
                                                  <i class="fa-brands fa-facebook-f"></i>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="#">
                                                  <i class="fa-brands fa-x-twitter"></i>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="#">
                                                  <i class="fa-brands fa-linkedin-in"></i>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="#">
                                                  <i class="fa-brands fa-youtube"></i>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="#">
                                                  <i class="fa-brands fa-instagram"></i>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="#">
                                                  <i class="fa-brands fa-pinterest-p"></i>
                                              </a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                              <div class="col-lg-3">
                                <div class="footermidfc_jxoutsection">
                                    <h2 class="ulinks_outsection">{{__('Quick Links')}}</h2>
                                    <!--Quick Links menu Start-->
                                    <ul class="footer_gulnksj">
                                        <li><a href="{{ route('index') }}"><i class="fa-solid fa-chevron-right"></i>{{__('Home')}}</a></li>
                                        <li><a href="{{ route('contact.us') }}"><i class="fa-solid fa-chevron-right"></i>{{__('Contact Us')}}</a></li>
                                        <li class="postad"><a href="{{ route('post.job') }}"><i class="fa-solid fa-chevron-right"></i>{{__('Post a Job')}}</a></li>
                                        <li><a href="{{ route('faq') }}"><i class="fa-solid fa-chevron-right"></i>{{__('FAQs')}}</a></li>
                                        {{-- @foreach($show_in_footer_menu as $footer_menu)
                                        @php
                                        $cmsContent = App\CmsContent::getContentBySlug($footer_menu->page_slug);
                                        @endphp
                                        <li class="{{ Request::url() == route('cms', $footer_menu->page_slug) ? 'active' : '' }}"><a href="{{ route('cms', $footer_menu->page_slug) }}"><i class="fa-solid fa-chevron-right"></i>{{ $cmsContent->page_title }}</a></li>
                                        @endforeach --}}
                                    </ul>
                                </div>
                            </div>

                              <div class="col-lg-2">
                                <div class="footermidfc_jxoutsection">
                                    <h2 class="ulinks_outsection">{{ __('Useful Links') }}</h2>
                                    <ul class="footer_gulnksj">
                                        {{-- <li>
                                            <a href="{{ route('index') }}">
                                                <i class="fa-solid fa-chevron-right"></i>
                                                {{ __('Home') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contact.us') }}">
                                                <i class="fa-solid fa-chevron-right"></i>
                                                {{ __('Contact Us') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('post.job') }}">
                                                <i class="fa-solid fa-chevron-right"></i>
                                                {{ __('Post a Job') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('faq') }}">
                                                <i class="fa-solid fa-chevron-right"></i>
                                                {{ __('FAQs') }}
                                            </a>
                                        </li> --}}

                                        {{-- Dynamic CMS pages shown in footer --}}
                                        @foreach($show_in_footer_menu as $footer_menu)
                                            @php
                                                $cmsContent = App\CmsContent::getContentBySlug($footer_menu->page_slug);
                                            @endphp
                                            @if($cmsContent)
                                            <li class="{{ Request::url() == route('cms', $footer_menu->page_slug) ? 'active' : '' }}">
                                                <a href="{{ route('cms', $footer_menu->page_slug) }}">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                    {{ $cmsContent->page_title }}
                                                </a>
                                            </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                              <div class="col-lg-3">
                                  <div class="lastcontent_outsection">
                                      <h2 class="ulinks_outsection">Contact</h2>
                                      <div class="row udown_borederarea">
                                          <div class="col-lg-3 col-2">
                                              <div class="contactfstsection_outfooter">
                                                  <div class="clinkfooter_boxoutarea">
                                                      <i class="fa-solid fa-phone"></i>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-9 col-10">
                                              <div class="contactfstdownsection_outfooter">
                                                  <h2 class="cayun_textdesign">Call anytime</h2>
                                                  <a href="tel: +91 0000000000" class="footercontact_lnktextdesign"> +91
                                                      0000000000</a>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row udown_borederarea">
                                          <div class="col-lg-3 col-2">
                                              <div class="contactfstsection_outfooter">
                                                  <div class="clinkfooter_boxoutarea">
                                                      <i class="fa-solid fa-envelope"></i>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-9 col-10">
                                              <div class="contactfstdownsection_outfooter">
                                                  <h2 class="cayun_textdesign">Send email</h2>
                                                  <a href="mailto:test@gmail.com"
                                                      class="footercontact_lnktextdesign">test@gmail.com</a>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row udown_borederarea1">
                                          <div class="col-lg-3 col-2">
                                              <div class="contactfstsection_outfooter">
                                                  <div class="clinkfooter_boxoutarea">
                                                      <i class="fa-solid fa-envelope"></i>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="col-lg-9 col-10">
                                              <div class="contactfstdownsection_outfooter">
                                                  <h2 class="cayun_textdesign">Our Address</h2>
                                                  <p class="clicnfooter_addresstext">
                                                      Kolkata
                                                  </p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12 copyright_outsection">
                  <p class="kfurniture_outarea">
                      © 2024 Fairountjob . All Rights Reserved &nbsp;&nbsp;&nbsp;&nbsp;Powered By <a href='https://www.eras-tech.com/' target='_blank' style='color:#fff;text-decoration:none'>Eras-tech</a>
                  </p>
              </div>
          </div>
      </div>