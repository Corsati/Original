<!--start white bg-->
<div class="whiteBg">

    <hr class="customHr" />

    <!--start footer-->
    <div class="container">
        <footer class="footer d-flex justify-content-between align-items-center">
            <div class="d-flex flex-row align-items-center">
                <img src="{{setAsset('website/img/logoo.svg')}}" class="logo" alt="logo">
                <p class="desc">Copyright © 2020 Corsati, Inc.</p>
            </div>

            <ul class="d-flex flex-row align-items-center">
                <li><a href="{{route('coursati.term')}}">{{__('web.terms')}}</a></li>
                <li><a href="{{route('coursati.policy')}}">{{__('web.privacy_policy')}}</a></li>
                <li><a href="{{route('coursati.cookie')}}">{{__('web.cookie_policy')}}</a></li>
            </ul>
        </footer>
    </div>
    <!--end footer-->

</div>
<!--end white bg-->
