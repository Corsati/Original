<!--start Popular Instructors-->
@if(count($users) > 0)
<div class="container">
    <div class="popularInstructors learnNext">
        <div class="">
            <h2 class="title">{{__('web.Popular Instructors')}}</h2>
            <p class="desc">{{__('web.Popular Instructors')}} {{isset($category) ? __('web.in') . $category->name : '' }} </p>
        </div>
        <div id="owl-demo5" class="owl-carousel purpleDemo">
            @foreach($users as $user)
            <div class="item">
                <a href="{{route('coursati.instructorCourses',['id' => $user->id])}}" class="instructor">
                    <img src="{{$user->avatar}}" alt="course image">
                    <p class="instructorName">{{$user->first_name}} {{$user->last_name}}</p>
                    <div><span>{{count($user->courses->where('status','active'))}}</span> {{__('web.courses')}}</div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endif

<!--end Popular Instructors-->
