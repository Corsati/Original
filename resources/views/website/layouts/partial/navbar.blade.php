<!--  Start Header  -->
<style>
    .border-li{
        border-bottom: .5px solid #ddd;
        padding: 5px;
    }
</style>
@if(auth()->guest())
    <header class="loginHeader">
        <div class="container" >
            <div class="menuBar d-flex d-md-none justify-content-between align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <a href="{{route('coursati.cart')}}" class="cart">
                        <img src="{{setAsset('website/img/cart.svg')}}" class="cartImg" alt="cart">
                    </a>
                    <a class="toggleSearch">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
                <a href="{{route('coursati.indexGuest')}}">
                    <img src="{{setAsset('website/img/logoo.svg')}}" class="logo" alt="logo">
                </a>
                <div class="toggle">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </div>
            <div class="mobileSearch">
                <form class="d-flex searchContainer" id="search-advanced" method="POST" action="{{route('coursati.search')}}">
                    @csrf
                    <a href="javascript:{}" onclick="document.getElementById('search-advanced').submit();">
                        <i class="fas fa-search"></i>
                    </a>
                    <input type="text" required name="name_search" class="courses_search"   placeholder="{{__('web.What do you want to learn?')}}">
                </form>
                <a class="toggleSearch">
                    <i class="fas fa-times-circle"></i>
                </a>
            </div>
            <div class="overlay"></div>
            <div class=" menu d-flex flex-wrap align-items-center">
                <a href="{{route('coursati.indexGuest')}}"class="d-none d-md-block mr-27">
                    <img src="{{setAsset('website/img/logoo.svg')}}" class="logo" alt="logo">
                </a>
                <div class="user userAuth d-md-none">
                    <a data-toggle="modal" data-target="#loginModal">{{__('web.login')}}</a>
                    <a data-toggle="modal" data-target="#signUpModal">{{__('web.signUp')}}</a>
                </div>
                <div class="catLink mr-27">
                    <i class="fas fa-th mr-1 "></i>
                    <span class="catLink">{{__('web.categories')}}</span>
                    <ul class="sub-menu">
                        @foreach($main as $category)
                            <li class="dirLi">
                                <a href="{{route('coursati.category',[ 'id' => $category->id , 'name' => make_slug($category->name)])}}">
                                    <div><img src="{{$category->icon}}" alt="">{{$category->name}}</div>
                                    @if($category->childes->count() > 0)
                                        <i class='fas fa-chevron-right'></i>
                                    @endif
                                </a>
                                @if($category->childes->count())
                                    <ul class="d-none d-md-block">
                                        @foreach($category->childes as $subcategory)
                                            <li>
                                                <a href="{{route('coursati.category',[  'id' => $subcategory->id,'name' => make_slug($subcategory->name)])}}">
                                                    <div><img src="{{ $subcategory->icon }}" alt="">{{ $subcategory->name }}</div>
                                                    @if($subcategory->childes->count() > 0)
                                                        <i class='fas fa-chevron-right'></i>
                                                    @endif
                                                </a>
                                                @if($subcategory->childes->count())
                                                    <ul class="d-none d-md-block">
                                                        @foreach($subcategory->childes as $cat)
                                                            <li>
                                                                <a href="{{route('coursati.category',[  'id' => $cat->id,'name' => make_slug($cat->name)])}}">
                                                                    <div><img src="{{ $cat->icon }}"
                                                                              alt="">{{ $cat->name }}</div>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="searchDiv d-none d-md-block mr-27">
                    <form id="search-advanced" method="POST" action="{{route('coursati.search')}}">
                        @csrf
                        <input type="text" required class="courses_search"  name="name_search" id='courses_search' placeholder="{{__('web.What do you want to learn?')}}">

                        <a href="javascript:{}" onclick="document.getElementById('search-advanced').submit();"> <i class="fas fa-search"></i></a>
                    </form>
                </div>

            @if(!auth()->guest())
                <!-- Only for student if want to upgrade -->
                    @if(auth()->user()->user_type == 2 )
                        <a href="{{route('coursati.upgradeToInstructor')}}" style="font-size: 12px" class="gradientBg mr-27">
                            {{__('web.teach_on_coursati')}}
                        </a>
                    @elseif(auth()->user()->user_type == 3 && !auth()->user()->instructor )
                        <a href="{{route('coursati.teachQualifications')}}" style="font-size: 12px" class="gradientBg mr-27">
                            {{__('web.complete_profile')}}
                        </a>
                    @elseif(auth()->user()->user_type == 3 && auth()->user()->instructor )
                        @if(!request()->is('teacher-dashboard'))
                            <a href="{{route('coursati.teacherDashboard')}}" style="font-size: 12px" class="gradientBg mr-27">
                                {{__('web.dashboard')}}
                            </a>
                        @endif
                    @else
                        <a href="{{route('coursati.teachOnCoursati')}}" style="font-size: 12px" class="gradientBg mr-27">
                            {{__('web.teach_on_coursati')}}
                        </a>
                    @endif
                @else
                    <a href="{{route('coursati.teachOnCoursati')}}"  style="font-size: 12px" class="gradientBg mr-27">
                        {{__('web.teach_on_coursati')}}
                    </a>
                @endif
                <div class="cartDiv align-items-center mr-27  d-none d-md-flex">
                    @if(auth()->guest())
                        <a  data-toggle="modal" data-target="#loginModal" class="cart mr-27">
                            <img src="{{setAsset('website/img/cart.svg')}}" class="cartImg" alt="cart">
                        </a>
                    @else
                        <a href="{{route('coursati.cart')}}" class="cart mr-27">
                            <img src="{{setAsset('website/img/cart.svg')}}" class="cartImg" alt="cart">
                        </a>
                    @endif
                    <a id="visible"  style="position: relative" href="https://twitter.com/CorsatiO" target="_blank" class="twitter mr-27 dropdown"  >
                        <img  src="{{setAsset('website/img/twitter.svg')}}" class="cartImg   "  alt="twitter">

                        <!--
                         <ul class="list-group" id="hidden" style="">
                             <i class="list-group-item">
                                 <a>
                                     <li class="fab fa-facebook" style="color: #4267B2"></li>
                                 </a>
                             </i>
                             <i class="list-group-item">
                                 <a>
                                     <i class="fab fa-youtube"  style="color: #F00"></i>
                                 </a>
                             </i>
                             <i class="list-group-item">
                                 <a>
                                     <i class="fab fa-linkedin"  style="color:#0B65C2;"></i>
                                 </a>
                             </i>

                         </ul>
                        -->
                    </a>

                    <div class="line mr-27"></div>
                    <div class="auth"  >
                        <a data-toggle="modal" data-target="#loginModal">{{__('web.login')}}</a>
                        <a data-toggle="modal" data-target="#signUpModal">{{__('web.signUp')}}</a>
                    </div>

                </div>
                <div id="hidden"><h1>hi</h1></div>


                <a   href="{{route('coursati.language')}}" class="flagImg d-none d-md-flex">
                    @if(App::getLocale() == 'en')
                        <p style="color: #bbbbbb; border: 1px solid #4D4D4D;border-radius: 10px;padding: 4px;   font-size: 12px;">العربية</p>
                    @else
                        <p style="color: #bbbbbb; border: 1px solid #4D4D4D;border-radius: 10px;padding: 4px;   font-size: 12px;">English</p>
                    @endif
                </a>
            </div>


        </div>
    </header>
