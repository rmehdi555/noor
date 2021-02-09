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
                            جناب
                            {{$mosabegheMalekeZaman->name}} {{$mosabegheMalekeZaman->family}}
                            خوش آمدید .

                        </p>
                        <p class="p-1 text-justify">
                           سوالات را با دقت جواب دهید و پاسخ صحیح آنها بعد از اتمام زمان مسابقه در همین صفحه آزمون با وارد کردن مشخصات قابل مشاهده خواهد شد .
                        </p>
                        <p class="p-1 text-justify">
                            * تنها یک بار میتوانید دکمه ثبت نهایی را انتخاب کنید و قابل ویرایش نمیباشند لذا در پاسخ دادن به سوالات دقت نمایید .
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->


    @if($mosabegheMalekeZaman->status==0)
    @endif
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
                        <form class="form-horizontal" id="form-level-1-save" method="POST"
                              action="{{ route('web.mosabeghe.javab.test.save') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_meli_number" value="{{$mosabegheMalekeZaman->meli_number}}">
                            <input type="hidden" name="user_mosabeghe_id" value="{{$mosabegheMalekeZaman->id}}">
                            <input type="hidden" name="nextM" value="{{$nextM}}">
                            @php $i=1; @endphp

                            @foreach($soals as $value)

                            <div class="row">
                                <div class="col-md-12 padding-top-15">
                                    <label class="col-md-12 col-sm-12 control-label" for="job">{{$i}} - {{$value->title}}
                                        <span class="required">*</span></label>
                                    @foreach($value->javabs as $valueJavabs)
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="javabs[{{$value->id}}]" id="" value="{{$valueJavabs->id}}" required>
                                                <label class="form-check-label p-2" for="inlineRadio1">{{$valueJavabs->title}}</label>
                                            </div>
                                        </div>
                                    @endforeach


                                    @php $i++; @endphp

                                </div>
                            </div>
                            @endforeach
                            <br><br>

                            <div class="d-flex justify-content-center mb-2">

                                <div class="p-2 ">
                                    <button type="submit" class="btn btn-primary">ثبت نهایی پاسخ ها</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


