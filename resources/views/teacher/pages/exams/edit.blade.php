@extends('teacher.master')
@section('content')


    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary m-1">
                       جهت ویرایش آزمون اطلاعات را بادقت وارد نمایید
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary m-1">
                        دقت فرمایید بر اساس تاریخ و ساعت شروع آزمون قرآن آموزان تنها در همان زمان وارد شده به سواات و پاسخ دادن به آنها دسترسی خواهند داشت .
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



                        <form class="form-horizontal" method="POST" action="{{ route('teacher.exams.edit.save') }}">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{$exam->id}}">
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title">عنوان
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="title" id="title"
                                               class="form-control  @error('title') is-invalid @enderror" value="{{$exam->title}}" required/>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                  <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label"
                                           for="description">توضیحات :</label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="description" id="description"
                                         value="{{$exam->description}}"
                                               class="form-control  @error('description') is-invalid @enderror" />
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
                                    <label class="col-md-12 col-sm-12 control-label" for="start_exam">تاریخ و ساعت شروع آزمون
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input  name="start_exam" id="start-exam-show"
                                               class=" persian-datepicker-time form-control  @error('start_exam') is-invalid @enderror" required/>
                                        @error('start_exam')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-12 control-label"
                                           for="end_exam">تاریخ و ساعت پایان آزمون  : <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input  name="end_exam" id="end-exam-show"
                                               class="persian-datepicker-time form-control  @error('end_exam') is-invalid @enderror" required/>
                                        @error('end_exam')
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


