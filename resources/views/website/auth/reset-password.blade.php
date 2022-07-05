@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.auth.normalUser.login')
    <div class="lightGrayBg guestGray" style="min-height: 700px">
        <div class="container">    <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Reset password') }}</div>
                        <div class="card-body">


                            <form method="POST" action="{{ route('coursati.password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" id="nameOremailInput" placeholder="{{ __('E-Mail Address') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="passwordInput" autocomplete="new-password" placeholder="{{__('New Password')}}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="passwordInput" autocomplete="new-password" placeholder="{{__('Confirm Password')}}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="orangeBtn" style="width: 100%;"  >{{__('web.send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('website.layouts.partial.footerDetails')
@endsection
