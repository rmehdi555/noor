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
                                            <td>{{$item->classRoms->fieldParentId->title}}</td>
                                            <td>{{$item->classRoms->fieldId->title}}</td>
                                            <td>{{$item->classRoms->name}}</td>

                                            @switch($item->classRoms->status)
                                                @case(1)
                                                <td>ایجاد شده</td>
                                                @break

                                                @case(2)
                                                <td>درحال برگذاری</td>
                                                @break

                                                @case(3)
                                                <td>آزمون</td>
                                                @break

                                                @case(5)
                                                <td>اتمام شده</td>
                                                @break

                                                @default
                                                <td>نامشخص میباشد به ادمین سایت اطلاع داده شود</td>
                                            @endswitch
                                            @if(isset($item->classRoms->exam))
                                                <th>{{\App\Providers\MyProvider::show_date($item->classRoms->exam->start_exam,'%B %d، %Y  H:i')}}</th>
                                                <th>{{\App\Providers\MyProvider::show_date($item->classRoms->exam->ثدی_exam,'%B %d، %Y  H:i')}}</th>
                                                <th>{{$item->classRoms->exam->title}}</th>
                                                @if($item->classRoms->exam->start_exam<now() and $item->classRoms->exam->end_exam>now() )
                                                    <td>درحال آزمون</td>
                                                    @else
                                                    <td>111</td>
                                                    @endif
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


