@extends('web.master')
@section('content')
    <br>
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="card text-white col-md-5" style="background-color: #fefe33 ; margin : 10px ; width: 100%">
                    <div class="card-header text-dark">{!!\App\Providers\MyProvider::_text($siteDetailsProvider["hadis_roz_title"]->value)!!}</div>
                    <div class="card-body text-dark">
                        <p class="card-text text-dark">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["hadis_roz_body"]->value) !!}</p>
                    </div>
                </div>
                <div class="card text-white  col-md-5" style="background-color: #008B8B ; margin : 10px ; width: 100%">
                    <div class="card-header ">{!!\App\Providers\MyProvider::_text($siteDetailsProvider["box_info_title"]->value)!!}</div>
                    <div class="card-body">
                        <p class="card-text ">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["box_info_body"]->value) !!}</p>
                    </div>
                </div>
                <div class="col-md-1">

                </div>
            </div>
        </div>
    </section>
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-1">

                </div>
                <div class="card text-white  col-md-10" style="background-color: #008B8B ; margin : 10px ; width: 100%">
                    <div class="card-header "><a href="{{route('web.mosabeghe.maleke.zaman.level.1')}}" style="color:#fff">
                            *****
                            مسابقه کتابخوانی و هنرنمایی در قاب نقاشی، با موضوع کتاب مالک زمان
                            همراه
                            با جوایز نفیس، جهت ثبت نام اینجا کلیک نمایید .
                            *****
                        </a></div>

                </div>

                <div class="col-md-1">

                </div>
            </div>
        </div>
    </section>
    <!-- Start: Iconbox -->
    <section class="main-iconbox">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bu-title bu-margin-bottom-20">
                        <div class="bu-title-cont">
                            {{--<h3 class="bu-title-name">امکانات </h3>--}}
                        </div>
                    </div>
                    <div class="main-iconbox-cont">

                        <a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_1_link"]->value)}}" class="main-iconbox-item bu-item-hover" style="background-color: #fefe33; color: #000000 !important;">
                            <div class="main-iconbox-i-content">
                                <h3 class="main-iconbox-ic-title text-dark">{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_1_title"]->value)}}</h3>
                                {{--<span class="main-iconbox-ic-more">کلیک کنید<i--}}
                                {{--class="fal fa-long-arrow-left"></i></span>--}}
                            </div>
                        </a>
                        <a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_2_link"]->value)}}" class="main-iconbox-item bu-item-hover" style="background-color: #008B8B">
                            <div class="main-iconbox-i-content">
                                <h3 class="main-iconbox-ic-title">{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_2_title"]->value)}}</h3>
                                {{--<span class="main-iconbox-ic-more">کلیک کنید<i--}}
                                {{--class="fal fa-long-arrow-left"></i></span>--}}
                            </div>
                        </a>
                        <a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_3_link"]->value)}}" class="main-iconbox-item bu-item-hover" style="background-color: #fefe33">
                            <div class="main-iconbox-i-content">
                                <h3 class="main-iconbox-ic-title text-dark">{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_3_title"]->value)}}</h3>
                                {{--<span class="main-iconbox-ic-more">کلیک کنید<i--}}
                                {{--class="fal fa-long-arrow-left"></i></span>--}}
                            </div>
                        </a>
                        <a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_4_link"]->value)}}" class="main-iconbox-item bu-item-hover" style="background-color: #008B8B">
                            <div class="main-iconbox-i-content">
                                <h3 class="main-iconbox-ic-title">{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_4_title"]->value)}}</h3>
                                {{--<span class="main-iconbox-ic-more">کلیک کنید<i--}}
                                {{--class="fal fa-long-arrow-left"></i></span>--}}
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- End: Iconbox -->


    <!-- Start: Banner
    <section class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-banner-slider owl-carousel owl-theme" >
                        <div class="main-banner-item"><img src="assets/img/dummy/banner-1.jpg" alt=""></div>
                        <div class="main-banner-item"><img src="assets/img/dummy/banner-2.jpg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     End: Banner -->

    <!-- Start: Events -->
    <section class="main-events">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bu-title bu-margin-bottom-20">
                        <div class="bu-title-cont">
                            <h3 class="bu-title-name"></h3>
                        </div>
                    </div>
                    <div class="main-events-cont">
                        <div class="main-events-tab">
                            <ul class="nav nav-tabs " id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#t1" role="tab"
                                       aria-selected="true">آخرین اخبار</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="t1" role="tabpanel">
                                    <ul class="main-events-list bu-margin-bottom-30">
                                        @foreach($news as $item)

                                            <li>
                                                <h2 class="main-events-list-title bu-title-effect"><a href="{{ route('web.show.news',$item->id) }}">  {{\App\Providers\MyProvider::_text($item->title)}} </a></h2>
                                                <span class="main-events-list-date">{{\App\Providers\MyProvider::show_date($item->created_at,'%B %d، %Y  H:i')}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    {{--<div class="main-events-more">--}}
                                    {{--<a href="" class="bu-more">--}}
                                    {{--<span>اخبار بیشتر</span>--}}
                                    {{--<i class="fal fa-long-arrow-left"></i>--}}
                                    {{--</a>--}}
                                    {{--</div>--}}
                                </div>
                                {{--<div class="tab-pane fade" id="t2" role="tabpanel">...</div>--}}
                                {{--<div class="tab-pane fade" id="t3" role="tabpanel">...</div>--}}
                                {{--<div class="tab-pane fade" id="t4" role="tabpanel">...</div>--}}
                                {{--<div class="tab-pane fade" id="t5" role="tabpanel">...</div>--}}
                            </div>
                        </div>
                        {{--<div class="main-events-ads">--}}
                        {{--<div class="main-events-ads-item">--}}
                        {{--<a href=""><img src="assets/img/dummy/ads-1.jpg" alt=""></a>--}}
                        {{--</div>--}}
                        {{--<div class="main-events-ads-item">--}}
                        {{--<a href=""><img src="assets/img/dummy/ads-2.jpg" alt=""></a>--}}
                        {{--</div>--}}
                        {{--</div>--}}

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End: Events -->

    <!-- Start: Iconbox -->
    {{--<section class="main-iconbox">--}}
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<div class="bu-title bu-margin-bottom-20">--}}
    {{--<div class="bu-title-cont">--}}
    {{--<h3 class="bu-title-name">امکانات </h3>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="main-iconbox-cont">--}}
    {{--<a href="" class="main-iconbox-item">--}}
    {{--<img src="assets/img/dummy/ibox-1.png" alt="">--}}
    {{--</a>--}}
    {{--<a href="" class="main-iconbox-item">--}}
    {{--<img src="assets/img/dummy/ibox-1.png" alt="">--}}
    {{--</a>--}}
    {{--<a href="" class="main-iconbox-item">--}}
    {{--<img src="assets/img/dummy/ibox-1.png" alt="">--}}
    {{--</a>--}}
    {{--<a href="" class="main-iconbox-item">--}}
    {{--<img src="assets/img/dummy/ibox-1.png" alt="">--}}
    {{--</a>--}}

    {{--<a href="" class="main-iconbox-item bu-item-hover" style="background-color: #fefe33">--}}
    {{--<div class="main-iconbox-i-icon"><i style="color: #fff;" class="fal fa-chalkboard-teacher"></i></div>--}}
    {{--<div class="main-iconbox-i-content">--}}
    {{--<h3 class="main-iconbox-ic-title">عنوان باکس</h3>--}}
    {{--<span class="main-iconbox-ic-more">کلیک کنید<i class="fal fa-long-arrow-left"></i></span>--}}
    {{--</div>--}}
    {{--</a>--}}
    {{--<a href="" class="main-iconbox-item bu-item-hover" style="background-color: #008B8B">--}}
    {{--<div class="main-iconbox-i-icon"><i style="color: #fff;" class="fal fa-books"></i></div>--}}
    {{--<div class="main-iconbox-i-content">--}}
    {{--<h3 class="main-iconbox-ic-title">عنوان باکس عنوان باکس عنوان باکس</h3>--}}
    {{--<span class="main-iconbox-ic-more">کلیک کنید<i class="fal fa-long-arrow-left"></i></span>--}}
    {{--</div>--}}
    {{--</a>--}}
    {{--<a href="" class="main-iconbox-item bu-item-hover" style="background-color: #fefe33">--}}
    {{--<div class="main-iconbox-i-icon"><i style="color: #fff;" class="fal fa-chalkboard-teacher"></i></div>--}}
    {{--<div class="main-iconbox-i-content">--}}
    {{--<h3 class="main-iconbox-ic-title">عنوان باکس</h3>--}}
    {{--<span class="main-iconbox-ic-more">کلیک کنید<i class="fal fa-long-arrow-left"></i></span>--}}
    {{--</div>--}}
    {{--</a>--}}
    {{--<a href="" class="main-iconbox-item bu-item-hover" style="background-color: #008B8B">--}}
    {{--<div class="main-iconbox-i-icon"><i style="color: #fff;" class="fal fa-books"></i></div>--}}
    {{--<div class="main-iconbox-i-content">--}}
    {{--<h3 class="main-iconbox-ic-title">عنوان باکس</h3>--}}
    {{--<span class="main-iconbox-ic-more">کلیک کنید<i class="fal fa-long-arrow-left"></i></span>--}}
    {{--</div>--}}
    {{--</a> --}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
    <!-- End: Iconbox -->
@endsection