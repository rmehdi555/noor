<div class="main-inner-banner noPrint">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main-inner-banner-cont">
                    <div class="main-inner-banner-c-title">
                        <ul class="main-breadcrumb">
                            <li><a href="{{ route('web.home') }}">{{__('web/public.home_page')}}</a></li>
                            {{--<li class="active">{{\App\Providers\MyProvider::_text($product->title)}}</li>--}}
                        </ul>
                        {{--<h1 class="main-inner-banner-ct-name">{{__('web/public.complaint')}}</h1>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Start: Events -->
<section class="main-events " >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bu-title bu-margin-bottom-20">
                    <div class="bu-title-cont">
                        <h3 class="bu-title-name"></h3>
                    </div>
                </div>
                <div class="main-events-cont">
                    <div class="main-events-ads noPrint">

                        <div class="card ">
                            <article class="card-group-item">
                                <header class="card-header" style="background-color : #fefe33">
                                    <img src="@if(empty($avatarImage)){{asset('web/2020/assets/img/theme/user-profile.png')}}@else{{asset($avatarImage->url)}}@endif" alt="Avatar" class="avatar">
                                    <br>
                                    <h6 class="title">{{$user->name }}  {{$user->family}}<br>کد قرآن آموزی : {{$user->student->student_id }} </h6></header>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('student.panel.print.details') }}" >چاپ کردن اطلاعات ثبت نامی</a>
                                        <span class="badge badge-primary badge-pill"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('student.class.register') }}" >    ثبت نام کلاس جدید</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('student.class.list') }}" >کلاس ها</a>
                                    </li>
                                    {{--<li class="list-group-item d-flex justify-content-between align-items-center">--}}
                                        {{--<a href="{{ route('student.deposits.create') }}" >پرداختی</a>--}}
                                    {{--</li>--}}

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('student.mali.list') }}" >امور مالی</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('student.practice.list') }}" > ثبت فعالیت</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('student.ticket.list') }}" >سخنی با مدیریت یا طراح سایت</a>
                                    </li>


                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('student.message.list') }}" > پیام ها</a>
                                        {{--<span class="badge badge-primary badge-pill">جدید 2</span>--}}
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color : #FF0000">
                                        <a href="{{ route('logout') }}">{{__('web/public.btn_logout')}}</a>
                                        <span class="badge badge-primary badge-pill"></span>
                                    </li>
                                </ul>

                            </article> <!-- card-group-item.// -->

                        </div> <!-- card.// -->


                    </div>


                    <div class="main-events-tab">


