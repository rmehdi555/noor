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
                       مشاهده پاسخ ها و نمرات
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

                        <form class="form-horizontal" method="POST" action="{{ route('admin.exams.show.result.save') }}">
                            @csrf
                            <input type="hidden" name="exams_id" value="{{$exam->id}}">
                            <input type="hidden" name="class_rooms_teachers_id" value="{{$classRoomsTeachers->id}}">
                            @if(count($exam->examsQuestions()->get())<=0)
                                <section class="bu-inner-main">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-primary m-1">
                                                    آزمون هیچ سوالی نداره
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </section>
                            @elseif(count($examsResponseTeachers)<=0)
                                <section class="bu-inner-main">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-primary m-1">
                                                    شرکت کننده در آزمون شرکت نکرده و به هیچ سوالی پاسخ نداده است .
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </section>
                            @else
                                @foreach($exam->examsQuestions()->get() as $examsQuestion)
                                    @if($examsQuestion->type=="test")
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 padding-top-15">
                                                <label class="col-md-6 col-sm-6 control-label" for="title">عنوان
                                                    : {{$examsQuestion->title}} ? ({{$examsQuestion->mark}}) نمره</label>
                                            </div>
                                        </div>
                                    @php $i=1;@endphp

                                        @foreach($examsQuestion->examsQuestionsOptions()->get() as $examsQuestionsOption)

                                            <div class="row">
                                                <div class="col-md-12 padding-top-15">
                                                    <label class="col-md-6 col-sm-6 control-label" for="title">{{$i}}-
                                                        : {{$examsQuestionsOption->title}}</label>

                                                </div>
                                            </div>
                                            @php $i++;@endphp
                                        @endforeach
                                        <div class="row">
                                            <div class="col-md-6 padding-top-15">
                                                <label class="col-md-6 col-sm-6 control-label" for="title">پاسخ صحیح
                                                    : {{$examsQuestion->response}} </label>
                                            </div>
                                            @if(isset($examsResponseTeachersArray[$examsQuestion->id]) and !empty($examsResponseTeachersArray[$examsQuestion->id]))
                                                <div class="col-md-6 padding-top-15">
                                                    <label class="col-md-6 col-sm-6 control-label" for="title">پاسخ شرکت کننده :  {{$examsResponseTeachersArray[$examsQuestion->id]->response}} </label>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 padding-top-15">
                                                <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی که در سیستم ثبت میشود
                                                    : <span class="required">*</span></label>
                                                <div class="col-md-12 col-sm-10">
                                                    <input type="hidden" name="flag_mark[]" value="{{$examsResponseTeachersArray[$examsQuestion->id]->id}}">
                                                    <input type="number" step="0.001" name="mark_{{$examsResponseTeachersArray[$examsQuestion->id]->id}}"
                                                           class="form-control " value="{{empty($examsResponseTeachersArray[$examsQuestion->id]->mark)?$examsResponseTeachersArray[$examsQuestion->id]->t_mark:$examsResponseTeachersArray[$examsQuestion->id]->mark}}" required/>
                                                </div>
                                            </div>

                                        </div>
                                                @else
                                                <div class="col-md-6 padding-top-15">
                                                    <label class="col-md-6 col-sm-6 control-label" for="title">پاسخی از سمت شرکت کننده ثبت نشده </label>
                                                </div>
                                        </div>
                                            @endif



                                        @endif
                                @endforeach




                                @foreach($exam->examsQuestions()->get() as $examsQuestion)
                                    @if($examsQuestion->type=="adj")
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 padding-top-15">
                                                    <label class="col-md-6 col-sm-6 control-label" for="title">عنوان
                                                        : {{$examsQuestion->title}} ? ({{$examsQuestion->mark}}) نمره</label>
                                                </div>
                                            </div>
                                            <div class="row question-type-adj-div">
                                                <div class="col-md-12 padding-top-15">
                                                    <label class="col-md-6 col-sm-6 control-label" for="title">پاسخ صحیح
                                                        : {{$examsQuestion->response}}</label>
                                                </div>
                                                @if(isset($examsResponseTeachersArray[$examsQuestion->id]) and !empty($examsResponseTeachersArray[$examsQuestion->id]))
                                                    <div class="col-md-6 padding-top-15">
                                                        <label class="col-md-6 col-sm-6 control-label" for="title">پاسخ شرکت کننده :  {{$examsResponseTeachersArray[$examsQuestion->id]->response}} </label>
                                                    </div>
                                                        </div>
                                                    <div class="row">
                                                        <div class="col-md-6 padding-top-15">
                                                            <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی که در سیستم ثبت میشود
                                                                : <span class="required">*</span></label>
                                                            <div class="col-md-12 col-sm-10">
                                                                <input type="hidden" name="flag_mark[]" value="{{$examsResponseTeachersArray[$examsQuestion->id]->id}}">
                                                                <input type="number" step="0.001" name="mark_{{$examsResponseTeachersArray[$examsQuestion->id]->id}}"
                                                                       class="form-control " value="{{empty($examsResponseTeachersArray[$examsQuestion->id]->mark)?$examsResponseTeachersArray[$examsQuestion->id]->t_mark:$examsResponseTeachersArray[$examsQuestion->id]->mark}}" required/>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @else
                                                    <div class="col-md-6 padding-top-15">
                                                        <label class="col-md-6 col-sm-6 control-label" for="title">پاسخی از سمت شرکت کننده ثبت نشده </label>
                                                    </div>
                                        </div>
                                        @endif



                                    @endif
                                @endforeach
                            @endif





                <hr>
                <div class="row">
                    <div class="col-md-12 padding-top-15">
                     <p>نمرات نهایی آزمون :</p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی تئوری آزمون</label>
                        <div class="col-md-12 col-sm-10">
                            <input type="number" step="0.001" name="t_mark"
                                   class="form-control " value="{{$classRoomsTeachers->t_mark}}" />
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی عملی آزمون</label>
                        <div class="col-md-12 col-sm-10">
                            <input type="number" step="0.001" name="a_mark"
                                   class="form-control " value="{{$classRoomsTeachers->a_mark}}" />
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی مجموع آزمون</label>
                        <div class="col-md-12 col-sm-10">
                            <input type="number" step="0.001" name="mark"
                                   class="form-control " value="{{$classRoomsTeachers->mark}}" />
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


