@foreach($courses as $course)
    <div class="item">
        <a href="{{route('coursati.courseDetails',['id' => $course->id , 'name' => make_slug($course->getTranslation('title',courseLng($course)))] )}}" class="course">
            <div class="imgBlock">
                <picture>
                    <source srcset="{{$course->image}}" type="image/webp">
                    <source srcset="{{$course->image}}" type="image/jpeg">
                    <img data-src="{{$course->image}}"  src="{{$course->image}}" alt="{{$course->getTranslation('title',courseLng($course))}}">
                </picture>
            </div>
            <div class="p-3">
                <p class="courseName">{{ \Illuminate\Support\Str::limit($course->getTranslation('title',courseLng($course)), 20, '...') }}</p>
                <p class="instructor">{{$course->user->name}}</p>
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
                <div class="price">
                    @if($course->discount > 0)
                        <div><sup>$</sup>{{discountCourse($course->price,$course->discount)}}</div>
                    @endif
                    <span><sup>$</sup>{{$course->price}}</span>

                </div>
            </div>
        </a>
    </div>
@endforeach


