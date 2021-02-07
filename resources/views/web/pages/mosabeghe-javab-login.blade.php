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
                            آزمون در ساعت اعلام شده اجرا خواهد شد.
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
                              action="{{ route('web.mosabeghe.javab.login.check') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-12 padding-top-15">
                                    <label class="col-md-9 col-sm-9 control-label"
                                           for="phone_1">بخشهایی که میخواهید شرکت کنید را انتخاب نمایید : <span class="required">*</span></label>
                                    <div class="col-md-10 col-sm-9 padding-top-15">
                                        <label class="form-check-inline">
                                            <input type="checkbox" name="type[]"
                                                   value="کتاب خوانی"
                                                   checked>کتاب خوانی
                                        </label>
                                        <label class="form-check-inline">
                                            <input type="checkbox"
                                                   name="type[]"
                                                   value="هنرنمایی در قاب نقاشی"
                                                   checked>هنرنمایی در قاب نقاشی
                                        </label>
                                        @error('class_type')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="meli_number">{{__('web/public.meli_number')}} : <span
                                                class="required">*</span> </label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="number" pattern="[0-9]{10}" maxlength="10" minlength="10"
                                               name="meli_number" id="meli_number"
                                               value="{{old('meli_number')}}"
                                               class="form-control  @error('meli_number') is-invalid @enderror"
                                               required/>
                                        <span>کد ملی ثبت نام کننده .</span>
                                        @error('meli_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="f_name">کد ثبت نامی : <span
                                            class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="id" id="id" value="{{old('id')}}"
                                               class="form-control  @error('id') is-invalid @enderror"/>
                                        <span> کد ثبت نامی مسابقه که برایتان پیامک شده.</span>
                                        @error('id')

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
                                    <button type="submit" class="btn btn-primary">ورود</button>
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


