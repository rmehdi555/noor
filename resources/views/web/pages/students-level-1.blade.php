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
                        {!! \App\Providers\MyProvider::_text($siteDetailsProvider["page_students_level_1_body"]->value) !!}
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

                        <form class="form-horizontal" id="form-level-1-save" method="POST"
                              action="{{ route('web.students.level.1.save') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="input-name">{{__('web/public.select_class_type')}} :</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-10 col-sm-9">
                                        <label class="radio-inline">
                                            <input type="radio" name="class_type"
                                                   value="{{__('web/public.select_class_type_online')}}"
                                                   checked>{{__('web/public.select_class_type_online')}}
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio"
                                                   name="class_type"
                                                   value="{{__('web/public.select_class_type_verbal')}}">{{__('web/public.select_class_type_verbal')}}
                                        </label>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </form>
                        <br><br>


                        <form class="form-horizontal" method="POST" action="{{ route('web.students.field.add') }}">
                            @csrf
                            <p class="bu-margin-bottom-30">{{__('web/public.student_field_add_new')}} : </p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class=" control-label"
                                               for="input-name">{{__('web/public.select_field_main')}} : <span class="required">*</span> </label>
                                        <div class="col-md-10 col-sm-9">
                                            <select name="field_main" id="select-field-main"
                                                    class="form-control  @error('field_main') is-invalid @enderror">
                                                @foreach($fields as $item)
                                                    @if($item->parent_id==0)
                                                        <option class="option-field-main"
                                                                id="option-field-main-{{$item->id}}"
                                                                value="{{$item->id}}" @php if($item->status==0)echo"disabled";@endphp>{{\App\Providers\MyProvider::_text($item->title)}}</option>
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
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class=" control-label"
                                               for="input-name">{{__('web/public.select_field_child')}} : <span class="required">*</span></label>
                                        <div class="col-md-10 col-sm-9">
                                            <select name="field_child" id="select-field-child"
                                                    class="form-control  @error('field_main') is-invalid @enderror" required >
                                                {{--<option selected>{{__('web/public.select_field_child')}}</option>--}}
                                                @foreach($fields as $item)
                                                    @if($item->parent_id!=0 OR !isset($item->children[1]))
                                                        <option class="option-field-child option-field-child-{{$item->parent_id==0?$item->id:$item->parent_id}}"
                                                                id="option-field-child-{{$item->id}}"
                                                                value="{{$item->id}}" @php if($item->status==0)echo"disabled";@endphp>{{\App\Providers\MyProvider::_text($item->title)}}</option>
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
                                @if(count($studentFields)>0)
                                    <div class="col-md-4">
                                        <label class=" control-label"
                                               for="input-name"><br></label>
                                        <div class="buttons">
                                            <div class="pull-right">
                                                <input type="submit" class="btn btn-primary"
                                                       value="{{__('web/public.btn_add_field')}}">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-4">
                                        <label class=" control-label"
                                               for="input-name"><br></label>
                                        <div class="buttons">
                                            <div class="pull-right">
                                                <input type="submit" class="btn btn-primary"
                                                       value="{{__('web/public.select')}}">
                                            </div>
                                        </div>
                                    </div>
                                    @endif


                            </div>

                            <fieldset>


                            </fieldset>

                        </form>


                        <br><br>
                        @if(count($studentFields)>0)
                            <p class="bu-margin-bottom-30">{{__('web/public.student_field_select')}} : </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('web/public.title_field')}}</th>
                                        <th>{{__('web/public.price')}}({{__('web/public.currency_name_IRR')}})</th>
                                        <th>{{__('web/public.setting')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; $finalPrice=0;@endphp
                                    @foreach($studentFields as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{number_format($item->price)}}</td>
                                            <td><a class="btn btn-danger btn-sm"
                                                   href="{{ route('web.students.field.delete',$item->id) }}">{{__('web/public.delete')}}</a>
                                            </td>
                                        </tr>
                                        @php $i++; $finalPrice+=$item->price; @endphp
                                    @endforeach
                                    <tr class="table-primary">
                                        <td colspan='2'>{{__('web/public.price_final')}}
                                            ({{__('web/public.currency_name_IRR')}}) :
                                        </td>
                                        <td colspan='2'>{{$finalPrice}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br><br>
                            <div class="d-flex justify-content-center mb-2">
                                <div class="p-2"><a class="btn btn-danger"
                                                    href="{{ route('web.students.level.1.cancel') }}">{{__('web/public.cancel')}}</a>
                                </div>
                                <div class="p-2 ">
                                    <button id="button-level-1-save"
                                            class="btn btn-primary">{{__('web/public.next')}}</button>
                                </div>
                            </div>

                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


