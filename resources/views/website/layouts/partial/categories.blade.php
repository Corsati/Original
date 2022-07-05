<!--start categories-->
@if(!request()->is('index'))
<div class="bgGray d-none d-md-flex">
    <div class="container" >
        <ul class="categoriesLinks"  style="flex-wrap: unset;    overflow-x: scroll;    white-space: nowrap;">
            @foreach($main as $category)
                <li>
                    <a href="{{route('coursati.category',[  'id' => $category->id,'name' => make_slug($category->name)])}}">{{$category->getTranslation('name', lang())}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif
<!--end categories-->
