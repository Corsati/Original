@extends('admin.layout.master')
@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>{{__('contact_us_messages')}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card page-body">
            <div class="table-responsive">
                <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                    <thead>
                    <tr>
                        <th>{{__('sender_name')}}</th>
                        <th>{{__('email')}}</th>
                        <th>{{__('phone')}}</th>
                        <th>{{__('message')}}</th>
                        <th>{{__('reason')}}</th>
                        <th>{{__('date')}}</th>
                        <th>{{__('control')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $ob)

                        <tr style="{{!$ob->seen ? 'background-color:#ffe4c4':''}}">
                            <td>{{$ob->name}}</td>
                            <td>{{$ob->email}}</td>
                            <td>{{$ob->phone}}</td>
                            <td>{{$ob->type->name}}</td>
                            <td>{{mb_substr($ob->message,0,100)}}</td>
                            <td>{{$ob->created_at->format('Y-m-d')}}</td>
                            <td>
                                <a href="{{route('admin.contact_us.show',$ob->id)}}" class="btn btn-primary mx-2" ><i class="fas fa-eye"></i></a>
                                <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.contact_us.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
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

@endsection
