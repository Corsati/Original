@extends('admin.layout.master')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>عرض رسالة {{$message->name}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card page-body">
            <div class="row alert alert-primary">
                <div class="col-sm-4">اسم المرسل : {{$message->name}}</div>
                <div class="col-sm-4">البريد الالكتروني : {{$message->email}}</div>
                <div class="col-sm-4">التاريخ : {{$message->created_at->format('Y-m-d')}}</div>
            </div>
            <div class = "text-center p-5">
                <p>{{$message->message}}</p>
            </div>

            <div class = "row justify-content-center">
                <button class="btn btn-danger col-sm-3" onclick="confirmDelete('{{route('admin.contact_us.delete',$message->id)}}')" data-toggle="modal" data-target="#delete-model">
                     حذف الرسالة
                </button>

                {{--<button data-toggle = "modal" data-target = "#sms_msg" class = "col-sm-3 btn btn-info">--}}
                {{--ارسالة رسالة sms--}}
                {{--</button>--}}

                <button data-toggle = "modal" data-target = "#sendEmailModel" class = "col-sm-3 btn btn-success">ارسالة رسالة بالبريد الالكترونى</button>
                <a href = "{{route('admin.contact_us.index')}}" class = "col-sm-3 btn btn-warning">عودة لصندوق الوارد</a>

            </div>

        </div>
    </section>

    <x-admin.send-email  email="{{$message->email}}"/>
@endsection
