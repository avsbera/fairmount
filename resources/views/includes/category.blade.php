<div class="container">
    <div class="row">
        <div class="col-lg-12 categories_outarea">
            <h1 class="ppxg_texydesign">{{ __('Popular Categories') }}</h1>
            <p class="frix_ctextdesign">{{ __('Find the right industry for your career') }}</p>

            <div class="row">
                @if(isset($topFunctionalAreaIds) && count($topFunctionalAreaIds)) 
                    @foreach($topFunctionalAreaIds as $functional_area_id_num_jobs)
                        @php
                            $functionalArea = App\FunctionalArea::where('functional_area_id', $functional_area_id_num_jobs->functional_area_id)->first();
                        @endphp

                        @if($functionalArea)
                        <div class="col-lg-3">
                            <a href="{{ route('job.list', ['functional_area_id[]' => $functionalArea->functional_area_id]) }}">
                                <div class="categori_boxoutsection">
                                    @if ($functionalArea->image && file_exists(public_path('uploads/functional_area/' . $functionalArea->image)))
                                        <img src="{{ asset('uploads/functional_area/' . $functionalArea->image) }}" 
                                             class="catimg_design" 
                                             alt="{{ $functionalArea->functional_area }}">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" 
                                             class="catimg_design" 
                                             alt="{{ $functionalArea->functional_area }}">
                                    @endif

                                    <div class="jkcat_psnareaouts">
                                        <h1 class="damtext_design">
                                            {!! \Illuminate\Support\Str::limit($functionalArea->functional_area, 25, '...') !!}
                                        </h1>
                                        <h6 class="damtext_design1">
                                            {{ $functional_area_id_num_jobs->num_jobs }} {{ __('Listings') }}
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <button class="erphbtn_design" onclick="window.location.href='{{ url('/all-categories') }}'">
                {{ __('Explore More') }}
            </button>
        </div>
    </div>
</div>
