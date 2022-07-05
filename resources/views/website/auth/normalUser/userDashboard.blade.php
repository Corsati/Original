@extends('website.layouts.master')
@section('content')
    @include('website.layouts.partial.navbar')
    @include('website.layouts.partial.categories')
    <!--start light gray bg-->
    <div class="lightGrayBg pb-5 userDash">
        <div class="container">

            <h2 class="title">My Dashboard</h2>
            <p class="desc">Details and quick navigation to control your account</p>

            <div class="coursesContainer mt-4">

                <a href="myCourses.html" class="item">
                    <img src="img/black_learn.svg" alt="book">
                    <img src="img/orange_learn.png" alt="book">
                    Courses & Certificates
                </a>

                <a href="profile.html" class="item">
                    <img src="img/black_user.png" alt="book">
                    <img src="img/orange_user.png" alt="book">
                    My profile
                </a>

                <a href="#" class="item">
                    <img src="img/black_message.png" alt="book">
                    <img src="img/orange_message.png" alt="book">
                    Messages
                </a>

                <a href="#" class="item">
                    <img src="img/black_notification.png" alt="book">
                    <img src="img/orange_notification.png" alt="book">
                    Notifications
                </a>

                <a href="#" class="item">
                    <img src="img/black_bill.png" alt="book">
                    <img src="img/orange_bill.png" alt="book">
                    My Billing info
                </a>

                <a href="#" class="item">
                    <img src="img/black_contact.png" alt="book">
                    <img src="img/orange_contact.png" alt="book">
                    My Contact info
                </a>

                <a href="myCourses.html" class="item">
                    <img src="img/black_security.png" alt="book">
                    <img src="img/orange_security.png" alt="book">
                    Account security
                </a>

                <a href="myCourses.html" class="item">
                    <img src="img/black_setting.png" alt="book">
                    <img src="img/orange_setting.png" alt="book">
                    Settings
                </a>

            </div>

        </div>
    </div>
    <!--end light gray bg-->
    @include('website.layouts.partial.footerDetails')
@endsection
