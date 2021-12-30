@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="body">

    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary m-1">
                       جهت ایجاد کلاس جدید اطلاعات را بادقت وارد نمایید
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



                        <form class="form-horizontal" method="POST" action="{{ route('admin.class.create.save') }}">
                            @csrf
                            <p class="bu-margin-bottom-30">نوع کلاس را انتخاب کنید : </p>
                            <div class="row">
                                <div class="col-md-6">
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
                                <div class="col-md-6">
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

                            </div>

                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="name">عنوان کلاس
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="name" id="name"
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
                                        <input type="text" name="description" id="description"
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
                                        <input type="number" name="number_students" id="number_students"
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
                                        <input type="text" name="old" id="old" placeholder="مثلا : 10-15"
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
                                                        id="option-province-id" >{{$item->name}}</option>
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
                                                        id="option-city-{{$item->id}}" >{{$item->name}}</option>
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
                                        <input type="text" name="address" id="address"
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
                                                                value="{{$item->id}}">{{\App\Providers\MyProvider::_text($item->title)}}</option>
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
                                    <label class="col-md-6 col-sm-6 control-label" for="address">معلم برگزار کننده کلاس
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <select class="form-control js-example-basic-single" name="teacher_id">
                                            @foreach ($teachers as $item)
                                                <option value="{{$item->user_id}}">{{$item->teacher_id}} : {{$item->name}} {{$item->family}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label>{{__('admin/public.type')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="type" class="multiselect multiselect-custom" >
                                            <option value="student">برای قرآن آموزها</option>
                                            <option value="teacher">برای معلم ها</option>
                                        </select>
                                    </div>


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label>نوع لیست ثبت فعالیت قرآن آموز ها را انتخاب نمایید :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="act_list_name" class="multiselect multiselect-custom" >
                                            <option value="act_list_public">لیست عمومی</option>
                                            <option value="act_list_hefz">لیست حفظ</option>
                                            <option value="act_list_hefz_t"> لیست حفظ تخصصی</option>
                                        </select>
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
                                                <option  value="{{$item->id}}">{{\App\Providers\MyProvider::_text($item->title)}}</option>
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
                                            <option  value="1" selected>تازه ایجاد شده</option>
                                            <option  value="2">در حال برگزاری</option>
                                            <option  value="4">آزمون</option>
                                            <option  value="5">اتمام رسیده</option>

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


