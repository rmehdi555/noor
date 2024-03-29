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
                                <header class="card-header" style="background-color : #fefe33"><img src="@if(empty($avatarImage)){{asset('web/2020/assets/img/theme/user-profile.png')}}@else{{asset($avatarImage->url)}}@endif" alt="Avatar" class="avatar">
                                    <br>
                                    <h6 class="title">{{$user->name }}  {{$user->family}}<br>کد معلم القرآن : {{$user->teacher->teacher_id }} </h6></header>
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.panel.print.details') }}" >چاپ کردن اطلاعات ثبت نامی</a>
                                        <span class="badge badge-primary badge-pill"></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.class.teacher.list') }}" >مدیریت کلاس ها ی معلم القرآن</a>
                                    </li>
                                    @if($user->teacher->type=="teacher")
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.class.create') }}" >ایجاد کلاس برای قرآن آموز</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.class.list') }}" >مدیریت کلاس ها ی قرآن آموز</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.exams.list') }}" >مدیریت آزمون ها ی قرآن آموز</a>
                                    </li>

                                    {{--<li class="list-group-item d-flex justify-content-between align-items-center">--}}
                                        {{--<a href="{{ route('teacher.mali.list') }}" >مالی</a>--}}
                                    {{--</li>--}}

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.practice.list') }}" >مشاهده فعالیت قرآن آموز ها</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.work.hours') }}" > ثبت ساعت کار</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.methodOfLetter.list') }}" > شیوه نامه ها</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.meeting.list') }}" > جلسات</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.work.hours.list.show') }}" > مشاهده لیست پرداختی ها</a>
                                    </li>
                                    @endif
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.mali.list') }}" >امور مالی</a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.ticket.list') }}" >سخنی با مدیریت یا طراح سایت</a>
                                    </li>



                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('teacher.message.list') }}" > پیام ها</a>
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


