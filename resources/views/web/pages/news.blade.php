@extends('web.master-product')
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
                            {{--<h1 class="main-inner-banner-ct-name">{{\App\Providers\MyProvider::_text($news->title)}}</h1>--}}
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
                    <div class="bu-inner-main-cont">
                        <div class="bu-inner-mc-content">
                            <article class="bu-inner-news-single">
                                <h1 class="bu-inner-ns-title">{{\App\Providers\MyProvider::_text($news->title)}}</h1>
                                <div class="bu-inner-news-li-footer bu-inner-ns-footer">
                                    <div class="bu-inner-news-li-meta bu-inner-ns-meta">
                                        <span>{{\App\Providers\MyProvider::show_date($news->created_at,'%B %d، %Y H:i')}}</span>
                                        {{--<span>|</span>--}}
                                        {{--<span>بازدید: 34</span>--}}
                                        {{--<span>|</span>--}}
                                        {{--<span>نظرات: 234</span>--}}
                                    </div>
                                    {{--<a href="" class="bu-inner-ns-like">--}}
                                        {{--<i class="fal fa-heart"></i>--}}
                                        {{--<span>67</span>--}}
                                    {{--</a>--}}

                                </div>

                                <div class="bu-event-slider owl-carousel owl-theme owl-rtl owl-loaded owl-drag">


                                    <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1520px;"><div class="owl-item active" style="width: 760px;"><div class="bu-event-slider-item"><img src="assets/img/dummy/sample-img.jpg" alt=""></div></div><div class="owl-item" style="width: 760px;"><div class="bu-event-slider-item"><img src="assets/img/dummy/sample-img.jpg" alt=""></div></div></div></div><div class="owl-nav"><button type="button" role="presentation" class="owl-prev disabled"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div><div class="owl-dots disabled"></div></div>
                                <div class="bu-inner-ns-text">
                                    {!!  \App\Providers\MyProvider::_text($news->body) !!}
                                </div>
                                <div class="bu-inner-ns-detail">
                                    <div class="bu-inner-ns-tags">
                                        <i class="fal fa-tag bu-inner-nst-icon"></i>

                                    </div>
                                    <div class="bu-inner-ns-source">
                                        <span class="bu-inner-nss-name">منبع:</span>
                                        <span>{{\App\Providers\MyProvider::_text($siteDetailsProvider["site_name"]->value)}}</span>
                                    </div>
                                </div>

                            </article>
                        </div>
                        <div class="bu-inner-mc-side">
                            <div class="bu-inner-mcs-block">
                                <div class="bu-title bu-margin-bottom-20">
                                    <div class="bu-title-cont">
                                        <span class="bu-title-icon sqaure"></span>
                                        <h3 class="bu-title-name">اخبار</h3>
                                    </div>
                                </div>
                                <ul class="bu-inner-mcs-view-list">
                                    @foreach($allNews as $item)

                                        <li>
                                            <h2 class="main-events-list-title bu-title-effect"><a href="{{ route('web.show.news',$item->id) }}">  {{\App\Providers\MyProvider::_text($item->title)}} </a></h2>
                                            <span class="main-events-list-date">{{\App\Providers\MyProvider::show_date($item->created_at,'Y-n-j H:i')}}</span>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection