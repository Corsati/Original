@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.auth.normalUser.login')
    @include('website.layouts.partial.categories')
    <div class="lightGrayBg guestGray" style="min-height: 700px">
        <div class="container">    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
    @include('website.layouts.partial.footerDetails')
@endsection
