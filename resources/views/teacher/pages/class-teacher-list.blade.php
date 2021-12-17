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


                        <br>
                        @if(count($classes)>0)
                            <p class="bu-margin-bottom-30">لیست کلاس ها ی معلم القرآن : </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان رشته (اصلی)</th>
                                        <th>عنوان رشته (فرعی)</th>
                                        <th>نام</th>
                                        <th>وضعیت کلاس</th>
                                        <th>نمره نهایی</th>
                                        <th>تاریخ شروع آزمون</th>
                                        <th>تاریخ پایان آزمون</th>
                                        <th>عنوان آزمون</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1@endphp
                                    @foreach($classes as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->classRooms->fieldParentId->title}}</td>
                                            <td>{{$item->classRooms->fieldId->title}}</td>
                                            <td>{{$item->classRooms->name}}</td>

                                            @switch($item->classRooms->status)
                                                @case(1)
                                                <td>ایجاد شده</td>
                                                <th>نمره نهایی ثبت نشده</th>
                                                @break

                                                @case(2)
                                                <td>درحال برگزاری</td>
                                                <th>نمره نهایی ثبت نشده</th>
                                                @break

                                                @case(4)
                                                <td>آزمون</td>
                                                <th>نمره نهایی ثبت نشده</th>
                                                @break

                                                @case(5)
                                                <td>اتمام شده</td>
                                                <th>{{$item->mark}}</th>
                                                @break

                                                @default
                                                <td>نامشخص میباشد به ادمین سایت اطلاع داده شود</td>
                                            @endswitch
                                            @if(isset($item->classRooms->exam))
                                                <th>{{\App\Providers\MyProvider::show_date($item->classRooms->exam->start_exam,'H:i Y/m/d')}}</th>
                                                <th>{{\App\Providers\MyProvider::show_date($item->classRooms->exam->end_exam,'H:i Y/m/d')}}</th>
                                                <th>{{$item->classRooms->exam->title}}</th>

                                                <td><a href="{{ route('teacher.exams.response',$item->id) }}" class="btn btn-info">شرکت در آزمون</a></td>
                                            @else
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>

                                            @endif



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


