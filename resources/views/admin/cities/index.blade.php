@extends('admin.layout.master')
@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>{{__('cities')}}</h2>
                        <button type="button" data-toggle="modal" data-target="#addModel" class="btn btn-primary btn-wide waves-effect waves-light">
                          {{__('add_cities')}}
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
                        <th>{{__('name_ar')}}</th>
                        <th>{{__('name_en')}}</th>
                        <th>{{__('country')}}</th>
                        <th>{{__('control')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects as $ob)
                        <tr>
                            <td>{{$ob->getTranslation('name','ar')}}</td>
                            <td>{{$ob->getTranslation('name','en')}}</td>
                            <td>{{$ob->country->name}}</td>
                            <td>
                                <button class="btn btn-success mx-2"  onclick="edit({{$ob}})" data-toggle="modal" data-target="#editModel"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.cities.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
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
                <div class="modal-header"><h4 class="modal-title">{{__('add_cities')}}</h4></div>
                <form action="{{route('admin.cities.store')}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_ar')}}</label>
                                    <input type="text" name="name_ar" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_en')}}</label>
                                    <input type="text" name="name_en" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('country')}}</label>
                                    <select name="country_id" class="form-control" id="country_id" required>
                                        <option value="" selected hidden disabled>{{__('choose_country')}}</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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

    <!-- edit model -->
    <div class="modal fade" id="editModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('edit_country')}}</h4></div>
                <form action=""  id="editForm" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_ar')}}</label>
                                    <input type="text" name="name_ar" id="name_ar" class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('name_en')}}</label>
                                    <input type="text" name="name_en" id="name_en" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('country')}}</label>
                                    <select name="country_id" class="form-control" id="country_id" required>
                                        <option value="" selected hidden disabled>{{__('choose_country')}}</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
    <!-- end edit model -->

@endsection
@section('script')
    <script>

        function edit(ob){

            $('#editForm')      .attr("action","{{route('admin.cities.update','obId')}}".replace('obId',ob.id));
            $('#name_ar')       .val(ob.name.ar);
            $('#name_en')       .val(ob.name.en);

            $( '#country_id option' ).each( function () {
                if ( $( this ).val() == ob.country_id )
                     $( this ).attr( 'selected', '' )
            } );
        };

    </script>
@endsection
