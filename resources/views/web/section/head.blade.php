<?php

use Illuminate\Support\Facades\App;

$locale = App::getLocale();
?>
<!DOCTYPE html>
<html dir="@if($locale=="fa") rtl @else ltr @endif">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-F0SCH5DLEX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-F0SCH5DLEX');
    </script>
    <!-- Meta Tags -->
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{asset('web/2020/image/favicon.png" rel="icon')}}" />
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8"/>
    <meta name="description" content="قرآنکده نور موعود (عج)"/>
    <meta name="keywords" content="قرآنکده نور موعود (عج), ثبت نام در قرآنکده آنلاین و حضوری, نور موعود,سهمی از نور,پرداخت خمس, پرداخت نذر ">
    <meta name="author" content="rmehdi555">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <meta name="theme-color" content="#3e42e9">

    <link rel="icon" type="image/png" sizes="32x32" href="{{$siteDetailsProvider["image_logo"]->images["images"]["original"]}}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{$siteDetailsProvider["image_logo"]->images["images"]["original"]}}">
    <link rel="icon" type="image/png" sizes="128x128" href="{{$siteDetailsProvider["image_logo"]->images["images"]["original"]}}">
    <link rel="icon" type="image/png" sizes="256x256" href="{{$siteDetailsProvider["image_logo"]->images["images"]["original"]}}">

    <meta name="apple-mobile-web-app-title" content="site">
    {{--<link rel="apple-touch-icon" sizes="152x152" href="assets/icons/icon_152.png">--}}

    <meta name="msapplication-TileColor" content="#3e42e9">
    {{--<meta name="msapplication-TileImage" content="assets/icons/icon_144.png">--}}

    <!-- Title -->
    <title>{{\App\Providers\MyProvider::_text($siteDetailsProvider["site_name"]->value)}}</title>

    <!-- Shiv -->
    <!--[if lte IE 9]
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Stylesheets -->
    <link type="text/css" href="{{asset('web/2020/assets/css/normalize.css" rel="stylesheet')}}" />
    <link type="text/css" href="{{asset('web/2020/assets/fonts/fontawesome/css/fontawesome-all.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{asset('web/2020/assets/fonts/rtl/IRANYekan/css/iranyekan.css')}}" rel="stylesheet" />
    <link type="text/css" href="{{asset('web/2020/assets/fonts/ltr/Poppins/css/poppins.css')}}" rel="stylesheet" />
    <link type="text/css" href="{{asset('web/2020/assets/plg/bootstrap-4.3.1/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link type="text/css" href="{{asset('web/2020/assets/plg/Bootstrap-Offcanvas-master/css/bootstrap.offcanvas.min.css')}}" rel="stylesheet" />
    <link type="text/css" href="{{asset('web/2020/assets/plg/OwlCarousel2-2.3.4/css/owl.carousel.min.css')}}" rel="stylesheet" />
    <link type="text/css" href="{{asset('web/2020/assets/plg/OwlCarousel2-2.3.4/css/owl.theme.default.min.css')}}" rel="stylesheet" />

    <!-- Main Stylesheet -->
    <link type="text/css" href="{{asset('web/2020/assets/css/style-v-3.css')}}" rel="stylesheet" />

    <style>
        img{
            max-width:100%;
        }
        .custom-control-label::before, .custom-file-label, .custom-select
        {
            overflow : hidden;
        }

    </style>
    <!-- JavaScript -->
    <script type="text/javascript" src="{{asset('web/2020/assets/js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web/2020/assets/js/jquery-migrate-1.4.1.min.js')}}"></script>

    <script src="{{asset('web/2020/assets/js/sweetalert.min.js')}}"></script>




    <!-- CSS Part End-->
    @if($locale=="fa")

        @endif
</head>