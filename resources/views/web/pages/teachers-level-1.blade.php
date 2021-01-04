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


    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">

                            <p class="p-1 text-justify">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["box_teachers_level_body"]->value) !!}</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->



    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bu-inner-main-form">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($siteDetailsProvider["status_register_m"]->status==1)
                                <br><br>
                                <div class="d-flex justify-content-center mb-2">
                                    <div class="p-2"><a class="btn btn-danger"
                                                        href="{{ route('web.teachers.level.1.cancel') }}">{{__('web/public.cancel')}}</a>
                                    </div>
                                    <div class="p-2 ">
                                        <a id="button-level-1-save"
                                           class="btn btn-primary"  href="{{ route('web.teachers.level.2') }}">{{__('web/public.next')}}</a>
                                    </div>
                                </div>
                            @else
                                <section class="bu-inner-main">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-warning m-1">

                                                    <p class="p-1 text-justify">
                                                        {!! \App\Providers\MyProvider::_text($siteDetailsProvider["status_register_m"]->value) !!}
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @endif




                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


