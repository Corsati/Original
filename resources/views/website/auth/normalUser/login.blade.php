    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">{{__('web.login_now')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{setAsset('website/img/close.png')}}" alt="close">
                    </button>
                </div>
                <div class="modal-body" style="overflow: hidden;">
                    <form action="{{route('coursati.userLogin')}}" class="ajaxLoginSubmit" id="ajaxLoginSubmit" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" id="nameOremailInput" placeholder="{{__('web.email')}}">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" id="passwordInput" placeholder="{{__('web.password')}}">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="orangeBtn"  >{{__('web.login_now')}}</button>
                            <a data-toggle="modal" data-target="#forgetModal" data-dismiss="modal" class="forget"> {{__('web.forgot_password')}} <span style="margin-right: 5px;margin-left: 5px">  {{__('web.reset')}}  </span></a>
                        </div>
                    </form>
                    <hr class="customHr">

                    <div class="blackText">{{__('web.continue_social_media')}}</div>

                    <div class="socialBtns d-flex justify-content-center align-items-center">
                        <a href="{{ url('/login/google') }}" class="google orangeBtn">
                            <img src="{{setAsset('website/img/google.svg')}}" alt="google">
                        </a>
                        <div class="mar-t-b-10"></div>
                        <a href="{{ url('/login/linkedin') }}" class="linkedIn orangeBtn">
                            <img src="{{setAsset('website/img/linked.svg')}}" alt="linked in">
                        </a>
                    </div>
                    <hr class="customHr">
                    <a data-toggle="modal" data-target="#signUpModal" class="haveAcc" data-dismiss="modal">{{__('web.not_have_account')}} <span style="margin-right: 5px;margin-left: 5px"> {{__('web.sign_up_now')}}</span></a>

                </div>
            </div>
        </div>
    </div>