@else

    <header>
        <div class="container">

            <div class="menuBar d-flex d-md-none justify-content-between align-items-center">
                <div class="d-flex flex-row align-items-center">
                    <a href="{{route('coursati.cart')}}" class="cart mr-27">
                        <img src="{{setAsset('website/img/cart.svg')}}" class="cartImg" alt="cart">
                    </a>
                    <a class="toggleSearch">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
                <a href="{{route('coursati.indexGuest')}}">
                    <img src="{{setAsset('website/img/logoo.svg')}}" class="logo" alt="logo">
                </a>
                <div class="toggle">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </div>

            <div class="mobileSearch">
                <div class="d-flex searchContainer">
                    <form id="search-advanced" method="POST" action="{{route('coursati.search')}}">
                        @csrf
                        <input type="text" class="courses_search"  required name="name_search" placeholder="{{__('web.What do you want to learn?')}}">
                        <a href="javascript:{}" onclick="document.getElementById('search-advanced').submit();"> <i class="fas fa-search"></i></a>
                    </form>
                </div>
                <a class="toggleSearch">
                    <i class="fas fa-times-circle"></i>
                </a>
            </div>

            <div class="overlay"></div>

            <div class="menu d-flex flex-wrap align-items-center">

                <a href="{{route('coursati.indexGuest')}}" class="d-none d-md-block mr-18">
                    <img src="{{setAsset('website/img/logoo.svg')}}" class="logo" alt="logo">
                </a>

                <a href="{{route('coursati.profile')}}" class="user d-md-none">
                    <img src="{{setAsset('website/img/pic.jpg')}}" class="img-fluid" alt="profile">
                    <p>
                        hi, {{auth()->user()->first_name}}
                    </p>
                    <!--<a href="#">-->
                    <!--<i class="fas fa-chevron-right"></i>-->
                    <!--</a>-->
                </a>

                <a href="#" class="catLink mr-18 d-md-none">
                    <i class="fas fa-bell mr-1"></i>
                    <span>{{__('web.Notifications')}}</span>
                </a>

                <a href="{{route('coursati.favourites')}}" class="catLink mr-18 d-md-none">
                    <i class="fas fa-heart mr-1"></i>
                    <span>{{__('web.Wishlist')}}</span>
                </a>

                <div class="catLink mr-18">
                    <i class="fas fa-th mr-1"></i>
                    <span class="catLink">{{__('web.categories')}}</span>
                    <ul class="sub-menu">
                        @foreach($main as $category)
                            <li class="dirLi">
                                <a href="{{route('coursati.category',[ 'id' => $category->id , 'name' => make_slug($category->name)])}}">
                                    <div><img src="{{$category->icon}}" alt="">{{$category->name}}</div>
                                    @if($category->childes->count() > 0)
                                        <i class='fas fa-chevron-right'></i>
                                    @endif
                                </a>
                                @if($category->childes->count())
                                    <ul class="d-none d-md-block">
                                        @foreach($category->childes as $subcategory)
                                            <li>
                                                <a href="{{route('coursati.category',[  'id' => $subcategory->id,'name' => make_slug($subcategory->name)])}}">
                                                    <div><img src="{{ $subcategory->icon }}"
                                                              alt="">{{ $subcategory->name }}</div>
                                                    @if($subcategory->childes->count() > 0)
                                                        <i class='fas fa-chevron-right'></i>
                                                    @endif
                                                </a>
                                                @if($subcategory->childes->count())
                                                    <ul class="d-none d-md-block">
                                                        @foreach($subcategory->childes as $cat)
                                                            <li>
                                                                <a href="{{route('coursati.category',[  'id' => $cat->id,'name' => make_slug($cat->name)])}}">
                                                                    <div><img src="{{ $cat->icon }}"
                                                                              alt="">{{ $cat->name }}</div>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach

                    </ul>
                </div>

                <a href="{{route('coursati.myCourses')}}" class="catLink d-md-none">
                    <i class="fas fa-book-reader"></i>
                    <span>{{__('web.my_courses')}}</span>
                </a>
                <div class="searchDiv d-none d-md-block mr-27">
                    <form id="search-advanced" method="POST" action="{{route('coursati.search')}}">
                        @csrf
                        <input type="text" required name="name_search"  class="courses_search" placeholder="{{__('web.What do you want to learn?')}}">
                        <a href="javascript:{}" onclick="document.getElementById('search-advanced').submit();"> <i class="fas fa-search"></i></a>
                    </form>
                </div>

                @if(!auth()->guest())
                    @if(auth()->user()->user_type == 2 )
                        <a href="{{route('coursati.upgradeToInstructor')}}" class="gradientBg mr-27">
                            {{__('web.teach_on_coursati')}}
                        </a>
                    @elseif(auth()->user()->user_type == 3 && !auth()->user()->instructor )
                        <a href="{{route('coursati.teachQualifications')}}" class="gradientBg mr-27">
                            {{__('web.complete_profile')}}
                        </a>
                    @elseif(auth()->user()->user_type == 3 && auth()->user()->instructor )
                        @if(!request()->is('teacher-dashboard'))
                            <a href="{{route('coursati.teacherDashboard')}}" class="gradientBg mr-27">
                                {{__('web.dashboard')}}
                            </a>
                        @endif
                    @else
                        <a href="{{route('coursati.teachOnCoursati')}}" class="gradientBg mr-27">
                            {{__('web.teach_on_coursati')}}
                        </a>
                    @endif
                @else
                    <a href="{{route('coursati.teachOnCoursati')}}" class="gradientBg mr-27">
                        {{__('web.teach_on_coursati')}}
                    </a>
                @endif

                <div class="cartDiv align-items-center mr-18 d-none d-md-flex">
                    <a href="{{route('coursati.cart')}}" class=" cart mr-18">
                        <img src="{{setAsset('website/img/cart.svg')}}" class="cartImg" alt="cart">
                        @if(!auth()->guest())
                            @if(count(auth()->user()->cart) > 0)
                                <span style="padding: 5px;
    background-color: #F00;
    border-radius: 35px;
    width: 20px;
    height: 20px;
    text-align: center;
    font-size: 12px;
    color: #fff;
    margin-bottom: 10px;
    margin: 5px;
    line-height: 10px;">{{count(auth()->user()->cart)}}</span>
                            @endif
                        @endif
                    </a>
                    <a href="https://twitter.com/CorsatiO" target="_blank" class="twitter mr-18">
                        <img src="{{setAsset('website/img/twitter.svg')}}" class="cartImg" alt="twitter">
                    </a>
{{--                    <div class="line mr-27"></div>--}}
                    <a href="{{route('coursati.favourites')}}" class="mr-18">
                        <img src="{{setAsset('website/img/heart.svg')}}" class="bell" alt="like">
                    </a>
                    <a href="{{route('coursati.notifications')}}" class="mr-18">
                        @if(auth()->check())
                            @if(count(auth()->user()->unreadNotifications) > 0)
                              <span class="notification-counter">{{count(auth()->user()->unreadNotifications)}}</span>
                            @endif
                        @endif
                        <img src="{{setAsset('website/img/bell.png')}}" class="bell" alt="notification">
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav myProfileMenu">
                            <li class="dropdown  " style="margin: 0">
                                <a class="profilePic " data-toggle="dropdown">
                                    <img src="{{auth()->user()->avatar}}" class="img-fluid" alt="profile">
                                </a>
                                <ul class="dropdown-menu" >
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu" style=" width: 260px;margin: auto;">
                                            <li >
                                                <a href="{{route('coursati.profile')}}" class="user avatar-container" >
                                                    <img   style="border-radius: 20px" src="{{auth()->user()->avatar}}" class="img-fluid" alt="profile">
                                                    <p class="avatar-container-p" >
                                                        Hi, {{auth()->user()->first_name}}
                                                        <span style="font-size: 12px;color : #584b4b"> {{auth()->user()->email}}</span>
                                                    </p>
                                                </a>
                                            </li>

                                            @if(auth()->user()->user_type == 2)

                                                <li class="avatar-container-li">
                                                    <a  class="myA" href="{{route('coursati.profile')}}">
                                                        {{__('web.profile')}}
                                                    </a>
                                                </li>
                                                <li class="avatar-container-li">
                                                    <a  class="myA" href="{{route('coursati.myCourses')}}">
                                                        {{__('web.My courses')}}
                                                    </a>
                                                </li>
                                                <li class="avatar-container-li">
                                                    <a  class="myA" href="{{route('coursati.cart')}}">
                                                        {{__('web.shopping cart')}}
                                                    </a>
                                                </li>
                                                <li class="avatar-container-li">
                                                    <a  class="myA" href="{{route('coursati.favourites')}}">
                                                        {{__('web.favourites')}}
                                                    </a>
                                                </li>
                                                <li class="avatar-container-li">
                                                    <a  class="myA" href="{{route('coursati.notifications')}}">
                                                        {{__('web.notifications')}}
                                                    </a>
                                                </li>


                                            @else
                                                <li class="avatar-container-li">
                                                    <a   class="myA" href="{{route('coursati.profile')}}">
                                                        {{__('web.profile')}}
                                                    </a>
                                                </li>
                                                <li class="avatar-container-li">
                                                    <a  class="myA" href="{{route('coursati.teacherDashboard')}}">
                                                        {{__('web.dashboard')}}
                                                    </a>
                                                </li>
                                                <li class="avatar-container-li">
                                                    <a  class="myA" href="{{route('coursati.myCourses')}}">
                                                        {{__('web.My courses')}}
                                                    </a>
                                                </li>
                                                <li class="avatar-container-li">
                                                    <a  class="myA" href="{{route('coursati.cart')}}">
                                                        {{__('web.shopping cart')}}
                                                        @if(!auth()->guest())
                                                            @if(count(auth()->user()->cart) > 0)
                                                                <span style="padding: 5px;
    background-color: #F00;
    border-radius: 35px;
    width: 20px;
    height: 20px;
    text-align: center;
    font-size: 12px;
    color: #fff;
    margin-bottom: 10px;
    margin: 5px;
    line-height: 10px;">{{count(auth()->user()->cart)}}</span>
                                                            @endif
                                                        @endif

                                                    </a>
                                                </li>
                                                <li class="avatar-container-li">
                                                    <a  class="myA" href="{{route('coursati.favourites')}}">
                                                        {{__('web.favourites')}}
                                                    </a>
                                                </li>
                                                <li class="avatar-container-li">
                                                    <a class="myA" href="{{route('coursati.notifications')}}">
                                                        {{__('web.notifications')}}
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="avatar-container-li">
                                                <a  class="myA" href="{{route('coursati.language')}}" >
                                                    @if(App::getLocale() == 'en')
                                                        العربية     {{__('web.language')}}
                                                    @else
                                                        English    {{__('web.language')}}
                                                    @endif
                                                </a>
                                            </li>
                                            <li class="avatar-container-li">
                                                <a  class="myA" onclick="showAlert()">
                                                    {{__('web.payment-settings')}}
                                                </a>
                                            </li>
                                            <li class="avatar-container-li">
                                                <a  class="myA" onclick="showAlert()">
                                                    {{__('web.purchases')}}
                                                </a>
                                            </li>

                                            <li class="avatar-container-li">
                                                <a  class="myA" href="{{route('coursati.contactUs')}}">
                                                    {{__('web.help')}}
                                                </a>
                                            </li>

                                            <li  class="avatar-container-li">
                                                <a style="color : #F00" href="{{route('coursati.logout')}}">
                                                    {{__('web.logout')}}
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>


                </div>

                <a href="{{route('coursati.language')}}" class="flagImg d-none d-md-flex">
                    @if(App::getLocale() == 'en')
                        <p style="color: #bbbbbb; border: 1px solid #4D4D4D;border-radius: 10px;padding: 4px;   font-size: 12px;">العربية</p>
                    @else
                        <p style="color: #bbbbbb; border: 1px solid #4D4D4D;border-radius: 10px;padding: 4px;   font-size: 12px;">English</p>
                    @endif
                </a>
            </div>

        </div>
    </header>
@endif
<!--end header-->

@include('website.auth.normalUser.register')
@include('website.auth.normalUser.login')
@include('website.auth.normalUser.forget-password')

