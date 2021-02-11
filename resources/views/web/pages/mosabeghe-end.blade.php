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
                        <p class="p-1 text-justify">
                            با تشکر ،آزمون شما به پایان رسید .


                        </p>
                        <p class="p-1 text-justify">
                              بعد از اتمام زمان آزمون که
                            (ساعت 12:00)
                            امروز میباشد
                            <a href="{{route('web.mosabeghe.javab.login')}}">اینجا</a>
                            کلیک کنید و جواب آزمون خود را مشاهده نمایید .

                        </p>
                        <p class="p-1 text-justify">
                        *کاربر عزیز آیا می دانستید، قرآنکده نور موعود (عج) طبق مشغله و سن افراد کلاس ها و طرح های آموزشی را به صورت تخصصی در رشته های مختلف، با توجه به انگیزه و علاقه عاشقان به فراگیری معارف الهی دسته بندی و به آموزش گذاشته است؟ شما نیز می توانید در صورت علاقه از طریق آیکن کلاس ها و طرح های آموزشی با این طرح ها آشنا شده و از طریق آیکن ثبت نام در قرآنکده حضوری یا آنلاین، در این طرح ها شرکت نموده و گامی بلند به سوی تعالی حیات انسانی بردارید.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->






@endsection


