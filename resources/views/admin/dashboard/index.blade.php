@extends('admin.layout.master')

@section('content')
    <link rel="stylesheet" type="text/css"
          href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">

    <div class="grey-bg container-fluid">
        <section id="minimal-statistics">
            <div class="row">
                <div class="col-12 mt-3 mb-1"></div>
            </div>
            <h2 style="padding: 15px;font-weight: bold;">{{__('reports')}}</h2>

            <div class="row">
                @foreach(Home() as $menu)
                    <a href="{{url($menu['url'])}}" class="col-xl-3 col-sm-6 col-12"  >
                        <div class="card" style="background-color: {{$menu['color']}}; margin: 15px">
                            <div class="card-content" style=" box-shadow: 3px 5px #888888;">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-right">
                                            <h3 style="color: #FFF;font-size: 20px;">{{$menu['count']}}</h3>
                                            <span style="color: #FFF;font-size: 20px;">{{$menu['name']}}</span>
                                        </div>
                                        <div class="iconFix" style="background-color: {{$menu['color']}}">
                                            <span style="border: 3px dotted {{$menu['color']}};"></span>
                                            <i class="{{$menu['icon']}}"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <h2 style="padding: 15px;font-weight: bold;"> {{__('chart-reports')}}</h2>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab"  style="justify-content: space-around;" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                       href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                       aria-selected="true"> <span class="nav-icon fa fa-th-list"></span> {{__('popular_categories')}} </a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                       href="#custom-tabs-one-profile" role="tab"
                                       aria-controls="custom-tabs-one-profile"
                                       aria-selected="false"> <span class="nav-icon fa fa-play-circle"> {{__('courses')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-instructors-tab" data-toggle="pill"
                                       href="#custom-tabs-one-instructors" role="tab"
                                       aria-controls="custom-tabs-one-instructors"
                                       aria-selected="false"><span class="nav-icon fa fa-chalkboard-teacher"> {{__('instructors')}}</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-students-tab" data-toggle="pill"
                                       href="#custom-tabs-one-students" role="tab"
                                       aria-controls="custom-tabs-one-students"
                                       aria-selected="false"> <span class="fa fa-graduation-cap"> {{__('students')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                     aria-labelledby="custom-tabs-one-home-tab">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('name')}}</th>
                                                <th>{{__('views')}}</th>
                                                <th>{{__('courses')}}</th>
                                                <th>{{__('last_update')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($categories as $ob)
                                                <tr>
                                                    <td>{{$ob->getTranslation('name','ar')}} / {{$ob->getTranslation('name','en')}}</td>
                                                    <td><p class="btn btn-primary">{{$ob->categoryViews->count()}}</p></td>
                                                    <td><a href="{{route('admin.courses.show',$ob->id)}}"
                                                           class="btn btn-success">{{count($ob->courses)}}</a></td>
                                                    <td>{{$ob->created_at->diffForHumans()}}</td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                     aria-labelledby="custom-tabs-one-profile-tab">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>{{__('title')}}</th>
                                                <th>{{__('category')}}</th>
                                                <th>{{__('views')}}</th>
                                                <th>{{__('user')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($courses as $ob)
                                                <tr>
                                                    <td>{{$ob->title}}</td>
                                                    <td>{{$ob->category->name}}</td>
                                                    <td><p class="btn btn-primary">{{$ob->userCourses->count()}}</p></td>
                                                    <td><a href="{{route('admin.instructors.profile',$ob->user->id)}}">{{$ob->user->first_name}} {{$ob->user->last_name}}</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-one-instructors" role="tabpanel"
                                     aria-labelledby="custom-tabs-one-instructors-tab">
                                    <table   class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>{{__('name')}}</th>
                                            <th>{{__('email')}}</th>
                                            <th>{{__('phone')}}</th>
                                            <th>{{__('city')}}</th>
                                            <th>{{__('show_profile')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($teachers as $ob)
                                            <tr>
                                                <td>{{$ob->first_name . ' ' . $ob->last_name}}</td>
                                                <td>{{$ob->email}}</td>
                                                <td>{{$ob->city ? $ob->city->name :''}}</td>
                                                <td>{{$ob->phone}}</td>
                                                <td>
                                                    <a href="{{route('admin.instructors.profile',$ob->id)}}" class="grd-btn" href="" >
                                                        {{__('show_profile')}}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-one-students" role="tabpanel"
                                     aria-labelledby="custom-tabs-one-students-tab">
                                    <table  class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>{{__('name')}}</th>
                                            <th>{{__('email')}}</th>
                                            <th>{{__('phone')}}</th>
                                            <th>{{__('city')}}</th>
                                            <th>{{__('coursesCount')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $ob)
                                            <tr>
                                                <td>{{$ob->first_name . ' ' . $ob->last_name}}</td>
                                                <td>{{$ob->email}}</td>
                                                <td>{{$ob->phone}}</td>
                                                <td>{{$ob->city?$ob->city->name:''}}</td>
                                                <td>{{$ob->userCourses->count()}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>


    </div>




@endsection
