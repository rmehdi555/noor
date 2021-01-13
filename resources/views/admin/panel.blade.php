@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>پنل مدیریت</h2>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        <ul class="breadcrumb justify-content-end">
                            {{--<li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>--}}
                            {{--<li class="breadcrumb-item">Table</li>--}}
                            {{--<li class="breadcrumb-item active">Jquery Datatable</li>--}}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card weather2">
                        <div class="body city-selected">
                            <div class="row">
                                <div class="col-12">

                                </div>
                                <div class="info col-12">
                                    <div class="temp"><h2>{{auth()->user()->name}} {{auth()->user()->family}}</h2></div>
                                </div>
                                <div class="icon col-5">

                                </div>
                            </div>
                        </div>
                        <table class="table table-striped m-b-0">
                            <tbody>
                            <tr>
                                <td>تاریخ امروز :</td>
                                <td class="font-medium">@php use Hekmatinasser\Verta\Verta;$v=Verta::now();    echo($v->formatWord('l').' '.$v->format('d').' '.$v->formatWord('F').' '.$v->format('Y'));@endphp</td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>آمار بازدید های سایت </h2>
                            <ul class="header-dropdown">
                                {{--<li> <a href="javascript:void(0);" data-toggle="cardloading" data-loading-effect="pulse"><i class="icon-refresh"></i></a></li>--}}
                                {{--<li><a href="javascript:void(0);" class="full-screen"><i class="icon-size-fullscreen"></i></a></li>--}}
                                {{--<li class="dropdown">--}}
                                    {{--<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>--}}
                                    {{--<ul class="dropdown-menu dropdown-menu-right animated bounceIn">--}}
                                        {{--<li><a href="javascript:void(0);">Action</a></li>--}}
                                        {{--<li><a href="javascript:void(0);">Another Action</a></li>--}}
                                        {{--<li><a href="javascript:void(0);">Something else</a></li>--}}
                                    {{--</ul>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row text-center">
                                <div class="col-lg-3 col-md-6 col-6">
                                    <div class="body xl-parpl">
                                        <h4>{{$visitArray["getAllUser"]}}</h4>
                                        <span>تعداد همه افراد بازدید کننده تا به امروز</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <div class="body xl-turquoise">
                                        <h4>{{$visitArray["getAllPage"]}}</h4>
                                        <span>تعداد همه برگه های بازدید شده تا به امروز</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <div class="body xl-salmon">
                                        <h4>{{$visitArray["getAllUserToday"]}}</h4>
                                        <span>تعداد افراد بازدید کننده امروز</span>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <div class="body xl-slategray">
                                        <h4>{{$visitArray["getAllPageToday"]}}</h4>
                                        <span>تعداد صفحه های بازدید شده امروز</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection