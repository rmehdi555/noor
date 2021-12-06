@extends('teacher.master')
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
                            <section class="bu-inner-main">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-primary m-1">
                                                دقت داشته باشین مجموع نمرات سوال ها ی فعال هر آزمون باید 100 باشد .
                                                <br>
                                                تنها سوالات فعال درنظر گرفته میشوند و سوالات غیر فعال ممعادل حذف شده هستند .
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>


                            <a class="btn btn-info" href="{{ route('teacher.exams.questions.create',$exam->id) }}">اضافه کردن سوال جدید</a>

                            <br>
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-12 control-label">عنوان آزمون : </label>
                                    <label class="col-md-12 col-sm-12 control-label">{{$exam->title}} </label>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-12 control-label">مجموع نمرات : </label>
                                    <label class="col-md-12 col-sm-12 control-label">{{$examSumMark}} </label>
                                </div>
                            </div>

                            {{--<div class="row">--}}
                                {{--<div class="col-md-6 padding-top-15">--}}
                                    {{--<label class="col-md-12 col-sm-12 control-label" >تاریخ و ساعت شروع آزمون--}}
                                        {{--: </label>--}}
                                    {{--<label class="col-md-12 col-sm-12 control-label">{{$exam->start_exam}} </label>--}}
                                  {{----}}
                                {{--</div>--}}
                                {{--<div class="col-md-6 padding-top-15">--}}
                                    {{--<label class="col-md-12 col-sm-12 control-label"--}}
                                          {{-->تاریخ و ساعت پایان آزمون  : </label>--}}
                                    {{--<label class="col-md-12 col-sm-12 control-label">{{$exam->end__exam}} </label>--}}
                                {{--</div>--}}
                                  {{----}}
                            {{--</div>--}}
                            <hr>

                        @if(count($examQuestions)>0)
                            <p class="bu-margin-bottom-30">لیست سوال ها : </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان</th>
                                        <th>نوع سوال</th>
                                        <th>پاسخ</th>
                                        <th>نمره</th>
                                        <th>وضعیت</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1@endphp
                                    @foreach($examQuestions as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td><span>{{$item->title}}</span></td>
                                            @switch($item->type)
                                                @case('test')
                                                <td>تستی</td>
                                                @break
                                                @case('adj')
                                                <td>تشریحی</td>
                                                @break
                                                @default
                                                <td>نامشخص میباشد به ادمین سایت اطلاع داده شود</td>
                                            @endswitch
                                            <td><span>{{$item->response}}</span></td>
                                            <td>{{$item->mark}}</td>
                                            <td>{{$item->status?__('web/public.active'):__('web/public.inactive')}}</td>
                                            <td><a class="btn btn-info" href="{{ route('teacher.exams.questions.edit',$item->id) }}">ویرایش سوال</a></td>
                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <!-- Start: Inner main -->
                                <section class="bu-inner-main">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-primary m-1">
                                                    هیچ رکوردی وجود ندارد
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </section>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


