@extends('admin.layout.master')

@section('style')
    <style>

        body{
            background-image: url("{{setAsset('dashboard/images/cover.jpg')}}"), url("{{setAsset('dashboard/images/cover.jpg')}}")
        }
        .content-wrapper{
            min-height: 0 !important;
        }
        .center-login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translateX(-50%) translateY(-50%);
            -webkit-transform: translate(-50%,-50%);
            transform: translate(-50%,-50%);

        }
    </style>
@endsection

@section('content')
    <div class="login-box center-login-form" style="">

        <div class="login-logo" style="background-color: #fff; ">
              <div ><img src="{{setAsset('images/logo/logo.png')}}" alt="Logo" style="width:200px; margin: 20px" /></div>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg"></p>
                <form action="{{route('admin.login')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="{{ __('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="{{ __('password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember" value="1">
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('log_in') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
