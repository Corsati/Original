@extends('admin.layout.master')
@section('content')


    <section class="content">
        <div class="card page-body">
            <div class="table-responsive">
                <table id="datatable-table" class="table table-striped table-bordered dt-responsive nowrap"  style="width:100%">
                    <thead>
                    <tr>
                        <th>{{__('id')}}</th>
                        <th>{{__('course_name')}}</th>
                        <th>{{__('course_user')}}</th>
                        <th>{{__('total')}}</th>
                        <th>{{__('control')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects as $ob)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>




@endsection
@section('script')

@endsection
