@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    <!--start lightGrayBg-->
    <div class="lightGrayBg pb-5" >
        <div class="container" style="min-height: 400px" >
            @if(isset($category))
            <div class="development mt-0">
                <img src="{{$category->icon}}" alt="book">
                <div class="d-flex flex-column justify-content-center">
                    <h2 class="title">
                        {{$category->name}}
                    </h2>
                </div>
            </div>
            <div class="coursesContainer">
                @if(count($category->childes) > 0)
                    @foreach($category->childes as $section)
                        <a href="{{route('coursati.subcategory',[$section->id,make_slug($section->name)])}}" class="item">
                            {{$section->name}}  <span style="margin-left: 5px; margin-right: 5px"> ({{ count( $section->courses ) }}) </span>
                        </a>
                        @if(count($section->childes) > 0)
                            @foreach( $section->childes as $child)
                                <a href="{{route('coursati.subcategory',[$section->id,make_slug($section->name)])}}" class="item">
                                    {{$section->name}}  <span style="margin-left: 5px; margin-right: 5px"> ({{ count( $section->courses ) }}) </span>
                                </a>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </div>
            @endif

           @if(count($courses) == 0  )
                {{-- <div class="udlite-container udlite-page-wrapper search--container--3BdJP"  >
                    <h2 class="udlite-heading-xl" data-purpose="safely-set-inner-html:search:no-results-for-query">{{__('web.Sorry, we couldn`t find any results for')}} <q>{{$name}}</q></h2>
                    <div><h3 class="udlite-heading-lg">{{__('web.Try adjusting your search. Here are some ideas:')}}</h3>
                        <ul style="margin: 40px">
                            <li>{{__('web.- Make sure all words are spelled correctly')}}</li>
                            <li>{{__('web.- Try different search terms')}}</li>
                            <li>{{__('web.- Try more general search terms')}}</li>
                        </ul>
                    </div>
                </div> --}}
                    <div class="container" style="min-height: 400px" >

                    @include('website.components.empty')
                    </div>
            @else
            <div class="topResult d-flex justify-content-between align-items-center mt-20">

                <div class="resultsNum">
                    @if($name != '')
                    <h4><span>{{count($courses)}}</span> {{__('web.results for')}} “<span>{{$name}}</span>”</h4>
                    @endif
                    <p>{{__('web.All course available')}}, {{$coursesCount}} {{__('web.courses')}}</p>
                </div>

                <div class="filterBtns d-flex justify-content-center align-items-center">
                    <select id="orderBy" class="selectpicker"  title="{{__('web.Sort by')}}">
                        <option value="DESC">{{__('web.Newest')}}</option>
                        <option value="ASC">{{__('web.Oldest')}}</option>
                    </select>
                </div>
            </div>
            <div class="resultsContainer d-flex justify-content-between">
                <div class="topics">
                    <div id="accordion" class="myaccordion">
                        @if(count($categories) > 0)
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="w-100 d-flex align-items-center justify-content-between btn btn-link "
                                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                        {{__('web.Topic')}}
                                        <span >
                                        <i class="fas fa-minus"></i>
                                    </span>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                 data-parent="#accordion">
                                <div class="card-body" style="height:224px;overflow:auto">
                                    <ul>
                                        @foreach($categories as $category)
                                        <li >
                                            <div class="custom-control custom-checkbox " >
                                                <input type="checkbox" class="custom-control-input topic"  data-id="{{$category->id}}" data-name="{{$category->name}}" id="category-{{$category->id}}">
                                                <label class="custom-control-label" for="category-{{$category->id}}">{{$category->name}} <span>({{count($category->courses)}})</span></label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="w-100 d-flex align-items-center justify-content-between btn btn-link collapsed"
                                            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                            aria-controls="collapseTwo">
                                        {{__('web.Level')}}
                                        <span >
                                        <i class="fas fa-minus"></i>
                                    </span>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body" style="height:150px;overflow:auto">
                                    <ul>
                                        @foreach($academics as $academic)
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input level"  data-id="{{$academic->id}}"   id="level-{{$academic->id}}">
                                                <label class="custom-control-label" for="level-{{$academic->id}}">{{$academic->name}} <span>({{count($academic->courses)}})</span></label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="w-100 d-flex align-items-center justify-content-between btn btn-link collapsed"
                                            data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                        {{__('web.Price')}}
                                        <span >
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <ul>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input price"  data-id="paid"  id="paid">
                                                <label class="custom-control-label" for="paid">{{__('web.paid')}}</label>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input price" data-id="free"  id="free">
                                                <label class="custom-control-label" for="free">{{__('web.free')}}</label>
                                            </div>
                                        </li>
                                     </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingSix">
                                <h2 class="mb-0">
                                    <button class="w-100 d-flex align-items-center justify-content-between btn btn-link collapsed"
                                            data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                                            aria-controls="collapseSix">
                                        {{__('web.Duration')}}
                                        <span >
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <ul>
                                        @foreach($durations as $duration )
                                            <li>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input duration" data-id="{{$duration->id}}" id="time-{{$duration->id}}">
                                                    <label class="custom-control-label" for="time-{{$duration->id}}">{{$duration->from}}  - {{$duration->to}} {{__('web.hours')}}</label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingSeven">
                                <h2 class="mb-0">
                                    <button class="w-100 d-flex align-items-center justify-content-between btn btn-link collapsed"
                                            data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false"
                                            aria-controls="collapseSeven">
                                        {{__('web.Rating')}}
                                        <span >
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                                 data-parent="#accordion">
                                <div class="card-body">
                                    <ul>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input rate" data-id="1" id="stars-1">
                                                <label class="custom-control-label" for="stars-1">1 {{__('web.stars')}}</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input rate" data-id="2" id="stars-2">
                                                <label class="custom-control-label" for="stars-2">2 {{__('web.stars')}}</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input rate" data-id="3" id="stars-3">
                                                <label class="custom-control-label" for="stars-3">3 {{__('web.stars')}}</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input rate" data-id="4" id="stars-4">
                                                <label class="custom-control-label" for="stars-4">4 {{__('web.stars')}}</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input rate" data-id="5" id="stars-5">
                                                <label class="custom-control-label" for="stars-5">5 {{__('web.stars')}}</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="results">
                    <div class="titles" id="titles">

                    </div>

                    <div class="institutesContainer">
                        <div class="institutes" id="courses">
                            @include('website.components.search')

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!--end lightGrayBg-->
    @include('website.layouts.partial.footerDetails')
@endsection

@push('scripts')
    @include('website.js.searchResults')
@endpush