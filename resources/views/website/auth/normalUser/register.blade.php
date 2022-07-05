<!--start signUp modal-->
    <div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signUpModalLabel">{{__('web.sign_up')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{setAsset('website/img/close.png')}}" alt="close">
                    </button>
                    <div class="alert alert-danger" style="display:none"></div>
                </div>
                <div class="modal-body">
                    <form action="{{route('coursati.sign-up')}}" class="flex-column ajaxSubmit" id="ajaxSubmit" method="post" >
                        @csrf
                        <input type="hidden" name="user_type" value="2">
                        <div class="fullName d-flex justify-content-between align-items-center">
                            <div class="form-group">
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="{{__('web.first_name')}}">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="{{__('web.last_name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="{{__('web.email_address')}}">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" minlength="10" name="phone" id="phone" placeholder="{{__('web.phone_number')}}">
                        </div>
                        <div class="form-group countryForm" style="margin-bottom: 1.5rem">
                            <select class="selectpicker w-100" name="country_id" id="country" title="{{__('web.select_country')}}">
                                @foreach($countries as $country)
                                    <option {{$country->country_id == $country->id ? 'selected' :''}} value="{{$country->id}}">{{$country->getTranslation('name', lang())}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group countryForm">
                            <select  class="selectpicker   w-100 "  name="city_id"  id="cityId">
                                <option value=""  hidden>{{__('web.select_city')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="{{__('web.password')}}">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation" id="confirmPass" placeholder="{{__('web.pass_confirm')}}">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="orangeBtn" id="signUpModal">{{__('web.sign_up')}}</button>
                            <a data-toggle="modal" data-target="#loginModal" class="forget" data-dismiss="modal"> {{__('web.already_member')}}<span style="margin-right: 5px"> {{__('web.login_now')}} </span></a>
                        </div>
                    </form>
                    <hr class="customHr">
                    <div class="blackText">{{__('web.sign_up_social_media')}}</div>
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
                    <p class="haveAcc signingUp">{{__('web.agree_to')}}<a target="_blank" href="{{route('coursati.term')}}" ><span>{{__('web.terms_of_Use')}}</span></a>{{__('web.and')}}<a target="_blank" href="{{route('coursati.policy')}}" ><span>{{__('web.privacy_policy')}}</span></a>.</p>
                </div>
            </div>
        </div>
    </div>
    <!--end signUp modal-->