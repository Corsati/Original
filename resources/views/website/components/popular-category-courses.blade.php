@foreach($courses as $popular)
    <a href="{{route('coursati.courseDetails',['id' => $popular->id , 'name' => make_slug($popular->getTranslation('title',courseLng($popular)))])}}" class="course item">
        <div class="imgBlock">
            <picture>
                <source srcset="{{$popular->image}}" type="image/webp">
                <source srcset="{{$popular->image}}" type="image/jpeg">
                <img data-src="{{$popular->image}}"  src="{{$popular->image}}" alt="{{$popular->getTranslation('title',courseLng($popular))}}">
            </picture>
        </div>
        <div class="p-3">
            <p class="courseName">{{ \Illuminate\Support\Str::limit($popular->getTranslation('title',courseLng($popular)), 35, $end='...') }}</p>
            <p class="instructor">{{$popular->user->first_name}} {{$popular->user->last_name}}</p>
            <div class=" startsBlock d-flex flex-row align-items-center">
                <div class="stars">
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $popular->comments->avg('rate'))
                            <i class="fas fa-star active"></i>
                        @else
                            <i class="fas fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span><span>{{round($popular->comments->avg('rate'),2)}}</span>({{$popular->comments->count()}})</span>
            </div>
            <div class="price">
                @if($popular->discount > 0)
                    <div><sup>$</sup>{{discountCourse($popular->price,$popular->discount)}}</div>
                @endif
                <span><sup>$</sup>{{$popular->price}}</span>

            </div>
        </div>
    </a>
@endforeach