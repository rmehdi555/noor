@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            {{--<div class="block-header">--}}
            {{--<div class="row">--}}
            {{--<div class="col-lg-5 col-md-8 col-sm-12">--}}
            {{--<h2>Jquery Datatable</h2>--}}
            {{--</div>--}}
            {{--<div class="col-lg-7 col-md-4 col-sm-12 text-right">--}}
            {{--<ul class="breadcrumb justify-content-end">--}}
            {{--<li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}




            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>{{__('admin/public.edit')}}</h2>
                        </div>
                        <div class="body">

                            <form class="form-horizontal" id="form-level-1-save" method="POST"
                                  action="{{ route('mosabeghe.update',$field->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                @include('admin.section.errors')
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label" for="name">{{__('web/public.name')}}
                                            : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="name" id="name" value="{{$field->name}}"
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
                                            <input type="text" name="family" id="family" value="{{$field->family}}"
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
                                                   value="{{$field->meli_number}}"
                                                   class="form-control  @error('meli_number') is-invalid @enderror"
                                                   disabled/>
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
                                            <input type="text" name="f_name" id="f_name" value="{{$field->f_name}}"
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
                                            <input type="tel"
                                                   pattern="09[0-9]{9}" name="phone"
                                                   value="{{$field->phone}}"
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
                                                       value="کتاب خوانی" @php echo in_array("کتاب خوانی",$field->type)?"checked":"";@endphp
                                                       >کتاب خوانی
                                            </label>
                                            <label class="form-check-inline">
                                                <input type="checkbox"
                                                       name="type[]"
                                                       value="هنرنمایی در قاب نقاشی" @php echo in_array("هنرنمایی در قاب نقاشی",$field->type)?"checked":"";@endphp
                                                >هنرنمایی در قاب نقاشی
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
                                               for="province">{{__('admin/public.province')}} : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <select name='province' class='form-control' id="select-province" required>
                                                <option value="0" selected
                                                        disabled>{{__('admin/public.select_option')}}</option>
                                                @foreach ($provinces as $item)
                                                    <option value="{{$item->id}}" class="option-province"
                                                            id="option-province-id" @php if($field->province==$item->id) echo "selected"; @endphp>{{$item->name}}</option>
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
                                        <label class="col-md-6 col-sm-6 control-label" for="city">{{__('admin/public.city')}}
                                            : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <select name='city' class='form-control' id="select-city" required>
                                                <option value="0" selected
                                                        disabled>{{__('admin/public.select_option')}}</option>
                                                @foreach ($cities as $item)
                                                    <option value="{{$item->id}}"
                                                            class="option-city option-city-{{$item->province_id}}"
                                                            id="option-city-{{$item->id}}" @php if($field->city==$item->id) echo "selected"; @endphp>{{$item->name}}</option>
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
                                               for="address">{{__('admin/public.address')}} : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="text" name="address" id="address" value="{{$field->address}}"
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
                                        <button type="submit"
                                        class="btn btn-primary">{{__('admin/public.edit')}}</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection