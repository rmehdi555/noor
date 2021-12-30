@extends('teacher.master')
@section('content')


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


    @if(isset($exam->description) AND !empty($exam->description))
        <section class="bu-inner-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-primary m-1">
                            توضیحات آزمون :
                            {{$exam->description}}
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @endif




    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bu-inner-main-form">

                        <form class="form-horizontal" method="POST" action="{{ route('teacher.exams.show.result.save') }}">
                            @csrf
                            <input type="hidden" name="exams_id" value="{{$exam->id}}">
                            <input type="hidden" name="class_rooms_students_id" value="{{$classRoomsStudents->id}}">
                            <input type="hidden" name="user_type" value="student">
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
                            @elseif(count($examsResponseStudents)<=0)
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
                                @php $number_q=1;@endphp
                                @foreach($exam->examsQuestions()->get() as $examsQuestion)
                                    @if($examsQuestion->type=="test" and $examsQuestion->status!=0)
                                        <hr>
                                        <div class="row">                                            
                                                <label class="col-md-12 col-sm-12 control-label" for="title">{{$number_q}} -
                                                    عنوان

                                                    : {{$examsQuestion->title}} ? ({{$examsQuestion->mark}}) نمره</label>                                            
                                        </div>
                                        @php $i=1;@endphp

                                        @foreach($examsQuestion->examsQuestionsOptions()->get() as $examsQuestionsOption)

                                            <div class="row">                                               
                                                    <label class="col-md-12 col-sm-12 control-label" for="title">{{$i}}-
                                                        : {{$examsQuestionsOption->title}}</label>
                                                
                                            </div>
                                            @php $i++;@endphp
                                        @endforeach
                                        <div class="row">                                          
                                                <label class="col-md-12 col-sm-12 control-label" for="title">پاسخ صحیح
                                                    : {{$examsQuestion->response}} </label>
                                            </div>
                                            @if(isset($examsResponseStudentsArray[$examsQuestion->id]) and !empty($examsResponseStudentsArray[$examsQuestion->id]))
                                            <div class="row">                                           
                                                    <label class="col-md-12 col-sm-12 control-label" for="title">پاسخ شرکت کننده :  {{$examsResponseStudentsArray[$examsQuestion->id]->response}} </label>
                                                
                                            </div>
                                        <div class="row">
                                            <div class="col-md-6 padding-top-15">
                                                <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی که در سیستم ثبت میشود
                                                    : <span class="required">*</span></label>
                                                <div class="col-md-12 col-sm-10">
                                                    <input type="hidden" name="flag_mark[]" value="{{$examsResponseStudentsArray[$examsQuestion->id]->id}}">
                                                    <input type="number" step="0.001" name="mark_{{$examsResponseStudentsArray[$examsQuestion->id]->id}}"
                                                           class="form-control exam-mark exam-mark-test" value="{{empty($examsResponseStudentsArray[$examsQuestion->id]->mark)?$examsResponseStudentsArray[$examsQuestion->id]->t_mark:$examsResponseStudentsArray[$examsQuestion->id]->mark}}" required/>
                                                </div>
                                            </div>

                                        </div>
                                    @else
                                        <div class="row">
                                            <label class="col-md-6 col-sm-6 control-label" for="title">پاسخی از سمت شرکت کننده ثبت نشده </label>
                                        </div>
               
                    @endif


                    @php $number_q++;@endphp
                    @endif

                    @endforeach





                    @foreach($exam->examsQuestions()->get() as $examsQuestion)
                        @if($examsQuestion->type=="adj" and $examsQuestion->status!=0)
                            <hr>
                            <div class="row">
                                <label class="col-md-12 col-sm-12 control-label" for="title">{{$number_q}} -
                                    عنوان
                                    : {{$examsQuestion->title}} ? ({{$examsQuestion->mark}}) نمره</label>

                            </div>
                            <div class="row question-type-adj-div">
                                <label class="col-md-12 col-sm-12 control-label" for="title">پاسخ صحیح
                                    : {{$examsQuestion->response}}</label>
                            </div>

                            @if(isset($examsResponseStudentsArray[$examsQuestion->id]) and !empty($examsResponseStudentsArray[$examsQuestion->id]))
                                <div class="row">
                                    <label class="col-md-12 col-sm-12 control-label" for="title">پاسخ شرکت کننده :  {{$examsResponseStudentsArray[$examsQuestion->id]->response}} </label>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی که در سیستم ثبت میشود
                                            : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="hidden" name="flag_mark[]" value="{{$examsResponseStudentsArray[$examsQuestion->id]->id}}">
                                            <input type="number" step="0.001" name="mark_{{$examsResponseStudentsArray[$examsQuestion->id]->id}}"
                                                   class="form-control exam-mark exam-mark-adj" value="{{empty($examsResponseStudentsArray[$examsQuestion->id]->mark)?$examsResponseStudentsArray[$examsQuestion->id]->t_mark:$examsResponseStudentsArray[$examsQuestion->id]->mark}}" required/>
                                        </div>
                                    </div>

                                </div>
                            @else
                                <div class="row">
                                    <label class="col-md-12 col-sm-12 control-label" for="title">پاسخی از سمت شرکت کننده ثبت نشده </label>
                                </div>
                @endif


                @php $number_q++;@endphp
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
                            <input type="number" step="0.001" name="t_mark" id="exam-t-mark"
                                   class="form-control " value="{{$classRoomsStudents->t_mark}}" />
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی عملی آزمون</label>
                        <div class="col-md-12 col-sm-10">
                            <input type="number" step="0.001" name="a_mark" id="exam-a-mark"
                                   class="form-control " value="{{$classRoomsStudents->a_mark}}" />
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی مجموع آزمون</label>
                        <div class="col-md-12 col-sm-10">
                            <input type="number" step="0.001" name="mark" id="exam-all-mark"
                                   class="form-control " value="{{$classRoomsStudents->mark}}" />
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


