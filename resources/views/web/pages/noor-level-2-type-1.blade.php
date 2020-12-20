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

                        <p class="p-1 text-justify">{{$noor->type}}

                            شما
                            {{$noor->name}}  {{$noor->family}}

                            ثبت شد
                            <br>

                            خدای سبحان خود شاکر است و سعی شما را مشکور قرار خواهد داد و پاداشی در خور عنایت خواهد کرد «إن شاء الله» امیدواریم حضرت موعود ارواحنا فداه وجود خویش را سایه سار زندگیتان سازد، تا در خنکای آن،، کمال، آرامش و برکت، لذت بخش زندگیتان شده و عروج به مقام اعلای قرب الهی را نصیبتان نماید.</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->
    <!-- Start: Inner main -->


    <!-- Start: Inner main -->






@endsection


