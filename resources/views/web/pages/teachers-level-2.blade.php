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

    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">
                        <a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_students_level_link"]->value)}}">
                            <p class="p-1 text-justify">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["box_students_level_body"]->value) !!}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary m-1">
                        {!! \App\Providers\MyProvider::_text($siteDetailsProvider["page_students_level_2_body"]->value) !!}
                    </div>
                </div>
            </div>

        </div>
    </section>

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

                        <form class="form-horizontal" id="form-level-2-save" method="POST"
                              action="{{ route('web.students.level.2.save') }}">
                            @csrf
                            <input type="hidden" name="class_type" value="{{$request->class_type}}">
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
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="sh_number">{{__('web/public.sh_number')}} : <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="sh_number" id="sh_number" value="{{old('sh_number')}}"
                                               id="input-name"
                                               class="form-control  @error('sh_number') is-invalid @enderror" required/>
                                        @error('sh_number')
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
                                        <input type="number" pattern="[0-9]{10}" name="meli_number" id="meli_number"
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
                                           for="sh_sodor">{{__('web/public.sh_sodor')}} : <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="sh_sodor" id="sh_sodor" value="{{old('sh_sodor')}}"
                                               id="input-name"
                                               class="form-control  @error('sh_sodor') is-invalid @enderror" required/>
                                        @error('sh_sodor')
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
                                           for="tavalod_date">{{__('web/public.tavalod_date')}} : <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-12">
                                        <div class='form-inline row'>
                                            <div class='form-group col-sm-4'>
                                                <select name='tavalod_date_d' class='form-control' required>
                                                    <option selected
                                                            disabled>{{__('web/public.tavalod_date_d')}}</option>
                                                    @for ($i = 1; $i < 32; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class='form-group col-sm-4'>
                                                <select name='tavalod_date_m' class='form-control' required>
                                                    <option selected
                                                            disabled>{{__('web/public.tavalod_date_m')}}</option>
                                                    @for ($i = 1; $i < 13; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class='form-group col-sm-4'>
                                                <select name='tavalod_date_y' class='form-control' required>
                                                    <option selected
                                                            disabled>{{__('web/public.tavalod_date_y')}}</option>
                                                    @for ($i = 1400; $i > 1295; $i--)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="married">{{__('web/public.married')}} : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <label class="radio-inline" style="padding: 10px 40px 10px">
                                            <input type="radio" name="married" checked
                                                   value="no">{{__('web/public.married_no')}}
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="married"
                                                   value="yes">{{__('web/public.married_yes')}}
                                        </label>

                                        @error('married')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row div-married div-married-yes">

                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="number_of_children">{{__('web/public.number_of_children')}} : <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="number" value="0" min="0" max="20" name="number_of_children"
                                               id="number_of_children" value="{{old('number_of_children')}}"
                                               class="form-control input-married input-married-yes  @error('number_of_children') is-invalid @enderror"/>
                                        @error('number_of_children')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row div-married div-married-no">

                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="phone_f">{{__('web/public.phone_f')}} : </label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="tel" placeholder="{{__('web/public.example')}} : 09125555555"
                                               pattern="09[0-9]{9}" name="phone_f" id="phone_f"
                                               value="{{old('phone_f')}}"
                                               class="form-control  @error('phone_f') is-invalid @enderror"/>
                                        @error('phone_f')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="phone_m">{{__('web/public.phone_m')}} : </label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="tel" placeholder="{{__('web/public.example')}} : 09125555555"
                                               pattern="09[0-9]{9}" name="phone_m" id="phone_m"
                                               value="{{old('phone_m')}}" id="input-name"
                                               class="form-control  @error('phone_m') is-invalid @enderror"/>
                                        @error('phone_m')
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
                                           for="phone_1">{{__('web/public.phone_1')}} : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="tel" placeholder="{{__('web/public.example')}} : 09125555555"
                                               pattern="09[0-9]{9}" name="phone_1" id="phone_1"
                                               value="{{old('phone_1')}}"
                                               class="form-control  @error('phone_1') is-invalid @enderror" required/>
                                        <span> ({{__('web/public.phone_1_help')}})</span>
                                        @error('phone_1')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="phone_2">{{__('web/public.phone_2')}} :</label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="tel" placeholder="{{__('web/public.example')}} : 09125555555"
                                               pattern="09[0-9]{9}" name="phone_2" id="phone_2"
                                               value="{{old('phone_2')}}" id="input-name"
                                               class="form-control  @error('phone_2') is-invalid @enderror"/>
                                        @error('phone_2')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="tel">{{__('web/public.tel')}} :
                                        </label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="tel" id="tel"
                                               placeholder="{{__('web/public.example')}} : 02122334455"
                                               value="{{old('tel')}}"
                                               class="form-control  @error('tel') is-invalid @enderror" required/>
                                        @error('tel')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="email">{{__('web/public.email')}} :</label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="email" name="email" id="email" value="{{old('email')}}"
                                               class="form-control  @error('email') is-invalid @enderror"/>
                                        @error('email')
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
                                            <option value="0" selected
                                                    disabled>{{__('web/public.select_option')}}</option>
                                            @foreach ($provinces as $item)
                                                <option value="{{$item->id}}" class="option-province"
                                                        id="option-province-id">{{$item->name}}</option>
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
                                            <option value="0" selected
                                                    disabled>{{__('web/public.select_option')}}</option>
                                            @foreach ($cities as $item)
                                                <option value="{{$item->id}}"
                                                        class="option-city option-city-{{$item->province_id}}"
                                                        id="option-city-{{$item->id}}">{{$item->name}}</option>
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
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="post_number">{{__('web/public.post_number')}} : <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="post_number" id="post_number"
                                               value="{{old('post_number')}}" id="input-name"
                                               class="form-control  @error('post_number') is-invalid @enderror"
                                               required/>
                                        @error('post_number')
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
                                           for="education">{{__('web/public.education')}} : <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="education" id="education" value="{{old('education')}}"
                                               class="form-control  @error('education') is-invalid @enderror" required/>
                                        @error('education')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="job">{{__('web/public.job')}} :
                                        <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="job" id="job" value="{{old('job')}}" id="input-name"
                                               class="form-control  @error('job') is-invalid @enderror" required/>
                                        @error('job')
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
                                                    href="{{ route('web.students.level.1.cancel') }}">{{__('web/public.cancel')}}</a>
                                </div>
                                <div class="p-2 ">
                                    <button type="submit"
                                            class="btn btn-primary">{{__('web/public.next')}}</button>
                                </div>
                            </div>


                        </form>
                        <br><br>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


