->


<nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <ul class="navbar-nav mx-auto">

        <a href="{{route('coursati.language')}}" class="flagImg d-none d-md-flex">
            @if(App::getLocale() == 'en')
            <span style="color:black">  العربية</span>
            @else
               <span  style="color:black">الإنجليزيه</span>
            @endif
        </a>

        <li style="    font-size: 30px;color: #F00;" class="nav-item d-none d-sm-inline-block" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <a style="  font-weight: bolder;  color: #F00;" href="{{ route('admin.logout') }}"  class="nav-link"><i class="fas fa-door-open"></i> {{__('web.logout')}} </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
