<!--
<header class="loginHeader">
    <div class="container-fluid ">
        <div class="menuBar d-flex d-md-none justify-content-between align-items-center">
            <div class="d-flex flex-row align-items-center">
                <a href="{{route('coursati.cart')}}" class="cart">
                    <img src="{{setAsset('website/img/cart.svg')}}" class="cartImg" alt="cart">
                </a>
                <a class="toggleSearch">
                    <i class="fas fa-search"></i>
                </a>
            </div>
            <a href="#">
                <img src="{{setAsset('website/img/logoo.svg')}}" class="logo" alt="logo">
            </a>
            <div class="toggle">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
        </div>
        <div class="mobileSearch">
            <div class="d-flex searchContainer">
                <a href="{{route('coursati.home')}}">
                    <i class="fas fa-search"></i>
                </a>
                <input type="text" placeholder="{{__('web.what_to_learn')}}">
            </div>
            <a class="toggleSearch">
                <i class="fas fa-times-circle"></i>
            </a>
        </div>
        <div class="overlay"></div>
        <div class=" menu d-flex flex-wrap align-items-center flexSpaceItem" style="    margin-right: 20px;margin-left: 20px;">

            <div class="flexCenter">
                <a href="{{route('coursati.index')}}" class="d-none d-md-block mr-27">
                    <img src="{{setAsset('website/img/logoo.svg')}}" class="logo" alt="logo">
                </a>

                <div class="catLink mr-27">
                    <i class="fas fa-th mr-1"></i>
                    <span>{{__('web.categories')}}</span>
                    <ul class="sub-menu">
                        @foreach($main as $category)
    <li class="dirLi">
        <a href="{{route('coursati.category',[ 'id' => $category->id , 'name' => make_slug($category->name)])}}">
                                    <div><img src="{{$category->icon}}" alt="">{{$category->name}}</div>
                                    <i class='fas fa-chevron-right'></i>
                                </a>
                                @if($category->childes->count())
        <ul class="d-none d-md-block">
@foreach($category->childes as $subcategory)
            <li>
                <a href="{{route('coursati.category',[  'id' => $category->id,'name' => make_slug($category->name)])}}">
                                                    <div><img src="{{ $subcategory->icon }}"
                                                              alt="">{{ $subcategory->name }}</div>
                                                    <i class='fas fa-chevron-right'></i>
                                                </a>
                                                @if($subcategory->childes->count())
                <ul class="d-none d-md-block">
@foreach($subcategory->childes as $cat)
                    <li>
                        <a href="{{route('coursati.category',[  'id' => $category->id,'name' => make_slug($category->name)])}}">
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
</div>


<div class="flexCenter">
<div class="searchDiv d-none d-md-block mr-27">
    <input type="text" placeholder="{{__('web.what_to_learn')}}">
                    <a href="#">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            @if(!auth()->guest())
 @if(auth()->user()->user_type == 2 )
    <a href="{{route('coursati.upgradeToInstructor')}}" class="gradientBg mr-18">
        {{__('web.teach_on_coursati')}}
    </a>
@elseif(auth()->user()->user_type == 3 && !auth()->user()->instructor )
    <a href="{{route('coursati.teachQualifications')}}" class="gradientBg mr-18">
        {{__('web.complete_profile')}}
    </a>
@elseif(auth()->user()->user_type == 3 && auth()->user()->instructor )
    @if(!request()->is('coursati/teacher-dashboard'))
        <a href="{{route('coursati.teacherDashboard')}}" class="gradientBg mr-18">
            {{__('web.dashboard')}}
        </a>
    @endif
@else
    <a href="{{route('coursati.teachOnCoursati')}}" class="gradientBg mr-18">
        {{__('web.teach_on_coursati')}}
    </a>
