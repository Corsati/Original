<div class="whiteBg">
@if( !request()->is('teacher-dashboard'))
        @if(auth()->guest())
            <div class="container">
                <div class="register d-flex flex-row align-items-center">
                    <img src="{{setAsset('website/img/vector.svg')}}" class="d-none d-lg-block" alt="boy">
                    <div class="regText">
                        <h2 class="title">{{__('web.Register-trainer')}}</h2>
                        <p class="desc">  {{__('web.become')}}</p>
                    </div>
                    <a href="{{route('coursati.teachOnCoursati')}}" class="orangeBtn">{{__('web.sign_up_now')}}</a>
                </div>
        @endif
        @if(auth()->user())
            @if(auth()->user()->user_type == 2 )
                    <div class="container">
                        <div class="register d-flex flex-row align-items-center">
                            <img src="{{setAsset('website/img/vector.svg')}}" class="d-none d-lg-block" alt="boy">
                            <div class="regText">
                                <h2 class="title">{{__('web.Register-trainer')}}</h2>
                                <p class="desc">  {{__('web.become')}}</p>
                            </div>
                            <a href="{{route('coursati.upgradeToInstructor')}}" class="orangeBtn">{{__('web.upgrade')}}</a>
                        </div>
            @endif
        @endif
   </div>
   <!--end register-->
@endif
   <hr class="customHr" />

   <!--start links-->
   <div class="container">
       <div class="footLinks d-flex justify-content-between align-items-center">
           <div>
               <a href="{{route('coursati.contactUs')}}">         {{__('web.advertise_with_us')}}</a>
               <a href="{{route('coursati.aboutUs')}}">           {{__('web.about_us')}}</a>
           </div>
           <div>
               <a href="{{route('coursati.contactUs')}}">         {{__('web.contact_us')}}</a>
               <a href="{{route('coursati.help')}}">              {{__('web.help_support')}}</a>
           </div>
           <div>
               <a href="{{route('coursati.explore-categories')}}">{{__('web.explore_categories')}}</a>
               @if(auth()->guest())
                   <a href="{{route('coursati.teachOnCoursati')}}">   {{__('web.teach_on_coursati')}}</a>
               @endif
               @if(auth()->user())
                   @if(auth()->user()->user_type == 2 )
                       <a href="{{route('coursati.upgradeToInstructor')}}">   {{__('web.upgrade')}}</a>
                   @endif
               @endif
           </div>
           <div >
               <a href="{{route('coursati.language')}}" >
                   @if(App::getLocale() == 'en')
                       <p class="languageBtn">العربية</p>
                   @else
                      <p class="languageBtn">English</p>
                   @endif
               </a>
           </div>

       </div>
   </div>
   <!--end links-->
   <hr class="customHr" />
</div>
<!--start footer-->
<div class="container">
   <footer class="footer d-flex justify-content-between align-items-center">

       <div class="d-flex flex-row align-items-center">
           <img src="{{setAsset('website/img/logoo.svg')}}" class="logo" alt="logo">
           <p class="desc">Copyright © 2020 Corsati, Inc.</p>
       </div>
       <div class="socials">
           <a target="_blank" href="https://www.facebook.com/Corsationline-101322578393863/" class="me-4 text-reset">
               <i class="fab fa-facebook-f"></i>
           </a>
           <a target="_blank" href="https://twitter.com/CorsatiO" class="me-4 text-reset">
               <i class="fab fa-twitter"></i>
           </a>
           <a target="_blank" href="https://www.youtube.com/channel/UClmvlhNZ125yM7XQvPrgCzw" class="me-4 text-reset">
               <i class="fab fa-youtube"></i>
           </a>
           <a target="_blank" href="https://www.linkedin.com/company/corsati/?lipi=urn%3Ali%3Apage%3Ad_flagship3_search_srp_all%3BLR5pNkORRsG7uMzY6JAiNw%3D%3D" class="me-4 text-reset">
               <i class="fab fa-linkedin"></i>
           </a>

       </div>

       <ul class="d-flex flex-row align-items-center">
           <li><a href="{{route('coursati.term')}}"> {{__('web.terms')}} </a></li>
           <li><a href="{{route('coursati.policy')}}"> {{__('web.privacy_policy')}} </a></li>
           <li><a href="{{route('coursati.cookie')}}"> {{__('web.cookie_policy')}} </a></li>
       </ul>
   </footer>
</div>
<!--end footer-->
