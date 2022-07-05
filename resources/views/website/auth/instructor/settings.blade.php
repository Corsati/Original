@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.headerDetails')
    <div class="content w-78">
        <!--start light gray bg-->
        <div class="lightGrayBg pb-4">
            <div class="container-sm container-md-none px-md-5 py-md-2 pr-120">

                <div class="mt-30">
                    <h2 class="title">{{__('web.Settings')}}</h2>
                    <p class="desc">{{__('web.Customize and change your preference')}}</p>
                </div>

                <div class="d-block d-xl-flex flex-row justify-content-between align-items-start settingsCont flex-wrap w-100 mt-30 ">

                    <div class="generalSettings">

                        <div class="whiteBg px-3 py-4">
                            <h3 class="title">{{__('web.General settings')}}</h3>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="subTitle">{{__('web.language')}}</span>
                                <a href="{{route('coursati.language')}}" >
                                    @if(App::getLocale() == 'en')
                                        <img src="{{setAsset('website/img/saudi-arabia.png')}}"  style="width :32px;" class="" alt="lang">
                                    @else
                                        <img src="{{setAsset('website/img/uk.svg')}}"  class="" alt="lang">
                                    @endif
                                </a>
                            </div>
                        </div>

                        <div class="whiteBg px-3 py-4 mt-4">
                            <h3 class="title">{{__('web.Account settings')}}</h3>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <span class="subTitle">{{__('web.change password')}}</span>
                                <a href="{{route('coursati.profile')}}" class="orangeBtn">{{__('web.Change now')}}</a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2 borderTop">
                                <span class="subTitle">{{__('web.close account')}}</span>
                                <a  id="close-account" href="#" class="orangeBtn closeAcc">{{__('web.close account')}}</a>
                            </div>
                        </div>

                        <div class="whiteBg px-3 py-4 mt-4">
                            <form method="POST" action="{{route('coursati.updateUserSettings')}}">
                                @csrf
                                <h3 class="title">{{__('web.Notifications settings')}}</h3>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="subTitle">{{__('web.type of notifications')}}</span>
                                    <select class="selectpicker" id="notiType" title="Email & sms">
                                        <option selected>{{__('web.Email')}}</option>
                                        {{--<option>{{__('web.SMS')}}</option>--}}
                                    </select>
                                </div>

                                    <div class="d-flex justify-content-between align-items-center mt-3 borderTop pt-3">
                                        <span class="subTitle">{{__('web.New purchases')}}</span>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" {{auth()->user()->setting->purchase ? 'checked' :''}} value="{{auth()->user()->setting->purchase}}" class="custom-control-input" id="purchases" name="purchases">
                                            <label class="custom-control-label subTitle" for="purchases"/>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3 borderTop pt-3">
                                        <span class="subTitle">{{__('web.New chat')}}</span>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" {{auth()->user()->setting->chat ? 'checked' :''}} value="{{auth()->user()->setting->chat}}" class="custom-control-input" id="chat" name="chat">
                                            <label class="custom-control-label subTitle" for="chat"/>
                                        </div>
                                    </div>
                                <!--
                                <div class="d-flex justify-content-between align-items-center mt-3 borderTop pt-3">
                                    <span class="subTitle">{{__('web.Payouts')}}</span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" {{auth()->user()->setting->purchase ? 'checked' :''}} value="{{auth()->user()->setting->purchase}}" class="custom-control-input" id="Payouts" name="Payouts">
                                        <label class="custom-control-label subTitle" for="Payouts"/>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3 borderTop pt-3">
                                    <span class="subTitle">{{__('web.Cancelled purchases')}}</span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="CancelledPurchases" name="CancelledPurchases">
                                        <label class="custom-control-label subTitle" for="CancelledPurchases"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3 borderTop pt-3">
                                    <span class="subTitle">New community messages</span>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="community" name="community">
                                        <label class="custom-control-label subTitle" for="community"/>
                                    </div>
                                </div>
                                -->
                                    <div class="d-flex justify-content-between align-items-center mt-3 borderTop pt-3">
                                        <span class="subTitle">{{__('web.Course approval')}}</span>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="course" {{auth()->user()->setting->course_status ? 'checked' :''}} value="{{auth()->user()->setting->course_status}}" class="custom-control-input" id="approval"  >
                                            <label class="custom-control-label subTitle" for="approval"/>
                                        </div>
                                    </div>



                                <div class="d-flex align-items-center mt-3 mb-3">
                                    <button type="submit" class="orangeBtn mr-3">{{__('web.Save changes')}}</button>
                                    <button type="submit" class="orangeBtn grayBtn">{{__('web.Cancel')}}</button>
                                </div>
                                </form>
                        </div>


                    </div>

                    <div class="payment whiteBg px-3 py-4">
                        <h3 class="title">Payout</h3>
                        <form class="mt-3">
                            <div class="PayOptions">
                                <img src="{{setAsset('website/img/visa.svg')}}" alt="visa">
                                <img src="{{setAsset('website/img/master.svg')}}" alt="master">
                                <img src="{{setAsset('website/img/discover.svg')}}" alt="discover">
                            </div>

                            <div class="form-group">
                                <label for="cardNum">Card number</label>
                                <input type="password" class="form-control" id="cardNum" placeholder="xxxx - xxxx - xxx - xxxx - xxxx">
                            </div>

                            <div class="form-group">
                                <label for="cvcNum">CVC number</label>
                                <input type="password" class="form-control" id="cvcNum" placeholder="XXX">
                            </div>

                            <div class="form-group">
                                <label for="monthYear">Expires</label>
                                <div id="monthYear" class="monthYear d-flex justify-content-between align-items-center mb-0">
                                    <select class="selectpicker" id="month" title="Chose month">
                                        <option>jan</option>
                                        <option>feb</option>
                                    </select>
                                    <select class="selectpicker" id="year" title="Year">
                                        <option>2000</option>
                                        <option>2001</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="orangeBtn">Confirm</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--end light gray bg-->
@include('website.layouts.partial.footerDashboard')
</div>
</div>
@endsection

@push('scripts')
    @include('website.js.settings')
@endpush