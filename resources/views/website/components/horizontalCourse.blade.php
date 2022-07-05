
<a href="{{route('coursati.courseDetails',['id' => $course->id , 'name' => urlencode($course->getTranslation('title',courseLng($course)))])}}"  class="courserBlock d-flex flex-row align-items-center mb-2">
    <div class="courseImg">
        <picture>
            <source srcset="{{$course->image}}" type="image/webp">
            <source srcset="{{$course->image}}" type="image/jpeg">
            <img data-src="{{$course->image}}"  src="{{$course->image}}" alt="{{$course->getTranslation('title',courseLng($course))}}">
        </picture>
    </div>
    <div class="d-flex flex-column courseText">
        <div class="d-flex justify-content-between courseText p-0">
            <div class="leftDiv">
                <p>{{$course->getTranslation('title',courseLng($course))}}</p>
                <p>{{$course->user->first_name}} {{$course->user->last_name}}</p>
                <div class="info d-flex flex-row align-items-center">
                    <div><img src="{{setAsset('website/img/book.svg')}}" alt="calender"> {{convertNumbers(count($course->lectures))}} {{__('web.Lectures')}}</div>
                    <div><img src="{{setAsset('website/img/time.svg')}}" alt="calender"> {{convertNumbers($course->duration?$course->duration->to:0)}} {{__('web.hours')}}</div>
                    <div><img src="{{setAsset('website/img/goal.svg')}}" alt="calender"> {{$course->level()->first()->name}} </div>
                </div>
                <p class="desc">{{ \Illuminate\Support\Str::limit($course->getTranslation('description',courseLng($course)), 20, $end='...') }}</p>
            </div>
            <div class="rightDiv">
                <div class="price">
                    @if($course->discount > 0)
                    <div><sup>$</sup>{{discountCourse($course->price,$course->discount)}}</div>
                    @endif
                    <span><sup>$</sup>{{$course->price}}</span>

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
    </div>
</a>
