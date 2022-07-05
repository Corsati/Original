<!--  Start Header  -->
<header class="teacherHeader">
    <div class="container">
        <div class="menuBar d-flex d-md-none justify-content-between align-items-center">
            <a href="{{route('coursati.profile')}}">
                <img src="{{auth()->user()->avatar}}" class="logo" alt="logo">
            </a>
            <div class="toggle">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
        </div>
        <div class="overlay"></div>
        <div class="menu d-flex justify-content-between align-items-center">
            <div class="leftDiv">
                <a class="toggleSideMenu d-none d-md-block mr-18">
                    <img src="{{setAsset('website/img/menu.png')}}" class="logo" alt="menu bars">
                </a>
                <a href="{{route('coursati.index')}}" class="d-none d-md-block mr-18">
                    <img src="{{setAsset('website/img/logoo.svg')}}" class="logo" alt="logo">
                </a>
            </div>
            <a href="{{route('coursati.home')}}" class="user d-md-none">
                <img src="{{setAsset('website/img/pic.jpg')}}" class="img-fluid" alt="profile">
                <p>
                    hi, {{auth()->user()->first_name}}  {{auth()->user()->last_name}}
                </p>
                <!--<a href="#">-->
                <!--<i class="fas fa-chevron-right"></i>-->
                <!--</a>-->
            </a>
            <a href="{{route('coursati.home')}}" class="catLink mr-18 d-md-none">
                <i class="fas fa-bell mr-1"></i>
                <span>{{__('web.Notifications')}}</span>
            </a>
            <a href="{{route('coursati.courses')}}" class="catLink d-md-none">
                <i class="fas fa-book-reader"></i>
                {{__('web.Courses')}}
            </a>
            <a href="{{route('coursati.myInbox')}}" class="catLink d-md-none">
                <i class="fas fa-book-reader"></i>
                {{__('web.inbox')}}
            </a>
            <a href="{{route('coursati.performance')}}" class="catLink d-md-none">
                <i class="fas fa-book-reader"></i>
                {{__('web.Performance')}}
            </a>
            <a href="{{route('coursati.resources')}}" class="catLink d-md-none">
                <i class="fas fa-book-reader"></i>
                <span>  {{__('web.Resources')}}</span>
            </a>
            <a href="{{route('coursati.settings')}}" class="catLink d-md-none">
                <i class="fas fa-book-reader"></i>
                <span>  {{__('web.Settings')}}</span>
            </a>

            <div class="d-flex align-items-center">
                <div class="cartDiv align-items-center mr-18 d-none d-md-flex">

                    <a href="{{route('coursati.notifications')}}" class="mr-18">
                        <img src="{{setAsset('website/img/notification.svg')}}" class="bell" alt="notification">
                    </a>
                    <a href="{{route('coursati.profile')}}" class="profilePic">
                        <img src="{{auth()->user()->avatar}}" class="img-fluid" alt="profile">
                    </a>
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

    </div>
</header>
<!--end header-->
<div class=" teacherCotent d-flex">
    <div class="sideMenu d-none d-md-block">
        <ul>
            <li>
                <a href="{{route('coursati.teacherDashboard')}}">
                    <img src="{{setAsset('website/img/gray_book.svg')}}" alt="book">
                    <img src="{{setAsset('website/img/black_learn.svg')}}" alt="book">
                    {{__('web.dashboard')}}
                </a>
            </li>
            <li>
                <a href="{{route('coursati.courses')}}">
                    <img src="{{setAsset('website/img/gray_book.svg')}}" alt="book">
                    <img src="{{setAsset('website/img/black_learn.svg')}}" alt="book">
                    {{__('web.Courses')}}
                </a>
            </li>
            <li>
                <a href="{{route('coursati.myInbox')}}">
                    <img src="{{setAsset('website/img/gray_book.svg')}}" alt="book">
                    <img src="{{setAsset('website/img/black_learn.svg')}}" alt="book">
                    {{__('web.inbox')}}
                </a>
            </li>
            <li>
                <a href="{{route('coursati.performance')}}">
                    <img src="{{setAsset('website/img/gray_book.svg')}}" alt="book">
                    <img src="{{setAsset('website/img/black_learn.svg')}}" alt="book">
                    {{__('web.Performance')}}
                </a>
            </li>
            <li>
                <a href="{{route('coursati.resources')}}">
                    <img src="{{setAsset('website/img/gray_book.svg')}}" alt="book">
                    <img src="{{setAsset('website/img/black_learn.svg')}}" alt="book">
                    {{__('web.Resources')}}
                </a>
            </li>
            <li>
                <a href="{{route('coursati.settings')}}">
                    <img src="{{setAsset('website/img/gray_book.svg')}}" alt="book">
                    <img src="{{setAsset('website/img/black_learn.svg')}}" alt="book">
                    {{__('web.settings')}}
                </a>
            </li>
        </ul>

        <a href="{{route('coursati.chooseCategory')}}" class="gradientBg mt-5">
           {{__('web.create_new')}}
        </a>
    </div>
