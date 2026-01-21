
<!-- Start popular course
       ============================================= -->
@if(count($popular_courses) > 0)
    <section id="popular-course" class="popular-course-section {{isset($class) ? $class : ''}}">
        <div class="container">
            <div class="row">
                @foreach($popular_courses->take(4) as $item)
                {{-- @dd($item) --}}
                    <div class="col-md-3 col-sm-6 course-item">
                        <div  href="{{ route('courses.show', [$item->slug]) }}" class="d-block course-details border-main mt-3 border-0 position-relative">
                            <div class="course-overlay p-3 bg-main position-absolute d-flex flex-column align-items-start justify-content-between">
                                <div class="content">
                                    <small class="fav d-inline-block bg-second border-main border-0 fs-4 ">
                                        @include('frontend.layouts.partials.wishlist',['course' => $item->id, 'price' => $item->price])
                                    </small>
                                    <div class="badges">
                                        @if($item->trending == 1)
                                            <span class="badge badge-light text-main">
                                                <i class="fas fa-bolt"></i> 
                                                @lang('labels.frontend.badges.trending')
                                            </span>
                                        @endif
                                        @if($item->popular == 1)
                                            <span class="badge badge-light text-main">
                                                <i class="fas fa-bolt"></i> 
                                                @lang('labels.frontend.badges.popular')
                                            </span>
                                        @endif
                                        @if($item->featured == 1)
                                            <span class="badge badge-light text-main">
                                                <i class="fas fa-bolt"></i> 
                                                @lang('labels.frontend.badges.featured')
                                            </span>
                                        @endif
                                    </div>
                                    <div class="course-title my-2">
                                        <h5 class="fw-bold text-white title">{{$item->title}}</h5>
                                    </div>
    
                                    <div class="course-desc my-2">
                                        <p class="fw-bold m-0">{!!$item->description!!}</p>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('courses.show', [$item->slug]) }}" class="btn btn-secondary">
                                        enroll Course 
                                    </a>
                                </div>
                            </div>
                            <div class="image overflow-hidden" style="height: 200px; overflow:hidden">
                                <img class="w-100" src="{{asset('storage/uploads/'.$item->course_image)}}" alt="" style="object-fit:cover;height: 200px;">
                            </div>
                            <div class="info p-3">
                                <div class="badges">
                                    @if($item->trending == 1)
                                        <span class="badge badge-success">
                                            <i class="fas fa-bolt"></i> 
                                            @lang('labels.frontend.badges.trending')
                                        </span>
                                    @endif
                                    @if($item->popular == 1)
                                        <span class="badge badge-info">
                                            <i class="fas fa-bolt"></i> 
                                            @lang('labels.frontend.badges.popular')
                                        </span>
                                    @endif
                                    @if($item->featured == 1)
                                        <span class="badge badge-primary">
                                            <i class="fas fa-bolt"></i> 
                                            @lang('labels.frontend.badges.featured')
                                        </span>
                                    @endif
                                </div>
                                <div class="course-title my-2">
                                    <h5 class="fw-bold text-black">{{ \Illuminate\Support\Str::limit($item->title , 30) }}</h5>
                                </div>

                                <div class="price mb-3">
                                    <h6 class="m-0 text-main">
                                        {!!  $item->strikePrice  !!}
                                        {{$appCurrency['symbol'].' '.$item->price}}
                                    </h6>
                                </div>
                                <div class="icons d-flex align-items-center justify-content-start">
                                    <small class="d-inline-block mx-1 alert alert-warning p-1">
                                        {{$item->rating == null ?'0':$item->rating }}
                                        <i class="fas fa-star mx-1" style="color: goldenrod"></i>
                                    </small>
                                    <small class="d-inline-block mx-1 alert alert-success p-1">
                                        <i class="fas fa-user"></i> {{ $item->students()->count() }}
                                    </small>
                                    <small class="d-inline-block mx-1 alert alert-info p-1">
                                        <i class="fas fa-comment-dots"></i> {{count($item->reviews) }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="course-item-pic-text col-md-3">
                        <div class="course-pic relative-position mb25" @if($item->course_image != "")  style="background-image: url({{asset('storage/uploads/'.$item->course_image)}})" @endif>
                            <div class="course-price text-center gradient-bg">
                                @if($item->free == 1)
                                    <span>{{trans('labels.backend.courses.fields.free')}}</span>
                                @else
                                   <span>
                                        {!!  $item->strikePrice  !!}
                                        {{$appCurrency['symbol'].' '.$item->price}}
                                   </span>
                                @endif
                            </div>
                            <div class="course-details-btn">
                                <a class="text-uppercase  btn btn-primary" href="{{ route('courses.show', [$item->slug]) }}">
                                    @lang('labels.frontend.layouts.partials.course_detail') 
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="course-item-text">
                            <div class="course-meta">
                                <span class="course-category bold-font">
                                    <a href="{{route('courses.category',['category'=>$item->category->slug])}}">{{$item->category->name}}</a>
                                </span>
                                @foreach($item->teachers as $teacher)
                                    <span class="course-author bold-font">
                                        <a href="#">{{$teacher->first_name}}</a>
                                    </span>
                                @endforeach
                                <div class="course-rate ul-li">
                                    <ul>
                                        @for($i=1; $i<=(int)$item->rating; $i++)
                                            <li><i class="fas fa-star"></i></li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                            <div class="course-title mt10 headline pb45 relative-position">
                                <h3>
                                    <a href="{{ route('courses.show', [$item->slug]) }}">{{$item->title}}</a>
                                </h3>
                            </div>
                            <div class="course-viewer ul-li">
                                <ul>
                                    <li><a href=""><i class="fas fa-user"></i> {{ $item->students()->count() }}
                                        </a>
                                    </li>
                                    <li><a href=""><i class="fas fa-comment-dots"></i> {{count($item->reviews) }}</a></li>
                                    <li>@include('frontend.layouts.partials.wishlist',['course' => $item->id, 'price' => $item->price])</li>
                                </ul>
                            </div>
                            
                            <div>
                                @if($item->trending == 1)
                                    <span class="trend-badge text-uppercase bold-font badge badge-info d-inline-block my-2">
                                        <i class="fas fa-bolt"></i> 
                                        @lang('labels.frontend.badges.trending')
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div> --}}
                    <!-- /item -->
                @endforeach
            </div>
        </div>
    </section>
    <!-- End popular course
        ============================================= -->
@endif
