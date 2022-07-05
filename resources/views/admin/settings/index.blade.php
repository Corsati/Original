@extends('admin.layout.master')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="page-header callout-primary d-flex justify-content-between">
                        <h2>الاعدادات</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card page-body">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                  <ul class="nav nav-tabs text-md"  style="justify-content: space-around" role="tablist">

                    <li class="  nav-item">
                      <a class="nav-link  "  data-toggle="tab" href="#social-tab" role="tab" aria-controls="to-social" aria-selected="false">{{__('social_media')}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  data-toggle="pill" href="#policy-tab" role="tab" aria-controls="to-policy" aria-selected="false">{{__('policy')}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  data-toggle="pill" href="#terms-tab" role="tab" aria-controls="to-terms" aria-selected="false">{{__('terms')}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  data-toggle="pill" href="#about-tab" role="tab" aria-controls="to-about" aria-selected="false">{{__('about')}}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"  data-toggle="pill" href="#help-tab" role="tab" aria-controls="to-about" aria-selected="false">{{__('help')}}</a>
                    </li>
                    <li class="nav-item">
                          <a class="nav-link"  data-toggle="pill" href="#cookie_policy-tab" role="tab" aria-controls="to-cookie_policy" aria-selected="false">{{__('cookie_policy')}}</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">

                    <!---------------- Social ------------------>
                    <div class=" tab-pane active fade " id="social-tab" role="tabpanel" aria-labelledby="to-social">
                      <form accept="{{route('admin.settings.update')}}" method="post">
                        @method('put')
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('facebook')}}</label>
                                <input type="url" name="facebook" class="form-control" value="{{$data['facebook']}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('linkedin')}}</label>
                                    <input type="url" name="linkedin" class="form-control" value="{{$data['linkedin']}}"  required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('twitter')}}</label>
                                <input type="url" name="twitter" class="form-control" value="{{$data['twitter']}}"  required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('dribble')}}</label>
                                <input type="url" name="dribble" class="form-control" value="{{$data['dribble']}}"  required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('instgram')}}</label>
                                <input type="url" name="instgram" class="form-control" value="{{$data['instgram']}}"  required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('youtube')}}</label>
                                <input type="url" name="youtube" class="form-control" value="{{$data['youtube']}}"  required>
                             </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('behince')}}</label>
                                <input type="url" name="behince" class="form-control" value="{{$data['behince']}}"  required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"><button type="submit" class="btn btn-primary">{{__('save')}}</button></div>

                      </form>
                    </div>

                    <!---------------- Terms ------------------>
                    <div class="tab-pane fade" id="policy-tab" role="tabpanel" aria-labelledby="to-policy">

                      <form accept="{{route('admin.settings.update')}}" method="post">
                        @method('put')
                        @csrf

                        <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>{{__('policy_ar')}}</label>
                                <textarea name="policy_ar" class="form-control editor" rows="10">{{$data['policy_ar']}}</textarea>
                              </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{__('policy_en')}}</label>
                                  <textarea name="policy_en" class="form-control editor2" rows="10">{{$data['policy_en']}}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                              <div class="form-group"><button type="submit" class="btn btn-primary">{{__('save')}}</button></div>
                            </div>
                        </div>

                      </form>
                    </div>

                    <!---------------- About ------------------>
                    <div class="tab-pane fade" id="terms-tab" role="tabpanel" aria-labelledby="to-terms">
                      <form accept="{{route('admin.settings.update')}}" method="post">
                        @method('put')
                        @csrf

                        <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>{{__('terms_ar')}}</label>
                                <textarea name="terms_ar" class="form-control editor3"   rows="10">{{$data['terms_ar']}}</textarea>
                              </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label>{{__('terms_en')}}</label>
                                  <textarea name="terms_en" class="form-control editor4"   rows="10">{{$data['terms_en']}}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                              <div class="form-group"><button type="submit" class="btn btn-primary">{{__('save')}}</button></div>
                            </div>
                        </div>
                      </form>
                    </div>

                    <!---------------- Policy ------------------>
                    <div class="tab-pane fade" id="about-tab" role="tabpanel" aria-labelledby="to-about">
                      <form accept="{{route('admin.settings.update')}}" method="post">
                        @method('put')
                        @csrf

                        <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>{{__('about_ar')}}</label>
                                <textarea name="policy_ar" class="form-control editor9" rows="10">{{$data['about_ar']}}</textarea>
                              </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('about_en')}}</label>
                                  <textarea name="policy_en" class="form-control editor10" rows="10">{{$data['about_en']}}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('title_en')}}</label>
                                    <textarea name="title_en" class="form-control editor11" rows="10">{{$data['title_en']}}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('title_ar')}}</label>
                                    <textarea name="title_ar" class="form-control editor12" rows="10">{{$data['title_ar']}}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('description_en')}}</label>
                                    <textarea name="description_en" class="form-control editor13" rows="10">{{$data['description_en']}}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('description_ar')}}</label>
                                    <textarea name="description_ar" class="form-control editor14" rows="10">{{$data['description_ar']}}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group"><button type="submit" class="btn btn-primary">{{__('save')}}</button></div>
                            </div>
                        </div>
                      </form>
                    </div>


                      <div class="tab-pane fade" id="help-tab" role="tabpanel" aria-labelledby="to-about">
                      <form accept="{{route('admin.settings.update')}}" method="post">
                        @method('put')
                        @csrf

                        <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>{{__('help_ar')}}</label>
                                <textarea name="help_ar" class="form-control editor5"  rows="10">{{$data['help_ar']}}</textarea>
                              </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('help_en')}}</label>
                                  <textarea name="help_en" class="form-control editor6"   rows="10">{{$data['help_en']}}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group"><button type="submit" class="btn btn-primary">{{__('save')}}</button></div>
                            </div>
                        </div>
                      </form>
                    </div>

                    <div class="tab-pane fade" id="cookie_policy-tab" role="tabpanel" aria-labelledby="to-about">
                      <form accept="{{route('admin.settings.update')}}" method="post">
                        @method('put')
                        @csrf

                        <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>{{__('cookie_policy_ar')}}</label>
                                <textarea name="cookie_policy_ar" class="form-control editor7"  rows="10">{{$data['cookie_policy_ar']}}</textarea>
                              </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>{{__('cookie_policy_en')}}</label>
                                  <textarea name="cookie_policy_en" class="form-control editor8"   rows="10">{{$data['cookie_policy_en']}}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group"><button type="submit" class="btn btn-primary">{{__('save')}}</button></div>
                            </div>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
        </div>
    </section>

    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

    @section('script')

        <script>
            ClassicEditor
                .create( document.querySelector( '.editor' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor2' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor3' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor4' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor5' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor6' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor7' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor8' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor9' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor10' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor11' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor12' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor13' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '.editor14' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );

        </script>
    @endsection
@endsection
