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
                            <h1 class="main-inner-banner-ct-name">{{__('web/public.contact_us')}}</h1>
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
                    <div class="bu-inner-main-cont">
                        <p class="bu-margin-bottom-30">{{__('web/public.contact_us')}}</p>
                        <div class="bu-inner-main-contact">
                            <div class="bu-inner-mc-form  bu-margin-bottom-30">
                                <form class="form-horizontal" method="POST" action="{{ route('web.contact.us.insert') }}">
                                    @csrf
                                    <fieldset>

                                        @if(count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="form-group required">
                                            <label class="col-md-2 col-sm-3 control-label" for="input-name">{{__('web/public.name')}}</label>
                                            <div class="col-md-10 col-sm-9">
                                                <input type="text" name="name" value="{{old('name')}}" id="input-name" class="form-control  @error('name') is-invalid @enderror" />
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-md-2 col-sm-3 control-label" for="input-name">{{__('web/public.family')}}</label>
                                            <div class="col-md-10 col-sm-9">
                                                <input type="text" name="family" value="{{old('family')}}" id="input-name" class="form-control  @error('family') is-invalid @enderror" />
                                                @error('family')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-md-2 col-sm-3 control-label" for="input-email">آدرس ایمیل</label>
                                            <div class="col-md-10 col-sm-9">
                                                <input type="email" name="email" value="{{ old('email') }}" id="input-email" class="form-control  @error('email') is-invalid @enderror" />
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-md-2 col-sm-3 control-label" for="input-name">{{__('web/public.phone')}}</label>
                                            <div class="col-md-10 col-sm-9">
                                                <input type="text" name="phone" value="{{old('phone')}}" id="input-name" class="form-control  @error('phone') is-invalid @enderror" />
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-md-2 col-sm-3 control-label" for="input-enquiry">{{__('web/public.body_contact_us')}}</label>
                                            <div class="col-md-10 col-sm-9">
                                                <textarea name="body" rows="10" id="input-enquiry" class="form-control  @error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                                                @error('body')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <input type="submit" class="btn btn-primary" value="{{__('web/public.submit')}}">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="bu-inner-mc-info">
                                <div class="bu-title-cont bu-margin-bottom-20">
                                    <span class="bu-title-icon sqaure"></span>
                                    <h3 class="bu-title-name"> ارتباط با ما</h3>
                                </div>
                                <ul class="main-footer-contact-list main-inner-mc-info-list">
                                    <li>
                                        <i class="fal fa-location-arrow"></i>
                                        {!! \App\Providers\MyProvider::_text($siteDetailsProvider["address"]->value) !!}
                                    </li>
                                    <li>
                                        <i class="fal fa-envelope"></i>
                                        {{\App\Providers\MyProvider::_text($siteDetailsProvider["email"]->value)}}
                                    </li>
                                    <li>
                                        <i class="fal fa-phone"></i>
                                        {!! \App\Providers\MyProvider::_text($siteDetailsProvider["phone"]->value) !!}
                                    </li>
                                    <li>
                                        <i class="fal fa-phone"></i>
                                        {!! \App\Providers\MyProvider::_text($siteDetailsProvider["mobile"]->value) !!}
                                    </li>
                                </ul>
                                <ul class="main-header-trs-list main-inner-mc-social-list">
                                    <li><a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["instagram"]->value)}}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->



@endsection