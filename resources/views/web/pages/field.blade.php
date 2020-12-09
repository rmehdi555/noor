@extends('web.master')
@section('content')
    <div class="main-inner-banner">
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

    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">
                        <a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_fields_link"]->value)}}">
                            <p class="p-1 text-justify">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["box_fields_body"]->value) !!}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
                <h1>{{\App\Providers\MyProvider::_text($field->title)}} :</h1>
                <p>{!! \App\Providers\MyProvider::_text($field->body) !!}</p>
        </div>
    </section>


@endsection