@endif
@else
    <a href="{{route('coursati.teachOnCoursati')}}" class="gradientBg mr-18">
        {{__('web.teach_on_coursati')}}
    </a>
    @endif
    </div>


    <div class="flexCenter">
        <div class="cartDiv align-items-center mr-18 d-none d-md-flex">

            @if(!auth()->guest())
                <a href="{{route('coursati.cart')}}" class=" cart mr-18">
                    <i class="fas fa-shopping-cart cartImg"></i>
                </a>
                <a href="{{route('coursati.myCourses')}}" class="catLink mr-18">
                    <span>{{__('web.my_courses')}}</span>
                    <!-- <i class="fas fa-chevron-down"></i>-->
                </a>
                <a href="{{route('coursati.comingSoon')}}" class="mr-18">
                    <img src="{{setAsset('website/img/heart.svg')}}" class="bell" alt="like">
                </a>
                <a href="{{route('coursati.comingSoon')}}" class="mr-18">
                    <img src="{{setAsset('website/img/notification.svg')}}" class="bell" alt="notification">
                </a>
                <div class="dropdown user user-menu open">
                    <a href="#" class="profilePic dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <img src="{{auth()->user()->avatar}}" class="img-fluid" alt="profile">
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <a href="{{route('coursati.profile')}}">{{__('web.profile')}}</a>
                        </li>
                        <li class="user-header">
                            <a href="{{route('coursati.logout')}}">{{__('web.logout')}}</a>
                        </li>

                    </ul>
                </div>

                <div class="line mr-27"></div>
                <div class="auth">
                    <a href="{{route('coursati.logout')}}">{{__('web.logout')}}</a>
                </div>
            @else
                <div class="line mr-27"></div>
                <div class="auth">
                    <a data-toggle="modal" data-target="#loginModal">{{__('web.login_now')}}</a>
                    <a data-toggle="modal" data-target="#signUpModal" id="open">{{__('web.sign_up')}}</a>
                </div>
            @endif
        </div>
        <a href="{{route('coursati.language')}}" class="flagImg d-none d-md-flex">
            @if(App::getLocale() == 'en')
                <img src="{{setAsset('website/img/saudi-arabia.png')}}"  style="width :32px;" class="" alt="lang">
            @else
                <img src="{{setAsset('website/img/uk.svg')}}"  class="" alt="lang">
            @endif
        </a>
    </div>
    </div>
    @if(!auth()->guest())
        <div class="menu d-flex flex-wrap align-items-center ulDir">

            <a href="home.html" class="d-none d-md-block mr-18">
                <img src="img/logoo.png" class="logo" alt="logo">
            </a>

            <a href="profile.html" class="user d-md-none">
                <img src="img/pic.jpg" class="img-fluid" alt="profile">
                <p>
                    hi, Amany kassem
                </p>
                <!--<a href="#">-->
                <!--<i class="fas fa-chevron-right"></i>-->
                <!--</a>-->
            </a>

            <a href="#" class="catLink mr-18 d-md-none">
                <i class="fas fa-bell mr-1"></i>
                <span>Notifications</span>
            </a>

            <a href="#" class="catLink mr-18 d-md-none">
                <i class="fas fa-heart mr-1"></i>
                <span>Wishlist</span>
            </a>

            <div class="catLink mr-18">
                <i class="fas fa-th mr-1"></i>
                <span>categories</span>
                <ul class="sub-menu">
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">Development</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">Business</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <ul class="d-none d-md-block">
                            <li>
                                <a href="subCategory.html">
                                    <div><img src="img/black_contact.png" alt="">Development</div>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li>
                                <a href="subCategory.html">
                                    <div><img src="img/black_contact.png" alt="">IT &amp; Software</div>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                                <ul>
                                    <li class="dirLi">
                                        <a href="subSubCategory.html">
                                            <div><img src="img/black_contact.png" alt="">Office Productivity</div>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                    <li class="dirLi">
                                        <a href="subSubCategory.html">
                                            <div><img src="img/black_contact.png" alt="">Personal Development</div>
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">IT &amp; Software</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                        <ul class="d-none d-md-block">
                            <li class="dirLi">
                                <a href="subCategory.html">
                                    <div><img src="img/black_contact.png" alt="">Music</div>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="dirLi">
                                <a href="subCategory.html">
                                    <div><img src="img/black_contact.png" alt="">Motion Graphic</div>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="dirLi">
                                <a href="subCategory.html">
                                    <div><img src="img/black_contact.png" alt="">General</div>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="dirLi">
                                <a href="subCategory.html">
                                    <div><img src="img/black_contact.png" alt="">other</div>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">Office Productivity</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">Personal Development</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">Design</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">Marketing</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">Health &amp; Fitness</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">Music</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">Motion Graphic</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">General</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="dirLi">
                        <a href="category.html">
                            <div><img src="img/black_contact.png" alt="">other</div>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <a href="myCourses.html" class="catLink d-md-none">
                <i class="fas fa-book-reader"></i>
                <span>My courses</span>
            </a>

            <div class="searchDiv d-none d-md-block mr-18">
                <input type="text" placeholder="What do you want to learn?">
                <a href="searchResults.html">
                    <i class="fas fa-search"></i>
                </a>
            </div>

            <a href="teachOnCoursati.html" class="gradientBg mr-18">
                Teach On Coursati
            </a>

            <div class="cartDiv align-items-center mr-18 d-none d-md-flex">
                <a href="cart.html" class=" cart mr-18">
                    <img src="img/cart.png" class="cartImg" alt="cart">
                </a>
                <a href="#" class="twitter mr-18">
                    <img src="img/twitter.png" class="cartImg" alt="twitter">
                </a>

                <div class="line mr-18"></div>

                <a href="myCourses.html" class="catLink mr-18">
                    <span>My courses</span>
                    <!-- <i class="fas fa-chevron-down"></i>-->
                </a>
                <a href="#" class="mr-18">
                    <img src="img/heart.png" class="bell" alt="like">
                </a>
                <a href="#" class="mr-18">
                    <img src="img/bell.png" class="bell" alt="notification">
                </a>
                <a href="profile.html" class="profilePic">
                    <img src="img/pic.jpg" class="img-fluid" alt="profile">
                </a>
            </div>
            <a href="#" class="flagImg d-none d-md-flex">
                <img src="img/uk.png" class="" alt="lang">
            </a>
        </div>
    @else
        <div class="menu d-flex flex-wrap align-items-center ulDir">

            <a href="index.html" class="d-none d-md-block mr-27">
                <img src="{{setAsset('website/img/logoo.png')}}" class="logo" alt="logo">
            </a>

            <div class="user userAuth d-md-none">
                <a data-toggle="modal" data-target="#loginModal">{{__('web.login')}}</a>
                <a data-toggle="modal" data-target="#signUpModal">{{__('web.signUp')}}</a>
            </div>

            <div class="catLink mr-27">
                <i class="fas fa-th mr-1"></i>
                <span>{{__('web.categories')}}</span>
                <ul class="sub-menu">
                    @foreach($main as $category)
                        <li class="dirLi">
                            <a href="{{route('coursati.category',[ 'id' => $category->id , 'name' => make_slug($category->name)])}}">
                                <div><img src="{{$category->icon}}" alt="">{{$category->name}}</div>
                                <i class='fas fa-chevron-right'></i>
                            </a>
                            @if($category->childes->count())
                                <ul class="d-none d-md-block">
                                    @foreach($category->childes as $subcategory)
                                        <li>
                                            <a href="{{route('coursati.category',[  'id' => $category->id,'name' => make_slug($category->name)])}}">
                                                <div><img src="{{ $subcategory->icon }}"
                                                          alt="">{{ $subcategory->name }}</div>
                                                <i class='fas fa-chevron-right'></i>
                                            </a>
                                            @if($subcategory->childes->count())
                                                <ul class="d-none d-md-block">
                                                    @foreach($subcategory->childes as $cat)
                                                        <li>
                                                            <a href="{{route('coursati.category',[  'id' => $category->id,'name' => make_slug($category->name)])}}">
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
                <input type="text" placeholder="What do you want to learn?">
                <a href="searchResults.html">
                    <i class="fas fa-search"></i>
                </a>
            </div>

            <a href="teachOnCoursati.html" class="gradientBg mr-27">
                Teach On Coursati
            </a>

            <div class="cartDiv align-items-center mr-27  d-none d-md-flex">
                <a href="cart.html" class="cart mr-27">
                    <img src="img/cart.png" class="cartImg" alt="cart">
                </a>
                <a href="#" class="twitter mr-27">
                    <img src="img/twitter.png" class="cartImg" alt="twitter">
                </a>

                <div class="line mr-27"></div>

                <div class="auth">
                    <a data-toggle="modal" data-target="#loginModal">login</a>
                    <a data-toggle="modal" data-target="#signUpModal">sign up</a>
                </div>

            </div>
            <a href="#" class="flagImg d-none d-md-flex">
                <img src="img/uk.png" class="" alt="lang">
            </a>
        </div>
        @endif
        </div>
        </header>
