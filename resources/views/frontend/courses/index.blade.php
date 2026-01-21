@extends('frontend.layouts.app'.config('theme_layout'))
@section('title', trans('labels.frontend.course.courses').' | '. app_name() )

@push('after-styles')
    <style>
        .couse-pagination li.active {
            color: #333333 !important;
            font-weight: 700;
        }

        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #c7c7c7;
            background-color: white;
            border: none;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #333333;
            background-color: white;
            border: none;

        }
     .listing-filter-form select{
            height:50px!important;
        }

        ul.pagination {
            display: inline;
            text-align: center;
        }
    </style>
@endpush
@section('content')

    <!-- Start of breadcrumb section
        ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                <div class="page-breadcrumb-title">
                    <h2 class="breadcrumb-head black bold">
                        <span>@if(isset($category)) {{$category->name}} @else @lang('labels.frontend.course.courses') @endif </span>
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End of breadcrumb section
        ============================================= -->


    <!-- Start of course section
        ============================================= -->
    <section id="course-page" class="course-page-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    @if(session()->has('success'))
                        <div class="alert alert-dismissable alert-success fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="short-filter-tab">
                        <div class="shorting-filter w-50 d-inline float-left mr-3">
                            <span>@lang('labels.frontend.course.sort_by')</span>
                            <select id="sortBy" class="form-control d-inline w-50">
                                <option value="">@lang('labels.frontend.course.none')</option>
                                <option value="popular">@lang('labels.frontend.course.popular')</option>
                                <option value="trending">@lang('labels.frontend.course.trending')</option>
                                <option value="featured">@lang('labels.frontend.course.featured')</option>
                            </select>
                        </div>

                        <div class="tab-button blog-button ul-li text-center float-right">
                            <ul class="product-tab">
                                <li class="active" rel="tab1"><i class="fas fa-th"></i></li>
                                <li rel="tab2"><i class="fas fa-list"></i></li>
                            </ul>
                        </div>

                    </div>

                    <div class="genius-post-item">
                        <div class="tab-container">
                            <div id="tab1" class="tab-content-1 pt35">
                                <div class="best-course-area best-course-v2">
                                    <div class="row">
                                        @if($courses->count() > 0)

                                            @foreach($courses as $course)
                                                <div class="col-md-4 col-sm-6 course-item">
                                                    <div  href="{{ route('courses.show', [$course->slug]) }}" class="d-block course-details border-main mt-3 border-0 position-relative">
                                                        <div class="course-overlay p-3 bg-main position-absolute d-flex flex-column align-items-start justify-content-between">
                                                            <div class="content">
                                                                <small class="w-100 fav d-inline-block  border-main border-0 fs-4 position-absolute ">
                                                                    @include('frontend.layouts.partials.wishlist',['course' => $course->id, 'price' => $course->price])
                                                                </small>
                                                                <div class="badges">
                                                                    @if($course->trending == 1)
                                                                        <span class="badge badge-light text-main">
                                                                            <i class="fas fa-bolt"></i> 
                                                                            @lang('labels.frontend.badges.trending')
                                                                        </span>
                                                                    @endif
                                                                    @if($course->popular == 1)
                                                                        <span class="badge badge-light text-main">
                                                                            <i class="fas fa-bolt"></i> 
                                                                            @lang('labels.frontend.badges.popular')
                                                                        </span>
                                                                    @endif
                                                                    @if($course->featured == 1)
                                                                        <span class="badge badge-light text-main">
                                                                            <i class="fas fa-bolt"></i> 
                                                                            @lang('labels.frontend.badges.featured')
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="course-title my-2">
                                                                    <h5 class="fw-bold text-white title">{{$course->title}}</h5>
                                                                </div>
                                
                                                                <div class="course-desc my-2">
                                                                    <p class="fw-bold m-0">{!!$course->description!!}</p>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <a href="{{ route('courses.show', [$course->slug]) }}" class="btn btn-secondary">
                                                                    @lang('labels.frontend.course.course_detail')
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="image overflow-hidden" style="height: 200px; overflow:hidden">
                                                            <img class="w-100" src="{{asset('storage/uploads/'.$course->course_image)}}" alt="" style="object-fit:cover;height: 200px;">
                                                        </div>
                                                        <div class="info p-3">
                                                            <div class="badges">
                                                                @if($course->trending == 1)
                                                                    <span class="badge badge-success">
                                                                        <i class="fas fa-bolt"></i> 
                                                                        @lang('labels.frontend.badges.trending')
                                                                    </span>
                                                                @endif
                                                                @if($course->popular == 1)
                                                                    <span class="badge badge-info">
                                                                        <i class="fas fa-bolt"></i> 
                                                                        @lang('labels.frontend.badges.popular')
                                                                    </span>
                                                                @endif
                                                                @if($course->featured == 1)
                                                                    <span class="badge badge-primary">
                                                                        <i class="fas fa-bolt"></i> 
                                                                        @lang('labels.frontend.badges.featured')
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="course-title my-2">
                                                                <h5 class="fw-bold text-black">{{ \Illuminate\Support\Str::limit($course->title , 30) }}</h5>
                                                            </div>
                            
                                                            <div class="price mb-3">
                                                                <h6 class="m-0 text-main">
                                                                    {!!  $course->strikePrice  !!}
                                                                    {{$appCurrency['symbol'].' '.$course->price}}
                                                                </h6>
                                                            </div>
                                                            <div class="icons d-flex align-items-center justify-content-start">
                                                                <small class="d-inline-block mx-1 alert alert-warning p-1">
                                                                    {{$course->rating == null ?'0':$course->rating }}
                                                                    <i class="fas fa-star mx-1" style="color: goldenrod"></i>
                                                                </small>
                                                                <small class="d-inline-block mx-1 alert alert-success p-1">
                                                                    <i class="fas fa-user"></i> {{ $course->students()->count() }}
                                                                </small>
                                                                <small class="d-inline-block mx-1 alert alert-info p-1">
                                                                    <i class="fas fa-comment-dots"></i> {{count($course->reviews) }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-4">
                                                    <div class="best-course-pic-text relative-position">
                                                        <div class="best-course-pic relative-position"
                                                             @if($course->course_image != "") style="background-image: url('{{asset('storage/uploads/'.$course->course_image)}}')" @endif>

                                                            @if($course->trending == 1)
                                                                <div class="trend-badge-2 text-center text-uppercase">
                                                                    <i class="fas fa-bolt"></i>
                                                                    <span>@lang('labels.frontend.badges.trending')</span>
                                                                </div>
                                                            @endif
                                                                @if($course->free == 1)
                                                                    <div class="trend-badge-3 text-center text-uppercase">
                                                                        <i class="fas fa-bolt"></i>
                                                                        <span>@lang('labels.backend.courses.fields.free')</span>
                                                                    </div>
                                                                @endif
                                                            <div class="course-price text-center gradient-bg">
                                                                @if($course->free == 1)
                                                                    <span>{{trans('labels.backend.courses.fields.free')}}</span>
                                                                @else
                                                                    <span>
                                                                        {!!  $course->strikePrice  !!}
                                                                        {{$appCurrency['symbol'].' '.$course->price}}
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            <div class="course-rate ul-li">
                                                                <ul>
                                                                    @for($i=1; $i<=(int)$course->rating; $i++)
                                                                        <li><i class="fas fa-star"></i></li>
                                                                    @endfor
                                                                </ul>
                                                            </div>
                                                            <div class="course-details-btn">
                                                                <a href="{{ route('courses.show', [$course->slug]) }}">@lang('labels.frontend.course.course_detail')
                                                                    <i class="fas fa-arrow-right"></i></a>
                                                            </div>
                                                            <div class="blakish-overlay"></div>
                                                        </div>
                                                        <div class="best-course-text">
                                                            <div class="course-title mb20 headline relative-position">
                                                                <h3>
                                                                    <a href="{{ route('courses.show', [$course->slug]) }}">{{$course->title}}</a>
                                                                </h3>
                                                            </div>
                                                            <div class="course-meta">
                                                                <span class="course-category"><a
                                                                            href="{{route('courses.category',['category'=>$course->category->slug])}}">{{$course->category->name}}</a></span>
                                                                <span class="course-author"><a href="#">{{ $course->students()->count() }}
                                                                        @lang('labels.frontend.course.students')</a></span>

                                                            </div>
                                                            @include('frontend.layouts.partials.wishlist',['course' => $course->id, 'price' => $course->price])
                                                        </div>
                                                    </div>
                                                </div> --}}

                                            @endforeach
                                        @else
                                            <h3>@lang('labels.general.no_data_available')</h3>
                                    @endif

                                    <!-- /course -->

                                    </div>
                                </div>
                            </div><!-- /tab-1 -->

                            <div id="tab2" class="tab-content-1">
                                <div class="course-list-view">
                                    <table>
                                        <tr class="list-head">
                                            <th class="text-start">@lang('backend.categories.fields.image')</th>
                                            <th class="text-start">@lang('labels.frontend.course.course_name')</th>
                                            <th class="text-start">@lang('labels.frontend.course.course_type')</th>
                                            <th class="text-start">@lang('labels.frontend.course.starts')</th>
                                        </tr>
                                        @if($courses->count() > 0)
                                            @foreach($courses as $course)

                                                <tr>
                                                    <td>
                                                        <div class="course-list-img" @if($course->course_image != "") style="background-image: url({{asset('storage/uploads/'.$course->course_image)}})" @endif ></div>
                                                    </td>
                                                    <td>
                                                        <div class="course-list-img-text text-start">
                                                            <div class="">
                                                                <p class="font-weight-bold w-100">
                                                                    <a class="text-main" href="{{ route('courses.show', [$course->slug]) }}">{{$course->title}}</a>
                                                                </p>
                                                                <div class="course-meta">
                                                                <span class="course-category bold-font m-0">
                                                                    <a href="{{ route('courses.show', [$course->slug]) }}">
                                                                        @if($course->free == 1)
                                                                            <span class="badge badge-success">
                                                                                {{trans('labels.backend.courses.fields.free')}}
                                                                            </span>
                                                                        @else
                                                                            {!!  $course->strikePrice  !!}
                                                                            {{$appCurrency['symbol'].' '.$course->price}}
                                                                        @endif
                                                                    </a>
                                                                </span>

                                                                    <div class="course-rate ul-li">
                                                                        <ul>
                                                                            @for($i=1; $i<=(int)$course->rating; $i++)
                                                                                <li><i class="fas fa-star"></i></li>
                                                                            @endfor
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-start">
                                                        <span >
                                                            <a href="{{route('courses.category',['category'=>$course->category->slug])}}">
                                                                {{$course->category->name}}
                                                            </a>
                                                        </span>
                                                    </td>
                                                    <td class="text-start">{{\Carbon\Carbon::parse($course->start_date)->format('d M Y')}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">
                                                    <h3>@lang('labels.general.no_data_available')</h3>

                                                </td>
                                            </tr>
                                        @endif

                                    </table>
                                </div>
                            </div><!-- /tab-2 -->
                        </div>
                        <div class="couse-pagination text-center ul-li">
                            {{ $courses->links() }}
                        </div>
                    </div>


                </div>

                <div class="col-md-3">
                    <div class="side-bar">

                        <div class="side-bar-widget  first-widget">
                            <h2 class="widget-title text-capitalize">@lang('labels.frontend.course.find_your_course')</h2>
                            <div class="listing-filter-form pb30">
                                <form action="{{route('search-course')}}" method="get">

                                    <div class="filter-search mb20">
                                        <label class="text-uppercase">@lang('labels.frontend.course.category')</label>
                                        <select name="category" class="form-control listing-filter-form select">
                                            <option value="">@lang('labels.frontend.course.select_category')</option>
                                            @if(count($categories) > 0)
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>

                                                @endforeach
                                            @endif

                                        </select>
                                    </div>


                                    <div class="filter-search mb20">
                                        <label>@lang('labels.frontend.course.full_text')</label>
                                        <input type="text" class="" name="q" placeholder="{{trans('labels.frontend.course.looking_for')}}">
                                    </div>
                                    <button class="btn btn-primary w-100"
                                            type="submit">@lang('labels.frontend.course.find_courses') <i
                                                class="fas fa-caret-right"></i></button>
                                </form>

                            </div>
                        </div>

                        @if($recent_news->count() > 0)
                            <div class="side-bar-widget">
                                <h2 class="widget-title text-capitalize">@lang('labels.frontend.course.recent_news')</h2>
                                <div class="latest-news-posts">
                                    @foreach($recent_news as $course)
                                        <div class="latest-news-area">

                                            @if($course->image != "")
                                                <div class="latest-news-thumbnile relative-position"
                                                     style="background-image: url({{asset('storage/uploads/'.$course->image)}})">
                                                    <div class="blakish-overlay"></div>
                                                </div>
                                            @endif
                                            <div class="date-meta">
                                                <i class="fas fa-calendar-alt"></i> {{$course->created_at->format('d M Y')}}
                                            </div>
                                            <h3 class="latest-title bold-font"><a
                                                        href="{{route('blogs.index',['slug'=>$course->slug.'-'.$course->id])}}">{{$course->title}}</a>
                                            </h3>
                                        </div>
                                        <!-- /post -->
                                    @endforeach


                                    <div class="view-all-btn bold-font">
                                        <a href="{{route('blogs.index')}}">@lang('labels.frontend.course.view_all_news')
                                            <i class="fas fa-chevron-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>

                        @endif


                        {{-- @if($global_featured_course != "")
                            <div class="side-bar-widget">
                                <h2 class="widget-title text-capitalize">@lang('labels.frontend.course.featured_course')</h2>
                                <div class="featured-course">
                                    <div class="best-course-pic-text relative-position pt-0">
                                        <div class="best-course-pic relative-position "
                                             @if($global_featured_course->course_image != "") style="background-image: url({{asset('storage/uploads/'.$global_featured_course->course_image)}})" @endif>

                                            @if($global_featured_course->trending == 1)
                                                <div class="trend-badge-2 text-center text-uppercase">
                                                    <i class="fas fa-bolt"></i>
                                                    <span>@lang('labels.frontend.badges.trending')</span>
                                                </div>
                                            @endif
                                                @if($global_featured_course->free == 1)
                                                    <div class="trend-badge-3 text-center text-uppercase">
                                                        <i class="fas fa-bolt"></i>
                                                        <span>@lang('labels.backend.courses.fields.free')</span>
                                                    </div>
                                                @endif

                                        </div>
                                        <div class="best-course-text" style="left: 0;right: 0;">
                                            <div class="course-title mb20 headline relative-position">
                                                <h3>
                                                    <a href="{{ route('courses.show', [$global_featured_course->slug]) }}">{{$global_featured_course->title}}</a>
                                                </h3>
                                            </div>
                                            <div class="course-meta">
                                                <span class="course-category"><a
                                                            href="{{route('courses.category',['category'=>$global_featured_course->category->slug])}}">{{$global_featured_course->category->name}}</a></span>
                                                <span class="course-author">{{ $global_featured_course->students()->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of course section
        ============================================= -->

    <!-- Start of best course
   =============================================  -->
    @include('frontend.layouts.partials.browse_courses')
    <!-- End of best course
            ============================================= -->


@endsection

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $(document).on('change', '#sortBy', function () {
                if ($(this).val() != "") {
                    location.href = '{{url()->current()}}?type=' + $(this).val();
                } else {
                    location.href = '{{route('courses.all')}}';
                }
            })

            @if(request('type') != "")
            $('#sortBy').find('option[value="' + "{{request('type')}}" + '"]').attr('selected', true);
            @endif
        });

    </script>
@endpush
