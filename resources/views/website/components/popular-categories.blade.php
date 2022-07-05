@foreach($categories as $category)
<a href="{{route('coursati.category',[  'id' => $category->id,'name' => make_slug($category->name)])}}" class="cat d-inline-flex flex-column justify-content-center">
     <picture>
        <source srcset="{{$category->icon}}" type="image/webp">
        <source srcset="{{$category->icon}}" type="image/jpeg">
        <img data-src="{{$category->icon}}"  src="{{$category->icon}}" alt="">
    </picture>
    <h4>{{$category->name}}</h4>
    <div><span> {{count($category->courses)}} </span>{{__('web.Courses&Tutorials')}}</div>
</a>
@endforeach
<a href="{{route('coursati.explore-categories')}}" class="cat viewAll d-inline-flex flex-column justify-content-center">
    <i class="fas fa-arrow-right"></i>
    <h4>{{__('web.all_categories')}}</h4>
</a>
