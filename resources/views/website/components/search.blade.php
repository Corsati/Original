@if(count($courses) > 0)
    @foreach($courses as $course)
        <a href="{{route('coursati.courseDetails',['id' => $course->id , 'name' => make_slug($course->getTranslation('title',courseLng($course)))] )}}" class=" courserBlock d-flex flex-row align-items-center">
            <div class="courseImg">
                <img src="{{$course->image}}" alt="course image">
            </div>
            <div class="d-flex justify-content-between courseText">
                <div class="leftDiv">
                    <p>{{$course->getTranslation('title',courseLng($course))}}</p>
                    <p>{{$course->user->first_name}} {{$course->user->last_name}}</p>
                    <div class="info d-flex flex-row align-items-center">
                        <div><img src="{{setAsset('website/img/book.svg')}}" alt="calender"> {{count($course->lectures)}} {{__('web.Lecture')}} </div>
                        <div><img src="{{setAsset('website/img/time.svg')}}" alt="calender"> {{$course->duration->to}} {{__('web.total-hours')}}</div>
                        <div><img src="{{setAsset('website/img/goal.svg')}}" alt="calender"> {{($course->level()->first()->name)}}</div>
                    </div>
                    <p class="desc">{{ \Illuminate\Support\Str::limit($course->getTranslation('description',courseLng($course)), 100, $end='...') }}</p>
                </div>
                <div class="rightDiv">
                    <div class="price">
                        @if($course->discount > 0)
                            <div class="price"><sup>$</sup>{{discountCourse($course->price ,$course->discount)}}<span><sup>$</sup>{{ ( float) $course->price}}</span></div>
                        @else
                            <div class="price"><sup>$</sup>{{ ( float) $course->price}}</span></div>
                        @endif
                    </div>
                    <div class=" startsBlock d-flex flex-row align-items-center">
                        <div class="stars">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $course->comments->avg('rate'))
                                    <i class="fas fa-star active"></i>
                                @else
                                    <i class="fas fa-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span><span>{{round($course->comments->avg('rate'),2)}}</span>({{$course->comments->count()}})</span>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
    <div class="bottomNav">
        {{ $courses->links('pagination.default') }}
    </div>
@endif
