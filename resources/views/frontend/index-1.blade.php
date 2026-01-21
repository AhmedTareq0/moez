@extends('frontend.layouts.app' . (config('theme_layout') ?: 1))

@section('title', trans('labels.frontend.home.title') . ' | ' . app_name())
@section('meta_description', '')
@section('meta_keywords', '')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/intl-tel-input/css/intlTelInput.min.css') }}">
@endsection
@php
    // Ensure $sections is an object so template property access (->) is safe.
    // json encode/decode converts nested arrays to objects recursively.
    if (isset($sections) && !is_object($sections)) {
        $sections = json_decode(json_encode($sections));
    }
@endphp
@push('after-styles')
    {{-- @dd(json_decode(config('registration_fields'))) --}}
    <style>
        /*.address-details.ul-li-block{*/
        /*line-height: 60px;*/
        /*}*/
        .teacher-img-content .teacher-social-name {
            max-width: 67px;
        }

        .my-alert {
            position: absolute;
            z-index: 10;
            left: 0;
            right: 0;
            top: 25%;
            width: 50%;
            margin: auto;
            display: inline-block;
        }
    </style>
@endpush

@section('content')
    {{-- @dd($cites) --}}
    <!-- Start of slider section ============================================= -->
    @if (session()->has('alert'))
        <div class="alert alert-light alert-dismissible fade my-alert show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{{ session('alert') }}</strong>
        </div>
    @endif
    @include('frontend.layouts.partials.slider')
    <!-- End of slider section ============================================= -->
    @if ($sections->search_section->status == 1)
        <div class="search-counter-up bg-main">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-sm-4 py-3 text-center">
                        <div class="counter-icon-number d-flex align-items-center justify-content-center">
                            <div class="counter-icon">
                                <i class="flaticon-graduation-hat"></i>
                            </div>
                            <div class="counter-number d-flex flex-column justify-content-start align-items-start">
                                <span class="text-white bold-font">{{ $total_students }}</span>
                                <p class="m-0">@lang('labels.frontend.home.students_enrolled')</p>
                            </div>
                        </div>
                    </div>
                    <!-- /counter -->

                    <div class="col-md-4 col-sm-4 py-3 text-center">
                        <div class="counter-icon-number d-flex align-items-center justify-content-center">
                            <div class="counter-icon">
                                <i class="flaticon-book"></i>
                            </div>
                            <div class="counter-number d-flex flex-column justify-content-start align-items-start">
                                <span class="text-white bold-font">{{ $total_courses }}</span>
                                <p class="m-0">@lang('labels.frontend.home.online_available_courses')</p>
                            </div>
                        </div>
                    </div>
                    <!-- /counter -->


                    <div class="col-md-4 col-sm-4 py-3 text-center">
                        <div class="counter-icon-number d-flex align-items-center justify-content-center">
                            <div class="counter-icon">
                                <i class="flaticon-group"></i>
                            </div>
                            <div class="counter-number d-flex flex-column justify-content-start align-items-start">
                                <span class="text-white bold-font">{{ $total_teachers }}</span>
                                <p class="m-0">@lang('labels.frontend.home.teachers')</p>
                            </div>
                        </div>
                    </div>
                    <!-- /counter -->
                </div>
            </div>
        </div>
        {{-- end of Counter Up --}}
    @endif
    {{-- start of Categories --}}
    <div style="background: url({{ asset('assets/img/banner/reason.png') }}); background-size:cover;">
        @if ($sections->course_by_category->status == 1)
            <!-- Start Course category============================================= -->
            @include('frontend.layouts.partials.course_by_category')
            <!-- End Course category============================================= -->
        @endif
        {{-- End of Categories --}}
        @if ($sections->reasons->status != 0)
            <!-- Start of why choose us section  ============================================= -->
            <section id="why-choose-us" class="why-choose-us-section">
                <div class="container">
                    @if ($sections->reasons->status == 1)
                        <div class="section-title mb20 headline text-center ">
                            <span class="subtitle text-uppercase">{{ env('APP_NAME') }} @lang('labels.frontend.layouts.partials.advantages')</span>
                            <h2>@lang('labels.frontend.layouts.partials.why_choose')</span></h2>
                        </div>
                        @if ($reasons->count() > 0)
                            <div id="" class="row">
                                @php
                                    $transparent = ['249, 37, 150', '88, 102, 235', '0,168,255', '142, 86, 255'];
                                    $colors = ['#FFF0F8', '#F7F3FF', '#F1FBFF', '#F3F4FE'];
                                @endphp
                                @foreach ($reasons->take(4) as $index => $item)
                                    <div class="col-md-3">
                                        <div class="section border-main py-4 px-3"
                                            style="background:{{ $colors[$index] }}; border-color:transparent"
                                            onmouseover="this.style.backgroundColor = 'rgba({{ $transparent[$index] }}, 1)'"
                                            onmouseout="this.style.backgroundColor = '{{ $colors[$index] }}'">
                                            <div class="d-flex justify-content-center mb-3">
                                                <span
                                                    class="icon d-flex rounded-circle d-flex justify-content-center align-items-center"
                                                    style="
                                                    height: 60px; 
                                                    width:60px;
                                                    color:rgba({{ $transparent[$index] }}, 1);
                                                    background:rgba({{ $transparent[$index] }}, 0.2)">
                                                    <i class="{{ $item->icon }}" style="font-size:25px"></i>
                                                </span>
                                            </div>
                                            <div class="text-center">
                                                <h5 style="color:rgba({{ $transparent[$index] }}, 1)">{{ $item->title }}
                                                </h5>
                                                <p>{{ $item->content }}.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                    <!-- /service-slide -->
                </div>
            </section>
            <!-- End of why choose us section  ============================================= -->
        @endif
    </div>

    @if ($sections->search_section->status == 1)
        <section id="search-course" class="search-course-section">
            <div class="container">
                <div class="section-title mb20 headline text-center ">
                    <span class="subtitle text-uppercase">@lang('labels.frontend.home.learn_new_skills')</span>
                    <h2>@lang('labels.frontend.home.search_courses')</h2>
                </div>
                <div class="search-course mb30 relative-position ">
                    <form action="{{ route('search') }}" method="get">
                        <div class="input-group search-group border-main">
                            <input class="course" name="q" type="text" placeholder="@lang('labels.frontend.home.search_course_placeholder')">
                            <select name="category" class="select form-control">
                                @if (count($categories) > 0)
                                    <option value="">@lang('labels.frontend.course.select_category')</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @else
                                    <option>>@lang('labels.frontend.home.no_data_available')</option>
                                @endif
                            </select>
                            <button class="btn btn-primary btn-lg px-5" type="submit" value="Submit">
                                @lang('labels.frontend.home.search_course')
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
        <!-- End of Search Courses
                ============================================= -->
    @endif

    @if ($sections->popular_courses->status == 1)
        @include('frontend.layouts.partials.popular_courses')
    @endif
    </div>

    <div style="background: url({{ asset('assets/img/banner/testimonials.png') }})">
        @if ($sections->testimonial->status == 1)
            <div class="testimonials-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="section-title-2 mb-4 headline text-left ">
                                <h3 class="text-main bold-font">@lang('labels.frontend.layouts.partials.students_testimonial')</h3>
                            </div>
                            <p class="text-left">voices of our students are a testament to the quality of education and
                                experiences we provide. Here's what some of our students have to say about their time with
                                us</p>
                        </div>
                        <div class="col-md-7">
                            <div class="testimonial-slide">
                                @if ($testimonials->count() > 0)
                                    <div id="testimonial-slide-item" class="testimonial-slide-area">
                                        @foreach ($testimonials as $item)
                                            <div class="p-3">
                                                <div class="border-main border-0 p-3 testimonial-item">
                                                    <div style="margin: -12px -10px; text-align:end">
                                                        <i class="fa fa-quote-right text-main"></i>
                                                    </div>
                                                    <p class="m-0 text-left">
                                                        {{ \Illuminate\Support\Str::limit($item->content, 65) }}
                                                    </p>
                                                    <div class="rate my-3 text-left">
                                                        <i class="fa fa-star" style="color: goldenrod"></i>
                                                        <i class="fa fa-star mx-1" style="color: goldenrod"></i>
                                                        <i class="fa fa-star mx-1" style="color: goldenrod"></i>
                                                        <i class="fa fa-star mx-1" style="color: goldenrod"></i>
                                                        <i class="fa fa-star" style="color: goldenrod"></i>
                                                    </div>
                                                    <div class="mb-2">
                                                        <h4 class="text-left name mb-0 text-black">{{ $item->name }}
                                                        </h4>
                                                        <p class="text-left position mb-0">{{ $item->occupation }}</p>
                                                    </div>
                                                    <div style="margin: -12px -10px; text-align:start">
                                                        <i class="fa fa-quote-left text-second"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <h4>@lang('labels.general.no_data_available')</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($sections->sponsors->status == 1)
            @if (count($sponsors) > 0)
                <!-- Start of sponsor section============================================= -->
                <section id="sponsor" class="sponsor-section">
                    <div class="container">
                        <div class="sponsor-item sponsor-1 text-center">
                            @foreach ($sponsors as $sponsor)
                                <div class="sponsor-pic text-center">
                                    <a href="{{ $sponsor->link != '' ? $sponsor->link : '#' }}">
                                        <img src={{ asset('storage/uploads/' . $sponsor->logo) }}
                                            alt="{{ $sponsor->name }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- End of sponsor section============================================= -->
            @endif
        @endif
    </div>

    @if ($sections->latest_news->status == 1)
        <!-- Start latest section
            ============================================= -->
        @include('frontend.layouts.partials.latest_news')
        <!-- End latest section
                ============================================= -->
    @endif

    @if ($sections->featured_courses->status == 1)
        <!-- Start of best course
            ============================================= -->
        {{-- @include('frontend.layouts.partials.browse_courses') --}}
        <!-- End of best course
                ============================================= -->
    @endif


    @if ($sections->teachers->status == 1)
        <!-- Start of course teacher ============================================= -->
        @if (count($teachers) > 0)
            <section id="course-teacher" class="course-teacher-section">
                <div class="container">
                    <div class="section-title mb20 headline text-center ">
                        <span class="subtitle text-uppercase">@lang('labels.frontend.home.our_professionals')</span>
                        <h2>{{ env('APP_NAME') }} <span>@lang('labels.frontend.home.teachers').</span></h2>
                    </div>
                    <div class="teachers">
                        <div class="row justify-content-center">
                            @foreach ($teachers->take(4) as $item)
                                <div class="col-md-3 px-4">
                                    <div class="teacher bg-white border-main border-0">
                                        <div class="image p-2 ">
                                            <img src="{{ $item->picture }}" alt=""
                                                class="w-100 rounded-circle shadow-2" style="margin-top: -80px">
                                        </div>
                                        <div class="info p-3 pt-0 text-center">
                                            <p class="m-0 name">{{ $item->full_name }}</p>
                                            <p class="m-0">{{ $item->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of course teacher ============================================= -->
        @endif
    @endif

    @if ($sections->faq->status == 1)
        <!-- Start FAQ section
            ============================================= -->
        @include('frontend.layouts.partials.faq')
        <!-- End FAQ section
                ============================================= -->
    @endif

    @if ($sections->contact_us->status == 1)
        <!-- Start of contact area
            ============================================= -->
        @include('frontend.layouts.partials.contact_area')
        <!-- End of contact area
                ============================================= -->
    @endif


@endsection

@push('after-scripts')
    <script>
        $('ul.product-tab').find('li:first').addClass('active');
    </script>
@endpush
