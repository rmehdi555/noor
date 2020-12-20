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

                        <p class="p-1 text-justify">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["box_noor_level_1_body"]->value) !!}</p>

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
                              action="{{ route('web.noor.level.1.save') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="input-name">لطفا نوع شراکتتان را مشخص نمایید :</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">

                                        <div class="col-md-10 col-sm-9">
                                            <select name="type" id="select-type-noor"
                                                    class="form-control  @error('type') is-invalid @enderror"
                                                   >
                                                <option class="option-type-noor" value="1">وقف</option>
                                                <option class="option-type-noor" value="نذر">نذر</option>
                                                <option class="option-type-noor" value="خمس">خمس</option>
                                                <option class="option-type-noor" value="زکات">زکات</option>
                                                <option class="option-type-noor" value="کمک های نقدی دیگر ">کمک های نقدی
                                                    دیگر
                                                </option>
                                            </select>
                                            @error('type')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row div-type-noor-1">
                                <div class="col-md-6">
                                    <label for="input-name">موضوع وقف :</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">

                                        <div class="col-md-10 col-sm-9">
                                            <input type="text" name="description" id="description"
                                                   value="{{old('description')}}"  placeholder="توضیحات و موضوع وقف خود را بنویسند"
                                                   class="form-control input-type-noor-1 @error('description ') is-invalid @enderror"/>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row div-type-noor-all">
                                <div class="col-md-6">
                                    <label for="input-name">مبلغ واریز را وارد نمایید(ریال) :</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">

                                        <div class="col-md-10 col-sm-9">
                                            <input type="number" name="price" id="price"
                                                   value="{{old('price')}}"  placeholder="مبلغ واریزی به ریال وارد شود ."
                                                   class="form-control input-type-noor-all @error('price ') is-invalid @enderror"/>
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="input-name">مشخصات خود را وارد نمایید :</label>
                                </div>
                                <div class="col-md-6">




                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="mobile">{{__('web/public.mobile')}} : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="tel" placeholder="{{__('web/public.example')}} : 09125555555"
                                               pattern="09[0-9]{9}" name="mobile" id="mobile"
                                               value="{{old('mobile')}}"
                                               class="form-control input-type-noor-required  @error('mobile') is-invalid @enderror" required/>

                                        @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="name">{{__('web/public.name')}}
                                        : </label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="name" id="name" value="{{old('name')}}"
                                               class="form-control input-type-noor-1  @error('name') is-invalid @enderror" />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="family">{{__('web/public.family')}} : </label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="family" id="family" value="{{old('family')}}"
                                               class="form-control input-type-noor-1 @error('family') is-invalid @enderror" />
                                        @error('family')
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
                                           for="f_name">{{__('web/public.f_name')}} : </label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="f_name" id="f_name" value="{{old('f_name')}}"
                                               class="form-control input-type-noor-1 @error('f_name') is-invalid @enderror"/>
                                        @error('f_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="meli_number">{{__('web/public.meli_number')}} :  </label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="number" pattern="[0-9]{10}" name="meli_number" id="meli_number"
                                               value="{{old('meli_number')}}"
                                               class="form-control input-type-noor-1 @error('meli_number') is-invalid @enderror"

                                        />
                                        @error('meli_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br><br>

                            <div class="d-flex justify-content-center mb-2">
                                <div class="p-2"><a class="btn btn-danger"
                                                    href="{{ route('web.noor.level.1.cancel') }}">{{__('web/public.cancel')}}</a>
                                </div>
                                <div class="p-2 ">
                                    <button type="submit" class="btn btn-primary">{{__('web/public.next')}}</button>
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


