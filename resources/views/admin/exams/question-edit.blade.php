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
                       جهت ویرایش سوال اطلاعات را بادقت وارد نمایید
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



                        <form class="form-horizontal" method="POST" action="{{ route('admin.exams.questions.edit.save') }}">
                            @csrf
                            <input type="hidden" name="exams_id" value="{{$exam->id}}">
                            <input type="hidden" name="exams_questions_id" value="{{$examsQuestion->id}}">
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label>نوع سوال را انتخاب نمایید :</label>
                                    <div class="multiselect_div">
                                        <select id="question-type-select" name="type" class="multiselect multiselect-custom form-control " >
                                            <option value="adj" @if($examsQuestion->type=="adj") selected @endif>تشریحی</option>
                                            <option value="test" @if($examsQuestion->type=="test") selected @endif>تستی</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label>{{__('admin/public.status')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="status" class="multiselect multiselect-custom form-control " >
                                            <option value="1">{{__('web/public.active')}}</option>
                                            <option value="0" {{$examsQuestion->status?"selected":""}}>{{__('web/public.inactive')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title">عنوان
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <textarea name="title" rows="10" id="input-enquiry" class="form-control  @error('title') is-invalid @enderror">{{$examsQuestion->title}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title">نمره
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="number" step="0.001"  name="mark" id="mark" value="{{$examsQuestion->mark}}"
                                               class="form-control  @error('mark') is-invalid @enderror" required/>
                                        @error('mark')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row question-type-adj-div">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title">پاسخ
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <textarea name="response" rows="10" id="input-enquiry" class="form-control  @error('response') is-invalid @enderror">{{$examsQuestion->response}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row question-type-test-div">
                                <div class="col-md-6 padding-top-15">
                                    <label>تعداد گزینه های سوال را انتخاب نمایید :</label>
                                    <div class="multiselect_div">
                                        <select id="type-adj-number-select" name="type_adj_number" class="multiselect multiselect-custom form-control " >
                                            <option value="4" @if(count($examsQuestionsOptions)==4) selected @endif>چهار گزینه ای</option>
                                            <option value="3" @if(count($examsQuestionsOptions)==3) selected @endif >سه گزینه ای</option>
                                            <option value="2" @if(count($examsQuestionsOptions)==2) selected @endif>دو گزینه ای</option>
                                            <option value="5" @if(count($examsQuestionsOptions)==5) selected @endif>پنج گزینه ای</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row question-type-test-div question-type-test-q-div question-type-test-q-div-1 question-type-test-q-div-2 question-type-test-q-div-3  question-type-test-q-div-4 question-type-test-q-div-5">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title"> گزینه اول
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="titleTest[]" id="title" @if(count($examsQuestionsOptions)>0) value="{{$examsQuestionsOptions[0]->title}}" @endif
                                               class="form-control  @error('title') is-invalid @enderror"/>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-12 control-label" for="title">پاسخ صحیح را انتخاب نمایید
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <label class="radio-inline">
                                            <input type="radio" name="test_response" value="1"  @if($examsQuestion->response==1) checked @endif>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row question-type-test-div question-type-test-q-div question-type-test-q-div-2 question-type-test-q-div-3  question-type-test-q-div-4 question-type-test-q-div-5">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title"> گزینه دوم
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="titleTest[]" id="title" @if(count($examsQuestionsOptions)>1) value="{{$examsQuestionsOptions[1]->title}}" @endif
                                               class="form-control  @error('title') is-invalid @enderror"/>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title"><br></label>
                                    <div class="col-md-12 col-sm-10">
                                        <label class="radio-inline">
                                            <input type="radio" name="test_response" value="2"  @if($examsQuestion->response==2) checked @endif>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row question-type-test-div question-type-test-q-div  question-type-test-q-div-3  question-type-test-q-div-4 question-type-test-q-div-5">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title"> گزینه سوم
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="titleTest[]" id="title" @if(count($examsQuestionsOptions)>2) value="{{$examsQuestionsOptions[2]->title}}" @endif
                                               class="form-control  @error('title') is-invalid @enderror"/>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title"><br></label>
                                    <div class="col-md-12 col-sm-10">
                                        <label class="radio-inline">
                                            <input type="radio" name="test_response" value="3"  @if($examsQuestion->response==3) checked @endif>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row question-type-test-div question-type-test-q-div question-type-test-q-div-4 question-type-test-q-div-5">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title"> گزینه چهارم
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="titleTest[]" id="title" @if(count($examsQuestionsOptions)>3) value="{{$examsQuestionsOptions[3]->title}}" @endif
                                               class="form-control  @error('title') is-invalid @enderror"/>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title"><br></label>
                                    <div class="col-md-12 col-sm-10">
                                        <label class="radio-inline">
                                            <input type="radio" name="test_response" value="4"  @if($examsQuestion->response==4) checked @endif>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row question-type-test-div question-type-test-q-div question-type-test-q-div-5">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title"> گزینه پنجم
                                        : <span class="required">*</span></label>
                                    <div class="col-md-12 col-sm-10">
                                        <input type="text" name="titleTest[]" id="title" @if(count($examsQuestionsOptions)>4) value="{{$examsQuestionsOptions[4]->title}}" @endif
                                               class="form-control  @error('title') is-invalid @enderror"/>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-6 col-sm-6 control-label" for="title"><br></label>
                                    <div class="col-md-12 col-sm-10">
                                        <label class="radio-inline">
                                            <input type="radio" name="test_response" value="5" @if($examsQuestion->response==5) checked @endif  >
                                        </label>
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


