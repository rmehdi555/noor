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
                        <p class="p-2 text-justify">
                            <h5>
                            متسابق عزیز
                            {{$mosabegheMalekeZaman->name}} {{$mosabegheMalekeZaman->family}}
                            خوش آمدید .
                        </h5>

                        </p>
                        <p class="p-2 text-justify">
                        <h5>
                           تصویر نقاشی باید باکیفیت بالا و یکی از فرمت های
                            .png,
                            .jpg
                            .jpeg
                            باشد .
                        </h5>
                        <br>

                        <h5>

                                * بعد از بارگذاری تصویر امکان ویرایش آن امکان پذیر نمیباشد لذا در انتخاب دقت نمایید .

                        </h5>
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
                              action="{{ route('web.mosabeghe.javab.naghashi.save') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_meli_number" value="{{$mosabegheMalekeZaman->meli_number}}">
                            <input type="hidden" name="user_mosabeghe_id" value="{{$mosabegheMalekeZaman->id}}">

                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="file_url">نقاشی را انتخاب نمایید : <span
                                                class="required">*</span> </label>
                                    <div class="col-md-12 col-sm-10">
                                        <div class="custom-file ">
                                            <input type="file" class="custom-file-input " id="customFile"
                                                   name="file_url" required>
                                            <label class="custom-file-label text-align-left" for="customFile"></label>
                                            <span></span>
                                        </div>
                                        @error('file_url')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="job">توضیحاتی از حال و هوای نقاشی :
                                        <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="description" id="description" value="{{old('description')}}" id="input-name"
                                               class="form-control  @error('description') is-invalid @enderror" required/>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
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


