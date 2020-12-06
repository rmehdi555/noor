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
                <div class="container p-3 my-3 bg-primary text-white align-center">
                    <h1>
                        <a href="{{\App\Providers\MyProvider::_text($siteDetailsProvider["box_students_level_link"]->value)}}">{!! \App\Providers\MyProvider::_text($siteDetailsProvider["box_students_level_body"]->value) !!}</a>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                {!! \App\Providers\MyProvider::_text($siteDetailsProvider["page_students_level_1_body"]->value) !!}
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
                        <div class="row">
                            <div class="col-md-6">
                                <label for="input-name">{{__('web/public.select_class_type')}} :</label>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-10 col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="class_type"
                                               checked>{{__('web/public.select_class_type_online')}}
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio"
                                               name="class_type">{{__('web/public.select_class_type_verbal')}}
                                    </label>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <br><br>
                        @if(isset($studentFields[1]))
                            <p class="bu-margin-bottom-30">{{__('web/public.student_field_select')}} : </p>
                            @foreach($studentFields as $item)
                                <div class="row">
                                    <div class="col-md-3">
                                        {{$item->title}}
                                    </div>
                                    <div class="col-md-3">
                                        {{$item->price}}
                                    </div>
                                    <div class="col-md-3">
                                        {{$item->title}}
                                    </div>
                                    <div class="col-md-3">
                                        {{$item->price}}
                                    </div>
                                </div>
                                <br><br>
                            @endforeach
                        @endif


                        <form class="form-horizontal" method="POST" action="{{ route('web.students.level.1.save') }}">
                            @csrf
                            <p class="bu-margin-bottom-30">{{__('web/public.student_field_add_new')}} : </p>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group required">
                                        <label class=" control-label"
                                               for="input-name">{{__('web/public.select_field_main')}} :</label>
                                        <div class="col-md-10 col-sm-9">
                                            <select name="field_main" id="select-field-main"
                                                    class="form-control  @error('field_main') is-invalid @enderror">
                                                @foreach($fields as $item)
                                                    @if($item->parent_id==0)
                                                        <option class="option-field-main" id="option-field-main-{{$item->id}}" value="{{$item->id}}">{{\App\Providers\MyProvider::_text($item->title)}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('field_main')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group required">
                                        <label class=" control-label"
                                               for="input-name">{{__('web/public.select_field_child')}} :</label>
                                        <div class="col-md-10 col-sm-9">
                                            <select name="field_child"  id="select-field-child"
                                                    class="form-control  @error('field_main') is-invalid @enderror">
                                                <option value="0">{{__('web/public.select_field_child')}}</option>
                                                @foreach($fields as $item)
                                                    @if($item->parent_id!=0 OR !isset($item->children[1]))
                                                        <option class="option-field-child option-field-child-{{$item->parent_id==0?$item->id:$item->parent_id}}" id="option-field-child-{{$item->id}}"value="{{$item->id}}">{{\App\Providers\MyProvider::_text($item->title)}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('field_child')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class=" control-label"
                                           for="input-name"><br></label>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <input type="submit" class="btn btn-primary" value="{{__('web/public.submit')}}">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <fieldset>


                            </fieldset>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


