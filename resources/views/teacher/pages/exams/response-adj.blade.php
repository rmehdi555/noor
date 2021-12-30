@extends('teacher.master')
@section('content')


    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary m-1">

                        بسم الله النور
                        <br>
                        قرآن آموز گرامی،  آزمون {{$exam->title}}  در حال برگزاری می باشد .
                        <br>
                        قابل توجه است که زمان اتمام آزمون :
                        {{\App\Providers\MyProvider::show_date($exam->end_exam,'Y/m/d')}}
                        رأس ساعت
                        {{\App\Providers\MyProvider::show_date($exam->end_exam,'H:i')}}
                        می باشد و لازم است که قبل از زمان یاد شده به سؤالات پاسخ داده و بر روی گزینه ثبت کلیک نمایید، در غیر این صورت پاسخ آزمون برای شما ثبت نشده و نمره شما 0 تلقی می گردد.
                        <br>
                        لازم به ذکر است که  بعد از پاسخ و کلیک بر روی گزینه ثبت ، پاسخ ها در سیستم ثبت نهایی شده و قابل ویرایش نمی باشند، بنابراین لطفا با دقت به سوالات پاسخ دهید.


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
                   لطفا با دقت به سوالات پاسخ نمایید . لازم به ذکر میباشد بعد از پاسخ و کلیک به روی دکمه ثبت ، پاسخ ها در سیستم ثبت نهایی شده و قابل ویرایش نمی باشند .
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
                                                   value="ثبت">
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


