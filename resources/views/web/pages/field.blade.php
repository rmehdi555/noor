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
                <div class="container p-3 my-3 bg-primary text-white align-center">
                    <h1><a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_fields_link"]->value)}}">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["box_fields_body"]->value) !!}</a></h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <h1>{{\App\Providers\MyProvider::_text($field->title)}} :</h1>
                <p>{!! \App\Providers\MyProvider::_text($field->body) !!}</p>
            </div>
        </div>
    </section>


@endsection