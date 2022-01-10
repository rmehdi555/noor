@extends('student.master')
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
                        @if(count($studentFields)>0)
                            <p class="bu-margin-bottom-30">لیست کلاس ها ی ثبت نام شده  : </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('web/public.title_field')}}</th>
                                        <th>تاریخ ثبت نام</th>
                                        <th>وضعیت کلاس</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1@endphp
                                    @foreach($studentFields as $item)
                                        @if($item->status==1 or $item->status==2)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'H:i Y/m/d')}}</td>
                                            @switch($item->status)
                                                @case(1)
                                                <td>ثبت نام اولیه و پرداخت نشده</td>
                                                @break

                                                @case(2)
                                                <td>پرداخت شده و درانتظار تشکیل کلاس</td>
                                                @break

                                                @case(3)
                                                <td>در حال تحصیل</td>
                                                @break

                                                @case(5)
                                                <td>اتمام دوره</td>
                                                @break

                                                @default
                                                <td>نامشخص میباشد به ادمین سایت اطلاع داده شود</td>
                                            @endswitch
                                        </tr>
                                        @php $i++ @endphp
                                        @endif
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
                                                    کلاسی ثبت نامی که تشکیل نشده باشد ، ندارید .
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </section>
                        @endif



                            <br>
                            @if(count($classes)>0)
                                <p class="bu-margin-bottom-30">لیست کلاس ها ی تشکیل شده : </p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان رشته (اصلی)</th>
                                            <th>عنوان رشته (فرعی)</th>
                                            <th>نام</th>
                                            <th>توضیحات</th>
                                            <th>وضعیت کلاس</th>
                                            <th>نمره تئوری</th>
                                            <th>نمره عملی</th>
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
                                                <td>{{($item->field_parent_id==0)?$item->classRooms->fieldId->title:$item->classRooms->fieldParentId->title}}</td>
                                                <td>{{$item->classRooms->fieldId->title}}</td>
                                                <td>{{$item->classRooms->name}}</td>
                                                <td>{{$item->classRooms->description}}</td>


                                            @switch($item->classRooms->status)
                                                    @case(1)
                                                    <td>ایجاد شده</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <th>نمره نهایی ثبت نشده</th>
                                                    @break

                                                    @case(2)
                                                    <td>درحال برگزاری</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <th>نمره نهایی ثبت نشده</th>
                                                    @break

                                                    @case(4)
                                                    <td>آزمون</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <th>نمره نهایی ثبت نشده</th>
                                                    @break

                                                    @case(5)
                                                    <td>اتمام شده</td>
                                                    @if($item->classRooms->mark_type=='grade')
                                                        <td style="min-width: 100px">
                                                            <select id="question-type-select" name="t_mark" class="multiselect multiselect-custom form-control " disabled>
                                                                @foreach($item->classRooms->markType->markTypeGrade()->get() as $itemGrade)
                                                                    <option value="{{$itemGrade->min_mark}}" @if($itemGrade->min_mark<=$item->t_mark and $itemGrade->max_mark>=$item->t_mark) selected @endif>{{$itemGrade->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td style="min-width: 100px">
                                                            <select id="question-type-select" name="a_mark" class="multiselect multiselect-custom form-control " disabled>
                                                                @foreach($item->classRooms->markType->markTypeGrade()->get() as $itemGrade)
                                                                    <option value="{{$itemGrade->min_mark}}" @if($itemGrade->min_mark<=$item->a_mark and $itemGrade->max_mark>=$item->a_mark) selected @endif>{{$itemGrade->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td style="min-width: 100px">
                                                            <select id="question-type-select" name=mark" class="multiselect multiselect-custom form-control " disabled>
                                                                @foreach($item->classRooms->markType->markTypeGrade()->get() as $itemGrade)
                                                                    <option value="{{$itemGrade->min_mark}}" @if($itemGrade->min_mark<=$item->mark and $itemGrade->max_mark>=$item->mark) selected @endif>{{$itemGrade->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    @else
                                                        <td>{{$item->t_mark}}</td>
                                                        <td>{{$item->a_mark}}</td>
                                                        <td>{{$item->mark}}</td>
                                                    @endif
                                                    @break

                                                    @default
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>نامشخص میباشد به ادمین سایت اطلاع داده شود</td>
                                                @endswitch
                                                @if(isset($item->classRooms->exam) and $item->classRooms->status!=5)
                                                    <th>{{\App\Providers\MyProvider::show_date($item->classRooms->exam->start_exam,'H:i Y/m/d')}}</th>
                                                    <th>{{\App\Providers\MyProvider::show_date($item->classRooms->exam->end_exam,'H:i Y/m/d')}}</th>
                                                    <th>{{$item->classRooms->exam->title}}</th>
                                                    <td><a href="{{ route('student.exams.response',$item->id) }}" class="btn btn-info">شرکت در آزمون</a></td>
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


