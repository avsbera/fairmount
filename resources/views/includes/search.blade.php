<section class="banner_outsection">
    <div class="container">
        <div class="row">
            <!-- Left Section -->
            <div class="col-lg-7">
                <div class="banner_leftoutsection">
                    <div class="bannerleft_fstoutarea">
                        <i class="fa-solid fa-circle"></i>
                        <span>{{ __('Best jobs place') }}</span>
                    </div>

                    {{-- Dynamic Heading + Paragraph --}}
                    @php $widget = widget(5); @endphp
                    @if(Auth::guard('company')->check())
                        <h1 class="wtgtext_design">{{ __('Find Top Skilled Candidates') }}</h1>
                        <p class="emmtext_design">
                            {{ __("Simply enter your resume criteria to instantly search from millions of live, top quality resumes") }}
                        </p>
                    @else
                        <h1 class="wtgtext_design">{{ __($widget->extra_field_1) }}</h1>
                        <p class="emmtext_design">{{ __($widget->extra_field_2) }}</p>
                    @endif

                    <!-- Search Box -->
                    <div class="srjobbox_outarea">
                        @if(Auth::guard('company')->check())
                            {{-- Employer Resume Search --}}
                            <form action="{{ route('job.seeker.list') }}" method="GET">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="jtcbox_outarea">
                                            <input type="text" name="search" id="empsearch"
                                                value="{{ Request::get('search', '') }}"
                                                placeholder="{{ __('Search Candidate') }}"
                                                class="bbbox_design" autocomplete="off">
                                            <i class="fa-solid fa-suitcase bbicon_icondesign"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="jtcbox_outarea">
                                            @if((bool)$siteSetting->country_specific_site)
                                                {!! Form::hidden('country_id[]', Request::get('country_id[]', $siteSetting->default_country_id), ['id'=>'country_id']) !!}
                                            @else
                                                {!! Form::select('country_id[]', ['' => __('Select Country')] + $countries, Request::get('country_id', $siteSetting->default_country_id), ['class'=>'bbbox_design', 'id'=>'country_id']) !!}
                                            @endif
                                            <i class="fa-solid fa-location-dot bbicon_icondesign"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="sjob_btnarea">
                                            <button type="submit" class="fnwbtn_design">{{ __('Find Now') }}</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- State & City Dropdowns --}}
                                <div class="row mt-2">
                                    <div class="col-lg-6">
                                        <span id="state_dd">
                                            {!! Form::select('state_id[]', ['' => __('Select State')], Request::get('state_id', null), ['class'=>'bbbox_design', 'id'=>'state_id']) !!}
                                        </span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span id="city_dd">
                                            {!! Form::select('city_id[]', ['' => __('Select City')], Request::get('city_id', null), ['class'=>'bbbox_design', 'id'=>'city_id']) !!}
                                        </span>
                                    </div>
                                </div>
                            </form>
                        @else
                            {{-- Job Seeker Search --}}
                            <form action="{{ route('job.list') }}" method="GET">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="jtcbox_outarea">
                                            <input type="text" name="search" id="jbsearch"
                                                value="{{ Request::get('search', '') }}"
                                                placeholder="{{ __('Enter Skills or job title') }}"
                                                class="bbbox_design" autocomplete="off">
                                            <i class="fa-solid fa-suitcase bbicon_icondesign"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="jtcbox_outarea">
                                            {!! Form::select('functional_area_id[]', ['' => __('Select Functional Area')] + $functionalAreas, Request::get('functional_area_id', null), ['class'=>'bbbox_design', 'id'=>'functional_area_id']) !!}
                                            <i class="fa-solid fa-location-dot bbicon_icondesign"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="sjob_btnarea">
                                            <button type="submit" class="fnwbtn_design">{{ __('Find Now') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>

                    <!-- Popular Searches -->
                    <div class="ppsearch_outarea">
                            <strong class="pches_textdesign">{{ __('Industries:') }}</strong>
                            @if(isset($topIndustryIds) && count($topIndustryIds))
                                @php $count = 0; @endphp
                                @foreach($topIndustryIds as $industry_id => $num_jobs)
                                    @php
                                        $industry = App\Industry::where('industry_id', $industry_id)
                                            ->lang()
                                            ->active()
                                            ->first();
                                    @endphp
                                    @if($industry && $count < 3)
                                        <a href="{{ route('job.list', ['industry_id[]' => $industry->industry_id]) }}" 
                                        class="ppasrch_textdesign" 
                                        title="{{ $industry->industry }}">
                                            {{ $industry->industry }} ({{ $num_jobs }})
                                        </a>
                                        @php $count++; @endphp
                                    @endif
                                @endforeach
                            @endif
                        </div>

                </div>
            </div>

            <!-- Right Section -->
            <div class="col-lg-5">
                <div class="bannerright_fstoutarea">
                    @if((bool)$siteSetting->is_slider_active)
                        {{-- Slider --}}
                        <div class="tp-banner-container">
                            <div class="tp-banner">
                                <ul>
                                    @if(isset($sliders) && count($sliders))
                                        @foreach($sliders as $slide)
                                            <li data-slotamount="7" data-transition="slotzoom-horizontal" data-masterspeed="1000" data-saveperformance="on">
                                                <img alt="{{ $slide->slider_heading }}"
                                                     src="{{ asset('/') }}images/dummy.png"
                                                     data-lazyload="{{ ImgUploader::print_image_src('/slider_images/'.$slide->slider_image) }}">
                                                <div class="caption lft large-title tp-resizeme slidertext1" data-x="center" data-y="90" data-speed="600" data-start="1600">
                                                    {{ $slide->slider_heading }}
                                                </div>
                                                <div class="caption lfb large-title tp-resizeme sliderpara" data-x="center" data-y="140" data-speed="600" data-start="2800">
                                                    {!! $slide->slider_description !!}
                                                </div>
                                                <div class="caption lfb large-title tp-resizeme slidertext5" data-x="center" data-y="200" data-speed="600" data-start="3500">
                                                    <a href="{{ $slide->slider_link }}">{{ $slide->slider_link_text }}</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @else
                        {{-- Static Banner Image --}}
                        <img src="{{ asset('images/'.$widget->extra_image_1) }}" class="rightbn_imgdesign shape-1" alt="Banner">
                        <span class="union-icon">
                            <img alt="Fair Mount" src="{{ asset('frontend/images/union.svg') }}" class="img-responsive shape-3">
                        </span>
                        <span class="course-icon">
                            <img alt="Fair Mount" src="{{ asset('frontend/images/course.svg') }}" class="img-responsive shape-2">
                        </span>
                        <span class="congratulation-icon">
                            <img alt="Fair Mount" src="{{ asset('frontend/images/congratulation.svg') }}" class="img-responsive shape-2">
                        </span>
                        <span class="docs-icon">
                            <img alt="Fair Mount" src="{{ asset('frontend/images/docs.svg') }}" class="img-responsive shape-2">
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
