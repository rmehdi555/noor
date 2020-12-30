<!doctype html>
<html lang="en">

<head>
    <title>{{\App\Providers\MyProvider::_text($siteDetailsProvider["site_name"]->value)}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="قرآنکده نور موعود (عج)"/>
    <meta name="keywords" content="قرآنکده نور موعود (عج), ثبت نام در قرآنکده آنلاین و حضوری, نور موعود,سهمی از نور,پرداخت خمس, پرداخت نذر ">
    <meta name="author" content="rmehdi555">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{$siteDetailsProvider["image_logo"]->images["images"]["original"]}}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{$siteDetailsProvider["image_logo"]->images["images"]["original"]}}">
    <link rel="icon" type="image/png" sizes="128x128" href="{{$siteDetailsProvider["image_logo"]->images["images"]["original"]}}">
    <link rel="icon" type="image/png" sizes="256x256" href="{{$siteDetailsProvider["image_logo"]->images["images"]["original"]}}">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('admin/2020/assets/vendor/bootstrap/css/bootstrap.min.rtl.css')}}">
    <link rel="stylesheet" href="{{asset('admin/2020/assets/vendor/animate-css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/2020/assets/vendor/font-awesome/css/font-awesome.min.css')}}">

    <link type="text/css" href="{{asset('web/2020/assets/fonts/fontawesome/css/fontawesome-all.min.css')}}" rel="stylesheet">
    <link type="text/css" href="{{asset('web/2020/assets/fonts/rtl/IRANYekan/css/iranyekan.css')}}" rel="stylesheet" />
    <link type="text/css" href="{{asset('web/2020/assets/fonts/ltr/Poppins/css/poppins.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('admin/2020/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/2020/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/2020/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/2020/assets/vendor/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" href="{{asset('admin/2020/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css')}}">
    <link rel="stylesheet" href="{{asset('admin/2020/assets/vendor/parsleyjs/css/parsley.css')}}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('admin/2020/rtl/assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('admin/2020/rtl/assets/css/color_skins.css')}}">
    <style>
        td.details-control {
            background: url('{{asset('admin/2020/assets/images/details_open.png')}}') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('{{asset('admin/2020/assets/images/details_close.png')}}') no-repeat center center;
        }
    </style>

    <!-- Demo CSS not Include in project -->
    <style>
        .demo-card label{ display: block; position: relative;}
        .demo-card .col-lg-4{ margin-bottom: 30px;}
    </style>
</head>