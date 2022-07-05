@extends('admin.layout.master')
@section('content')

    <style>
        .fa-plus
        {
           color: #fff;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        @if(request()->is('admin/main-categories'))
                          <a href="{{route('admin.categories.main')}}"> <h2>{{__('categories')}}</h2> </a>
                          @elseif(request()->route()->getName() == 'admin.categories.sub')
                            <div style="display: flex;justify-content: center">
                                <a href="{{route('admin.categories.main')}}"> <h2>{{__('categories')}}    </h2> </a>
                                @if(is_array($text))
                                @foreach($text as $t)
                                    <h2 style="color:#1B66A9; margin-left: 10px; margin-right: 10px">  >>  </h2>
                                    <a href="{{route('admin.categories.sub',$t['id'])}}"> <h2>{{$t['name']}}</h2> </a>
                                @endforeach
                                @else
                                    <h2 style="color:#1B66A9; margin-left: 10px; margin-right: 10px">  >>  </h2>
                                    <a href="{{route('admin.categories.sub',$text)}}"> <h2>{{$text}}</h2> </a>
                                @endif
                            </div>
                        @endif
                      <div >
                          @if(request()->route()->getName() != 'admin.categories.sub')
                          <button type="button" data-toggle="modal" data-target="#addModel" class="btn btn-primary btn-wide waves-effect waves-light">
                                {{__('add_categories')}}
                          </button>
                          @endif
                          @if(request()->route()->getName() == 'admin.categories.sub')
                          <button type="button" data-toggle="modal" data-target="#addModels" class="btn btn-primary btn-wide waves-effect waves-light">
                                {{__('add_sub_categories')}}
                          </button>
                         @endif

                      </div>
                    </div>
                    <div class="page-header callout-primary d-flex">
                        <div class="col-md-4">
                            <div class="stati turquoise left">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                <div>
                                    <b>{{count($objects)}}</b>
                                    <span>{{__('total')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stati turquoise left">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                <div>
{{--                                    <b>{{$main}}</b>--}}
                                    <span>{{__('total-main-categories')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stati turquoise left">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                <div>
                                    <b>{{$sub}}</b>
                                    <span>{{__('total-sub-categories')}}</span>
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
                        <th>{{__('name')}}</th>
                        <th>{{__('image')}}</th>
                        <th>{{__('description')}}</th>
                        <th>{{__('kind')}}</th>
                        <th>{{__('views')}}</th>
                        <th>{{__('parent')}}</th>
                        <th>{{__('courses')}}</th>
                        <th>{{__('categoriesCount')}}</th>
                        <th>{{__('last_update')}}</th>
                        <th>{{__('control')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects as $ob)

                        <tr>
                            <td>{{$ob->getTranslation('name','ar')}}  -  {{$ob->getTranslation('name','en')}}</td>
                            <td><img   src="{{$ob ->icon??''}}"    height="30" width="40"></td>
                            <td>{{$ob->getTranslation('description','ar')}}  -  {{$ob->getTranslation('description','en')}}</td>
                            <td>
                                @if($ob->parent_id == null)
                                   <p class="btn btn-primary">
                                       {{ __('main') }}
                                   </p>
                                @else
                                    <p class="btn btn-info">
                                        {{ __('child') }}
                                    </p>
                                @endif
                            </td>
                            <td><p   class="btn btn-primary">{{$ob->categoryViews->count()}}</p></td>
                            <td>{{$ob->getAllParents()}}</td>
                            <td><a   href="{{route('admin.courses.show',$ob->id)}}" class="btn btn-success" >{{count($ob->courses)}}</a></td>
                            <td>  <a href="{{route('admin.categories.sub',$ob->id)}}"> {{$ob->childes()->count()}}  أقسام فرعية </a></td>
                            <td>{{ $ob->created_at ? $ob->created_at->diffForHumans(): '-' }}</td>
                            <td>
                                <button class="btn btn-success mx-2"  onclick="edit({{$ob}})" data-toggle="modal" data-target="#editModel"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger" onclick="confirmDelete('{{route('admin.categories.delete',$ob->id)}}')" data-toggle="modal" data-target="#delete-model">
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
                <div class="modal-header"><h4 class="modal-title">{{__('add_categories')}}</h4></div>
                <form action="{{route('admin.categories.store')}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class = "col-sm-12 text-center">
                                <label class = "mb-0">{{__('avatar')}}</label>
                                <div class = "text-center">
                                    <div class = "images-upload-block single-image">
                                        <label class = "upload-img">
                                            <input type = "file" name = "icon" id = "image" accept = "image/*" class = "image-uploader" >
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </label>
                                        <div class = "upload-area"></div>
                                    </div>
                                </div>
                            </div>
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

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('metadata_ar')}}</label>
                                    <textarea  name="metadata_ar" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('metadata_en')}}</label>
                                    <textarea  name="metadata_en" class="form-control"></textarea>
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
    <!-- add model -->
    <div class="modal fade" id="addModels">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">{{__('add_sub_categories')}}</h4></div>
                <form action="{{route('admin.categories.store')}}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class = "col-sm-12 text-center">
                                <label class = "mb-0">{{__('avatar')}}</label>
                                <div class = "text-center">
                                    <div class = "images-upload-block single-image">
                                        <label class = "upload-img">
                                            <input type = "file" name = "icon" id = "image" accept = "image/*" class = "image-uploader" >
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </label>
                                        <div class = "upload-area"></div>
                                    </div>
                                </div>
                            </div>
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

                            @if(isset($id))
                                <input type="hidden" value="{{$id}}" name="parent_id">
                            @else
                                @if(request()->route()->getName() == 'admin.categories.sub')
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{__('category')}}</label>
                                            <select name="parent_id" class="form-control" id="parent_id" >
                                                <option value="" selected hidden value="">{{__('choose_parent')}}</option>
                                                @foreach($mainCategories as $category)
                                                    <option value="{{$category->id}}"> {{$category->getAllParents()}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                @endif
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('metadata_ar')}}</label>
                                    <textarea  name="metadata_ar" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('metadata_en')}}</label>
                                    <textarea  name="metadata_en" class="form-control"></textarea>
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
                <div class="modal-header"><h4 class="modal-title">{{__('edit_category')}}</h4></div>
                <form action=""  id="editForm" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class = "col-sm-12 text-center">
                                <label class = "mb-0">{{__('avatar')}}</label>
                                <div class = "text-center">
                                    <div class = "images-upload-block single-image">
                                        <label class = "upload-img">
                                            <input type = "file" name = "icon" id = "image" accept = "image/*" class = "image-uploader">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </label>
                                        <div class = "upload-area" id="upload_area_img"></div>
                                    </div>
                                </div>
                            </div>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('description_ar')}}</label>
                                    <textarea  name="description_ar" id="description_ar" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('description_en')}}</label>
                                    <textarea  name="description_en" id="description_en" class="form-control"></textarea>
                                </div>
                            </div>
                            @if(request()->route()->getName() == 'admin.categories.sub')
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('category')}}</label>
                                    <select name="parent_id" class="form-control" id="parent_id" >
                                        <option value="" selected hidden value="">{{__('choose_parent')}}</option>
                                        @foreach($objects as $category)
                                            <option value="{{$category->id}}"> {{$category->getAllParents()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('metadata_ar')}}</label>
                                    <textarea  name="metadata_ar" id="metadata_ar" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('metadata_en')}}</label>
                                    <textarea  name="metadata_en" id="metadata_en" class="form-control"></textarea>
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

            $('#editForm')             .attr("action","{{route('admin.categories.update','obId')}}".replace('obId',ob.id));
            $('#name_ar')              .val(ob.name.ar);
            $('#name_en')              .val(ob.name.en);
            $('#description_ar')              .val(ob.description.ar);
            $('#description_en')              .val(ob.description.en);
            $('textarea#metadata_ar')  .val(ob.metadata.ar);
            $('textarea#metadata_en')  .val(ob.metadata.en);
            $( '#parent_id option' )   .each( function () {
                if ( $( this ).val() == ob.parent_id )
                     $( this ).attr( 'selected', '' )
            } );

            let image = $( '#upload_area_img' );
            image.empty();
            image.append( '<div class="uploaded-block" data-count-order="1"><img src="' + ob.icon + '"><button class="close">&times;</button></div>' );
        };

        (function(){


            // Search function
            $.fn.dataTable.Api.register( 'alphabetSearch()', function ( searchTerm ) {
                this.iterator( 'table', function ( context ) {
                    context.alphabetSearch = searchTerm;
                } );

                return this;
            } );

            // Recalculate the alphabet display for updated data
            $.fn.dataTable.Api.register( 'alphabetSearch.recalc()', function ( searchTerm ) {
                this.iterator( 'table', function ( context ) {
                    draw(
                        new $.fn.dataTable.Api( context ),
                        $('div.alphabet', this.table().container())
                    );
                } );

                return this;
            } );


            // Search plug-in
            $.fn.dataTable.ext.search.push( function ( context, searchData ) {
                // Ensure that there is a search applied to this table before running it
                if ( ! context.alphabetSearch ) {
                    return true;
                }

                if ( searchData[0].charAt(0) === context.alphabetSearch ) {
                    return true;
                }

                return false;
            } );


            // Private support methods
            function bin ( data ) {
                var letter, bins = {};

                for ( var i=0, ien=data.length ; i<ien ; i++ ) {
                    letter = data[i].charAt(0).toUpperCase();

                    if ( bins[letter] ) {
                        bins[letter]++;
                    }
                    else {
                        bins[letter] = 1;
                    }
                }

                return bins;
            }

            function draw ( table, alphabet )
            {
                alphabet.empty();
                alphabet.append( 'Search: ' );

                var columnData = table.column(0).data();
                var bins = bin( columnData );

                $('<span class="clear active"/>')
                    .data( 'letter', '' )
                    .data( 'match-count', columnData.length )
                    .html( 'None' )
                    .appendTo( alphabet );

                for ( var i=0 ; i<26 ; i++ ) {
                    var letter = String.fromCharCode( 65 + i );

                    $('<span/>')
                        .data( 'letter', letter )
                        .data( 'match-count', bins[letter] || 0 )
                        .addClass( ! bins[letter] ? 'empty' : '' )
                        .html( letter )
                        .appendTo( alphabet );
                }

                $('<div class="alphabetInfo"></div>')
                    .appendTo( alphabet );
            }


            $.fn.dataTable.AlphabetSearch = function ( context ) {
                var table = new $.fn.dataTable.Api( context );
                var alphabet = $('<div class="alphabet"/>');

                draw( table, alphabet );

                // Trigger a search
                alphabet.on( 'click', 'span', function () {
                    alphabet.find( '.active' ).removeClass( 'active' );
                    $(this).addClass( 'active' );

                    table
                        .alphabetSearch( $(this).data('letter') )
                        .draw();
                } );

                // Mouse events to show helper information
                alphabet
                    .on( 'mouseenter', 'span', function () {
                        alphabet
                            .find('div.alphabetInfo')
                            .css( {
                                opacity: 1,
                                left: $(this).position().left,
                                width: $(this).width()
                            } )
                            .html( $(this).data('match-count') );
                    } )
                    .on( 'mouseleave', 'span', function () {
                        alphabet
                            .find('div.alphabetInfo')
                            .css('opacity', 0);
                    } );

                // API method to get the alphabet container node
                this.node = function () {
                    return alphabet;
                };
            };

            $.fn.DataTable.AlphabetSearch = $.fn.dataTable.AlphabetSearch;


            // Register a search plug-in
            $.fn.dataTable.ext.feature.push( {
                fnInit: function ( settings ) {
                    var search = new $.fn.dataTable.AlphabetSearch( settings );
                    return search.node();
                },
                cFeature: 'A'
            } );


        }());
    </script>
@endsection
