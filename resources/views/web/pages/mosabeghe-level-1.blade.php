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

                        <p class="p-1 text-justify">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["box_mosabeghe_maleke_zaman_level_1_body"]->value) !!}</p>

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
                              action="{{ route('web.mosabeghe.maleke.zaman.level.1.save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="name">{{__('web/public.name')}}
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="name" id="name" value="{{old('name')}}"
                                               class="form-control  @error('name') is-invalid @enderror" required/>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="family">{{__('web/public.family')}} : <span
                                            class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="family" id="family" value="{{old('family')}}"
                                               class="form-control  @error('family') is-invalid @enderror" required/>
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
                                           for="meli_number">{{__('web/public.meli_number')}} : <span
                                                class="required">*</span> </label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="number" pattern="[0-9]{10}" maxlength="10" minlength="10"
                                               name="meli_number" id="meli_number"
                                               value="{{old('meli_number')}}"
                                               class="form-control  @error('meli_number') is-invalid @enderror"
                                               required/>
                                        <span> ({{__('web/public.meli_number_help')}})</span>
                                        @error('meli_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="f_name">{{__('web/public.f_name')}} : <span
                                            class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="f_name" id="f_name" value="{{old('f_name')}}"
                                               class="form-control  @error('f_name') is-invalid @enderror"/>
                                        @error('f_name')
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
                                           for="phone_1">{{__('web/public.phone')}} : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="tel" placeholder="{{__('web/public.example')}} : 09125555555"
                                               pattern="09[0-9]{9}" name="phone" id="phone"
                                               value="{{old('phone')}}"
                                               class="form-control  @error('phone') is-invalid @enderror"
                                               maxlength="11" minlength="11" required/>

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-9 col-sm-9 control-label"
                                           for="phone_1">علاقه مند به شرکت در کدام بخش از مسابقه هستید : <span class="required">*</span></label>
                                    <div class="col-md-10 col-sm-9 padding-top-15">
                                        <label class="form-check-inline">
                                            <input type="checkbox" name="type[]"
                                                   value="کتاب خوانی"
                                                   checked>کتاب خوانی
                                        </label>
                                        <label class="form-check-inline">
                                            <input type="checkbox"
                                                   name="type[]"
                                                   value="هنرنمایی در قاب نقاشی">هنرنمایی در قاب نقاشی
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
                                           for="province">{{__('web/public.province')}} : <span
                                            class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <select name='province' class='form-control' id="select-province" required>
                                            <option value="0" @php if(empty(old('province'))) echo "selected"; @endphp
                                            disabled>{{__('web/public.select_option')}}</option>
                                            @foreach ($provinces as $item)
                                                <option value="{{$item->id}}" class="option-province"
                                                        id="option-province-id" @php if(old('province')==$item->id) echo "selected"; @endphp>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('province')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="city">{{__('web/public.city')}}
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <select name='city' class='form-control' id="select-city" required>
                                            <option value="0" @php if(empty(old('city'))) echo "selected"; @endphp
                                            disabled>{{__('web/public.select_option')}}</option>
                                            @foreach ($cities as $item)
                                                <option value="{{$item->id}}"
                                                        class="option-city option-city-{{$item->province_id}}"
                                                        id="option-city-{{$item->id}}" @php if(old('city')==$item->id) echo "selected"; @endphp>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
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
                                           for="address">{{__('web/public.address')}} : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="address" id="address" value="{{old('address')}}"
                                               class="form-control  @error('address') is-invalid @enderror" required/>
                                        @error('address')
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
                                    <button type="submit" class="btn btn-primary">{{__('web/public.submit')}}</button>
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


