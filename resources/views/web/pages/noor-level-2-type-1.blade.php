@extends('web.master')
@section('content')
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


    <section class="bu-inner-main noPrint">
        <div class=" d-flex justify-content-center mb-2 ">
            <div class="p-2 ">
                <button type="button"
                        class="btn btn-warning" onclick="window.print()">{{__('web/public.print')}}</button>
            </div>
        </div>
    </section>

    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col" ><img src="https://noormouood.ir//upload/images/2020/12/product/5fcc9043eb6a7.jpg" width="300 px" height="300 px"></div>
                <div class="col" ><img src="https://noormouood.ir//upload/images/2020/11/product/5fc39828954f2.png" width="250 px" height="250 px"></div>
                <div class="col" ><img src="https://noormouood.ir/upload/images/2020/12/news/500_5fe6fdb7e52f1.jpeg" width="300 px" height="300 px"></div>
            </div>
        </div>
    </section>


    <section class="bu-inner-main ">
        <div class="container">
            <div class="row alert alert-info m-1">
                <div class="col-8" ><span>   تاریخ : </span> <span>{{\App\Providers\MyProvider::show_date($noor->created_at,'H:i j-n-Y')}} </span> </div>
                <div class="col-4" >  <span> شماره رسید :</span>  <span>{{$noor->id}}</span></div>
            </div>
        </div>
    </section>

    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">

                        <p class="p-1 text-justify">جناب
                            {{__('web/public.sex_sms_'.$noor->sex)}}
                            {{$noor->name}}  {{$noor->family}}
                            درخواست شما با موفقیت ثبت گردید

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">

                        <p class="p-1 text-justify">
                            واقف گرامی خدای سبحان خود شاکر است و سعی شما را مشکور قرار خواهد داد و پاداشی در خور عنایت خواهد کرد «إن شاء الله» امیدواریم حضرت موعود ارواحنا فداه وجود خویش را سایه سار زندگیتان سازد، تا در خنکای آن،، کمال، آرامش و برکت، لذت بخش زندگیتان شده و عروج به مقام اعلای قرب الهی را نصیبتان نماید.

                         </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->
    <!-- Start: Inner main -->


    <!-- Start: Inner main -->






@endsection


