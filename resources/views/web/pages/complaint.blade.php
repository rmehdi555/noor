@extends('web.master')
@section('content')

    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{ route('web.complaint.index') }}">{{__('web/public.complaint')}}</a></li>
            </ul>
            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-9" >
                    <h1 class="title">{{__('web/public.complaint')}}</h1>

                    <form class="form-horizontal" method="POST" action="{{ route('web.complaint.insert') }}">
                        @csrf
                        <fieldset>
                            <h3 class="subtitle">{{__('web/messages.complaint_title')}}</h3>
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
                                <label class="col-md-2 col-sm-3 control-label" for="input-enquiry">{{__('web/public.body_complaint')}}</label>
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
                <aside id="column-right" class="col-sm-3 hidden-xs">
                    <div class="list-group">
                        <h2 class="subtitle">{{__('web/public.contact_us_info')}}</h2>
                        <i class="fa fa-map-marker"></i>
                        <br>{{\App\Providers\MyProvider::_text($siteDetailsProvider["address"]->value)}}
                        <br>
                        <br>
                        <i class="fa fa-phone"></i>
                        <br>{{\App\Providers\MyProvider::_text($siteDetailsProvider["phone"]->value)}}
                        <br>
                        <br>
                        <i class="fa fa-phone"></i>
                        <br>{{\App\Providers\MyProvider::_text($siteDetailsProvider["mobile"]->value)}}
                        <br>
                        <br>
                        <i class="fa fa-envelope"></i>
                        <br>{{\App\Providers\MyProvider::_text($siteDetailsProvider["email"]->value)}}
                    </div>
                    <div class="banner owl-carousel">

                    </div>
                </aside>
                <!--Middle Part End -->
            </div>
        </div>
    </div>

@endsection