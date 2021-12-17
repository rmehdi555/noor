@extends('web.master')
@section('content')


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
                                       aria-selected="true">{{\App\Providers\MyProvider::_text($category->title)}}</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="t1" role="tabpanel">
                                    <ul class="main-events-list bu-margin-bottom-30">
                                        @foreach($news as $item)

                                            <li>
                                                <h2 class="main-events-list-title bu-title-effect"><a href="{{ route('web.show.news',$item->id) }}">  {{\App\Providers\MyProvider::_text($item->title)}} </a></h2>
                                                <span class="main-events-list-date">{{\App\Providers\MyProvider::show_date($item->created_at,'H:i Y/m/d')}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    {!! $news->render() !!}
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

@endsection