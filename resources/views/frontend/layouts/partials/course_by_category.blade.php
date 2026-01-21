<section id="course-category" class="course-category-section">
    <div class="container">
        <div class="section-title mb45 headline text-center ">
            <span class="subtitle text-uppercase">@lang('labels.frontend.layouts.partials.courses_categories')</span>
            <h2>@lang('labels.frontend.layouts.partials.browse_course_by_category')</h2>
        </div>
        @if($course_categories)
            <div class="category-item">
                <div class="row">
                    @php
                        // $colors = ['249, 37, 150','88, 102, 235','255, 0, 210','142, 86, 255','57, 192, 250','0, 168, 255']
                        $transparent = ['249, 37, 150','88, 102, 235','0,168,255','142, 86, 255','0,168,255','142, 86, 255'];
                        $colors = ['#FFF0F8','#F7F3FF','#F1FBFF','#F3F4FE','#F7F3FF' , '#F3F4FE'];
                    @endphp
                    @foreach($course_categories->take(6) as $index => $category)
                        <div class="col-md-4 category-peace mb-4">
                            <a class="" href="{{route('courses.category',['category'=>$category->slug])}}">
                                <div class="d-flex align-items-center justify-content-start border-main d-block py-3 px-4" 
                                style="background:{{ $colors[$index] }}; border-color:transparent"
                                onmouseover="this.style.backgroundColor = 'rgba({{ $transparent[$index] }}, 1)'" 
                                onmouseout="this.style.backgroundColor = '{{ $colors[$index] }}'" >
                                    <h5 style="color:rgba({{ $transparent[$index] }}, 1)" class="m-0 icon {{$category->icon}}"></h5>
                                    <div class="px-3"></div>
                                    <h5 class="m-0 title">{{$category->name}}</h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                <!-- /category -->
                </div>
            </div>
        @endif
    </div>
</section>
