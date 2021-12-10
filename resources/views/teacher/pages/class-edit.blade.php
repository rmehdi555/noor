@extends('teacher.master')
@section('content')


    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary m-1">
                       جهت ویرایش کلاس جدید اطلاعات را بادقت وارد نمایید
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



                        <form class="form-horizontal" method="POST" action="{{ route('teacher.class.edit.save') }}">
                            @csrf
                            <input value="{{$classRoom->id}}" type="hidden" name="class_room_id">

                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="name">عنوان کلاس
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="name" id="name" value="{{$classRoom->name}}"
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
                                           for="description">{{__('web/public.description')}} : <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="description" id="description" value="{{$classRoom->description}}"
                                               class="form-control  @error('description') is-invalid @enderror" required/>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="number_students">تعداد قرآن آموزان
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="number" name="number_students" id="number_students" value="{{$classRoom->number_students}}"
                                               class="form-control  @error('number_students') is-invalid @enderror" required/>
                                        @error('number_students')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="old">رده سنی  : <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="old" id="old" placeholder="مثلا : 10-15" value="{{$classRoom->old}}"
                                               class="form-control  @error('old') is-invalid @enderror" required/>
                                        @error('old')
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
                                                        id="option-province-id" @if($classRoom->province==$item->id) selected @endif >{{$item->name}}</option>
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
                                                        id="option-city-{{$item->id}}"  @if($classRoom->city==$item->id) selected @endif>{{$item->name}}</option>
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
                                    <label class="col-md-6 col-sm-6 control-label" for="address">آدرس
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="address" id="address" value="{{$classRoom->address}}"
                                               class="form-control  @error('address') is-invalid @enderror" required/>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class=" col-md-12 col-sm-12 control-label"
                                           for="input-name">نوع نمره دهی را انتخاب نمایید : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <select name="mark_type_id" id="mark_type_id"
                                                class="form-control  @error('mark_type_id') is-invalid @enderror" required >
                                            @foreach($markTypes as $item)
                                                <option class=""
                                                        id=""
                                                        value="{{$item->id}}" @if($classRoom->mark_type_id==$item->id) selected @endif>{{\App\Providers\MyProvider::_text($item->title)}}</option>
                                            @endforeach
                                        </select>
                                        @error('mark_type_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class=" col-md-12 col-sm-12 control-label"
                                           for="input-name">آزمون این کلاس را انتخاب کنید : </label>
                                    <div class="col-md-12 col-sm-10">
                                        <select name="exam_id" id="exam_id"
                                                class="form-control  @error('exam_id') is-invalid @enderror" >
                                            <option  value="0">هنوز آزمونی درنظر گرفته نشده</option>
                                            @foreach($exams as $item)
                                                <option  value="{{$item->id}}"  @if($classRoom->exam_id==$item->id) selected @endif>{{\App\Providers\MyProvider::_text($item->title)}}</option>
                                            @endforeach
                                        </select>
                                        @error('exam_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class=" col-md-12 col-sm-12 control-label"
                                           for="input-name">وضعیت کلاس را مشخص نمایید : </label>
                                    <div class="col-md-12 col-sm-10">
                                        <select name="status" id="status"
                                                class="form-control  @error('status') is-invalid @enderror" >
                                            <option  value="1" @if($classRoom->status==1) selected @endif>تازه ایجاد شده</option>
                                            <option  value="2" @if($classRoom->status==2) selected @endif>در حال برگزاری</option>
                                            <option  value="4" @if($classRoom->status==4) selected @endif>آزمون</option>
                                            <option  value="5" @if($classRoom->status==5) selected @endif>اتمام رسیده</option>

                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>



                            <div class="row">

                                <div class="col-md-6 padding-top-15">
                                    <label class=" control-label"
                                           for="input-name"><br></label>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <input type="submit" class="btn btn-primary"
                                                   value="{{__('web/public.submit')}}">
                                        </div>
                                    </div>
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


