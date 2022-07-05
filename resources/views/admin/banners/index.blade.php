@extends('admin.layout.master')
@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>{{__('banners')}}</h2>
                        <button type="button" data-toggle="modal" data-target="#addModel" class="btn btn-primary btn-wide waves-effect waves-light">
                            {{__('add_banners')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card page-body">
            <div class="table-responsive">
                <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                    <thead>
                    <tr>
                        <th>{{__('image')}}</th>
                        <th>{{__('status')}}</th>
                        <th>{{__('control')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects as $ob)
                        <tr>
                            <td>
                                <a href="{{$ob ->name}}" target="_blank">
                                    <img src="{{$ob ->name ?? '' }}" width="60" height="60">
                                </a>
                            </td>
                            <td>
                                @if($ob->active == 1)
                                    <p> <span class="badge badge-success">{{__('active')}}</span></p>
                                @else
                                    <p> <span class="badge badge-danger">{{__('un_active')}}</span></p>
                                @endif
                            </td>
                            <td>
                                @if($ob->active == 1)
                                    <a href="{{route('admin.banners.activate',$ob->id)}}"> <span class="badge badge-danger">{{__('un_activate')}}</span></a>
                                @else
                                    <a href="{{route('admin.banners.activate',$ob->id)}}"> <span class="badge badge-success">{{__('activate')}}</span></a>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.banners.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
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
                <div class="modal-header"><h4 class="modal-title">{{__('add_banners')}}</h4></div>
                <form action="{{route('admin.banners.store')}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="file" name="name" class="form-control">
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
