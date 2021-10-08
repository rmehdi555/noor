@extends('teacher.master')
@section('content')


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



                        <form class="form-horizontal" method="POST" action="{{ route('teacher.class.create.save') }}">
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
                                                        id="option-province-id" @php if($user->teacher->province==$item->id) echo "selected"; @endphp>{{$item->name}}</option>
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
                                                        id="option-city-{{$item->id}}" @php if($user->teacher->city==$item->id) echo "selected"; @endphp>{{$item->name}}</option>
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


