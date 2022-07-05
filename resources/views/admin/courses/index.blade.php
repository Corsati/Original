@extends('admin.layout.master')
@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>{{__('courses')}}</h2>
{{--                        <a type="button" href="{{route('admin.courses.add')}}" class="btn btn-primary btn-wide waves-effect waves-light">--}}
{{--                            </i> {{__('add_course')}}--}}
{{--                        </a>--}}
                    </div>
                    <div class="page-header callout-primary d-flex">
                        <div class="col-md-3">
                            <div class="stati turquoise left">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                <div>
                                    <b>{{count($objects)}}</b>
                                    <span>{{__('total')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stati turquoise left">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <div>
                                    <b>{{count($active)}}</b>
                                    <span>{{__('total-active')}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="stati turquoise left">
                                <i class="fa fa-clock" aria-hidden="true"></i>
                                <div>
                                    <b>{{count($in_review)}}</b>
                                    <span>{{__('total-in-review')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stati turquoise left">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <div>
                                    <b>{{count($pending)}}</b>
                                    <span>{{__('total-waiting-review')}}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card page-body">
            <div class="table-responsive">
                <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                    <thead>
                    <tr>
                        <th>{{__('title')}}</th>
                        <th>{{__('price')}}</th>
                        <th>{{__('category')}}</th>
                        <th>{{__('discount')}}</th>
                        <th>{{__('views')}}</th>
                        <th>{{__('user')}}</th>
                        <th>{{__('change-status')}}</th>
                        <th>{{__('control')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects as $ob)
                        <tr>
                            <td>{{$ob->title}}</td>
                            <td>{{$ob->price}}</td>
                            <td>{{$ob->category->name}}</td>
                            <td>{{$ob->discount}}</td>
                            <td><p style="width: 100%" class="btn btn-primary">{{$ob->userCourses->count()}}</p></td>
                            <td>{{$ob->user->first_name}} {{$ob->user->last_name}}</td>
                            <td>
                                @if($ob->steps == 'three')
                                <a   href="{{route('admin.courses.changeStatus',$ob->id)}}" >

                                    @if($ob->status == 'pending')
                                        <p class="btn btn-warning">{{__('in_review')}}</p>
                                    @elseif($ob->status == 'in_review')
                                        <p class="btn btn-success">{{__('activate')}}</p>
                                    @else
                                        <p class="btn btn-info">{{__('pending')}}</p>
                                    @endif
                                </a>
                                @else
                                    {{__('pending')}}
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info"  href="{{route('admin.courses.display',$ob->id)}}" >
                                    <i class="fas fa-link"></i>
                                </a>
                                <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.courses.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <!-- add model -->
    <div class="modal fade" id="addModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('add_courses')}}</h4></div>
                <form action="{{route('admin.courses.store')}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">{{__('save')}}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('close')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end add model -->

@endsection
@section('script')
@endsection
