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
                            نظرسنجی :

                        </p>

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
                        <form class="form-horizontal" id="form-level-1-save" method="POST"
                              action="{{ route('web.mosabeghe.nazar.save') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_meli_number" value="{{$mosabegheMalekeZaman->meli_number}}">
                            <input type="hidden" name="user_mosabeghe_id" value="{{$mosabegheMalekeZaman->id}}">
                            <input type="hidden" name="type" value="{{$type}}">

                            <div class="row">
                                الف-به گزینه های ذیل از 20 نمره، امتیاز دهید:
                            </div>

                            <div class="row">
                                <div class="col-md-12 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="job">1-نحوه ثبت نام و کارکردن با سایت :
                                        <span class="required">*</span></label>
                                    <input type="hidden" name="title[]" value="نحوه ثبت نام و کارکردن با سایت">
                                    <div class="col-md-6 col-sm-10">
                                        <select name='value[]' class='form-control' required>
                                            @for ($i = 20; $i > 0; $i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="job">2-اطلاع رسانی :
                                        <span class="required">*</span></label>
                                    <input type="hidden" name="title[]" value="اطلاع رسانی">
                                    <div class="col-md-6 col-sm-10">
                                        <select name='value[]' class='form-control' required>
                                            @for ($i = 20; $i > 0; $i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="job">3-کتاب مالک زمان :
                                        <span class="required">*</span></label>
                                    <input type="hidden" name="title[]" value="کتاب مالک زمان">
                                    <div class="col-md-6 col-sm-10">
                                        <select name='value[]' class='form-control' required>
                                            @for ($i = 20; $i > 0; $i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="job">4-آزمون تستی :
                                        <span class="required">*</span></label>
                                    <input type="hidden" name="title[]" value="آزمون تستی">
                                    <div class="col-md-6 col-sm-10">
                                        <select name='value[]' class='form-control' required>
                                            @for ($i = 20; $i > 0; $i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="job">5-موضوعات انتخابی برای نقاشی :
                                        <span class="required">*</span></label>
                                    <input type="hidden" name="title[]" value="موضوعات انتخابی برای نقاشی">
                                    <div class="col-md-6 col-sm-10">
                                        <select name='value[]' class='form-control' required>
                                            @for ($i = 20; $i > 0; $i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="job">ب-متسابق عزیز، هرگونه پیشنهاد یا انتقادی دارید، می توانید در این قسمت برای ما بنویسید:
                                        <span class="required">*</span></label>
                                    <input type="hidden" name="title[]" value="متسابق عزیز، هرگونه پیشنهاد یا انتقادی دارید، می توانید در این قسمت برای ما بنویسید">
                                    <div class="col-md-6 col-sm-10">
                                        <input type="text" name="value[]" id="" value="" id="input-name"
                                               class="form-control" required/>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="job">ج-لطفا دلنوشته ای با حاج قاسم عزیز داشته باشید:
                                        <span class="required">*</span></label>
                                    <input type="hidden" name="title[]" value="لطفا دلنوشته ای با حاج قاسم عزیز داشته باشید">
                                    <div class="col-md-6 col-sm-10">
                                        <input type="text" name="value[]" id="" value="" id="input-name"
                                               class="form-control" required/>

                                    </div>
                                </div>
                            </div>
                            <br><br>

                            <div class="d-flex justify-content-center mb-2">

                                <div class="p-2 ">
                                    <button type="submit" class="btn btn-primary">ثبت نهایی</button>
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


