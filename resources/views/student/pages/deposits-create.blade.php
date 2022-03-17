@extends('student.master')
@section('content')

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




                        <form class="form-horizontal" method="POST" action="{{ route('student.deposits.save') }}">
                            @csrf
                            <p class="bu-margin-bottom-30">پرداختی جدید : </p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label class=" control-label"
                                               for="input-name">نوع پرداختی را انتخاب نمایید : <span class="required">*</span> </label>
                                        <div class="col-md-10 col-sm-9">
                                            <select name="deposits_type_id" id="select-deposits-type"
                                                    class="form-control  @error('field_main') is-invalid @enderror">
                                                @foreach($depositsType as $item)
                                                        <option class="deposits-type deposits-type-{{$item->type}}" id="deposits-type-{{$item->id}}"
                                                                value="{{$item->id}}">{{\App\Providers\MyProvider::_text($item->title)}}</option>
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
                            </div>
                                @foreach($depositsType as $item)
                                    <input type="hidden" id="d-t-type-value-{{$item->id}}" value="{{$item->type}}">
                                    <input type="hidden" id="d-t-title-value-{{$item->id}}" value="{{$item->title}}">
                                    <input type="hidden" id="d-t-price-value-{{$item->id}}" value="{{$item->price}}">
                                @endforeach
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label"
                                               for="province">عنوان: <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="text" name="title" id="title" value="{{old('title')}}"
                                                   class="form-control  @error('title') is-invalid @enderror" required />
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>

                                    </div>

                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label"
                                               for="province">مبلغ :  (ریال)<span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="text" name="price" id="price" value="{{old('price')}}"
                                                   class="form-control  @error('title') is-invalid @enderror" required/>
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>

                                    </div>



                                </div>
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label"
                                           for="province">سال: <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-6">
                                        <select name="year" id="year"
                                                class="form-control  @error('field_main') is-invalid @enderror">
                                            @for($i=1395;$i<1409;$i++)
                                                <option class="year" id="year"
                                                        value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label"
                                           for="province">ماه : <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-6">
                                        <select name="month" id="month"
                                                class="form-control  @error('field_main') is-invalid @enderror">
                                            @for($i=1;$i<=12;$i++)
                                                <option class="month" id="month"
                                                        value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>

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
                                                       value="ثبت ">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                        </form>




                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


