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




    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bu-inner-main-form">

                        <form class="form-horizontal" method="POST" action="{{ route('teacher.exams.show.result.save') }}">
                            @csrf
                            <input type="hidden" name="exams_id" value="{{$exam->id}}">
                            <input type="hidden" name="class_rooms_teachers_id" value="{{$classRoomsTeachers->id}}">
                            <input type="hidden" name="user_type" value="teacher">
                            @if(count($exam->examsQuestions()->get())<=0)
                                <section class="bu-inner-main">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-primary m-1">
                                                    آزمون هیچ سوالی ندارد
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
                                            @if(isset($examsResponseTeachersArray[$examsQuestion->id]) and !empty($examsResponseTeachersArray[$examsQuestion->id]))
                                                <div class="row">
                                                    <label class="col-md-12 col-sm-12 control-label" for="title">پاسخ شرکت کننده :  {{$examsResponseTeachersArray[$examsQuestion->id]->response}} </label>
                                                </div>
                                        <div class="row">
                                            <div class="col-md-6 padding-top-15">
                                                <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی که در سیستم ثبت میشود
                                                    : <span class="required">*</span></label>
                                                <div class="col-md-12 col-sm-10">
                                                    <input type="hidden" name="flag_mark[]" value="{{$examsResponseTeachersArray[$examsQuestion->id]->id}}">
                                                    <input type="number" step="0.001" name="mark_{{$examsResponseTeachersArray[$examsQuestion->id]->id}}"
                                                           class="form-control exam-mark exam-mark-test" value="{{empty($examsResponseTeachersArray[$examsQuestion->id]->mark)?$examsResponseTeachersArray[$examsQuestion->id]->t_mark:$examsResponseTeachersArray[$examsQuestion->id]->mark}}" required/>
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
                            @if(isset($examsResponseTeachersArray[$examsQuestion->id]) and !empty($examsResponseTeachersArray[$examsQuestion->id]))
                                <div class="row">
                                    <label class="col-md-12 col-sm-12 control-label" for="title">پاسخ شرکت کننده :  {{$examsResponseTeachersArray[$examsQuestion->id]->response}} </label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی که در سیستم ثبت میشود
                                            : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input type="hidden" name="flag_mark[]" value="{{$examsResponseTeachersArray[$examsQuestion->id]->id}}">
                                            <input type="number" step="0.001" name="mark_{{$examsResponseTeachersArray[$examsQuestion->id]->id}}"
                                                   class="form-control exam-mark exam-mark-adj" value="{{empty($examsResponseTeachersArray[$examsQuestion->id]->mark)?$examsResponseTeachersArray[$examsQuestion->id]->t_mark:$examsResponseTeachersArray[$examsQuestion->id]->mark}}" required/>
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

                                            @if($classRooms->mark_type=='grade')
                                                <div class="row">
                                                    <div class="col-md-6 padding-top-15">
                                                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی تئوری آزمون</label>
                                                        <div class="col-md-12 col-sm-10">
                                                            <select id="question-type-select" name="t_mark" class="multiselect multiselect-custom form-control " >
                                                                @foreach($classRooms->markType->markTypeGrade()->get() as $item)
                                                                    <option value="{{$item->min_mark}}" @if($item->min_mark<=$classRoomsTeachers->t_mark and $item->max_mark>=$classRoomsTeachers->t_mark) selected @endif>{{$item->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 padding-top-15">
                                                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی عملی آزمون</label>
                                                        <select id="question-type-select" name="a_mark" class="multiselect multiselect-custom form-control " >
                                                            @foreach($classRooms->markType->markTypeGrade()->get() as $item)
                                                                <option value="{{$item->min_mark}}" @if($item->min_mark<=$classRoomsTeachers->a_mark and $item->max_mark>=$classRoomsTeachers->a_mark) selected @endif>{{$item->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 padding-top-15">
                                                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی مجموع آزمون</label>
                                                        <select id="question-type-select" name="mark" class="multiselect multiselect-custom form-control " >
                                                            @foreach($classRooms->markType->markTypeGrade()->get() as $item)
                                                                <option value="{{$item->min_mark}}" @if($item->min_mark<=$classRoomsTeachers->mark and $item->max_mark>=$classRoomsTeachers->mark) selected @endif>{{$item->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            @else

                <div class="row">
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی تئوری آزمون</label>
                        <div class="col-md-12 col-sm-10">
                            <input type="number" step="0.001" name="t_mark" id="exam-t-mark"
                                   class="form-control " value="{{$classRoomsTeachers->t_mark}}" />
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی عملی آزمون</label>
                        <div class="col-md-12 col-sm-10">
                            <input type="number" step="0.001" name="a_mark" id="exam-a-mark"
                                   class="form-control " value="{{$classRoomsTeachers->a_mark}}" />
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label" for="title">نمره نهایی مجموع آزمون</label>
                        <div class="col-md-12 col-sm-10">
                            <input type="number" step="0.001" name="mark" id="exam-all-mark"
                                   class="form-control " value="{{$classRoomsTeachers->mark}}" />
                        </div>
                    </div>

                </div>
                                            @endif



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


