@extends('web.master-product')
@section('content')

    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->
        {{--<ul class="breadcrumb">--}}
        {{--<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="index.html" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>--}}
        {{--<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="category.html" itemprop="url"><span itemprop="title">الکترونیکی</span></a></li>--}}
        {{--<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="product.html" itemprop="url"><span itemprop="title">لپ تاپ ایلین ور</span></a></li>--}}
        {{--</ul>--}}
        <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-9">
                    <form class="form-horizontal" method="POST" action="{{ route('register.sms') }}">
                        @csrf
                        <h1 class="title">{{__('web/public.register')}}</h1>
                        <p>{{__('web/messages.register_1')}} <a href="{{ route('login') }}"> {{__('web/messages.register_2')}} </a> {{__('web/messages.register_3')}}</p>
                        <fieldset id="account">
                            <legend>{{__('web/public.register_user_info')}}</legend>

                            <div class="form-group required">
                                <label for="input-firstname" class="col-sm-2 control-label">{{__('web/public.name')}}</label>
                                <div class="col-sm-10">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="input-firstname" class="col-sm-2 control-label">{{__('web/public.family')}}</label>
                                <div class="col-sm-10">
                                    <input id="family" type="text" class="form-control @error('family') is-invalid @enderror" name="family" value="{{ old('family') }}" required autocomplete="family" autofocus>

                                    @error('family')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="input-email" class="col-sm-2 control-label">{{__('web/public.email')}}</label>
                                <div class="col-sm-10">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="input-telephone" class="col-sm-2 control-label">{{__('web/public.phone')}}</label>
                                <div class="col-sm-10">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </fieldset>

                        <fieldset>
                            <legend>{{__('web/public.register_user_password')}}</legend>
                            <div class="form-group required">
                                <label for="input-password" class="col-sm-2 control-label">{{__('web/public.password')}}</label>
                                <div class="col-sm-10">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="input-confirm" class="col-sm-2 control-label">{{__('web/public.re_password')}}</label>
                                <div class="col-sm-10">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
            </div>
            <!--Middle Part End -->






@endsection
