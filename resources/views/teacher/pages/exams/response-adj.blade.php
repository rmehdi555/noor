@extends('teacher.master')
@section('content')


    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary m-1">
                      آزمون
                        {{$exam->title}}
                        در حال برگزاری میباشد .
                        <br>
                        زمان اتمام آزمون :
                        {{\App\Providers\MyProvider::show_date($exam->end_exam,'%B %d، %Y  H:i')}}
                        میباشد که حتما قبل آن باید پاسخ ها را ارسال نمایید درغیر اینصورت پاسخ آزمون برای شما ثبت نخواهد شد .
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
                   لطفا با دقت به سوالات تستی پاسخ نمایید . لازم به ذکر میباشد بعد از پاسخ و کلیک به روی دکمه ثبت ، پاسخ ها در سیستم ثبت نهایی شده و قابل ویرایش نمی باشند .
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



                        <form class="form-horizontal" method="POST" action="{{ route('teacher.exams.response.adj.save') }}">



                            @csrf
                            <input type="hidden" name="exams_id" value="{{$exam->id}}">
                            <input type="hidden" name="class_rooms_teachers" value="{{$classRoomsTeachers->id}}">
                            @php $i=1;@endphp
                            @foreach($examsQuestionsAdj as $examsQuestion)
                                <div class="row">
                                    <div class="col-md-12 padding-top-15">
                                        <label>{{$i}} - {{$examsQuestion->title}} ? ({{$examsQuestion->mark}} نمره)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 padding-top-15">
                                        <label>پاسخ سوال : {{$i}}</label>
                                        <textarea rows="2" class="form-control" name="adj_response_{{$examsQuestion->id}}"></textarea>
                                    </div>
                                </div>
                                @php $i++;@endphp
                            @endforeach



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


