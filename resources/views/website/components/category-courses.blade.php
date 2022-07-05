<div class="institutes"  >
@foreach($courses as $course)
        @include('website.components.horizontalCourse')
@endforeach
</div>
<div class="bottomNav">
      {{ $courses->links('pagination.default') }}
</div>