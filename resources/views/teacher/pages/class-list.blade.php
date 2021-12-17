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
                            <p class="bu-margin-bottom-30">لیست کلاس ها : </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان رشته (اصلی)</th>
                                        <th>عنوان رشته (فرعی)</th>
                                        <th>نام</th>
                                        <th>توضیح</th>
                                        {{--<th>آدرس</th>--}}
                                        {{--<th>تاریخ ایجاد</th>--}}
                                        <th>وضعیت کلاس</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1@endphp
                                    @foreach($classes as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->fieldParentId->title}}</td>
                                            <td>{{$item->fieldId->title}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->description}}</td>
                                            {{--<td>{{$item->address}}</td>--}}
                                            {{--<td>{{\App\Providers\MyProvider::show_date($item->created_at,'H:i Y/m/d')}}</td>--}}
                                            @switch($item->status)
                                                @case(1)
                                                <td>ایجاد شده</td>
                                                <td><a href="{{ route('teacher.class.show',$item->id) }}" class="btn btn-info">قرآن آموز ها</a>
                                                    <a href="{{ route('teacher.class.edit',$item->id) }}" class="btn btn-info">ویرایش </a></td>
                                                @break

                                                @case(2)
                                                <td>درحال برگزاری</td>
                                                <td><a href="{{ route('teacher.class.show',$item->id) }}" class="btn btn-info">قرآن آموز ها</a>
                                                    <a href="{{ route('teacher.class.edit',$item->id) }}" class="btn btn-info">ویرایش </a></td>
                                                @break

                                                @case(4)
                                                <td>آزمون</td>
                                                <td><a href="{{ route('teacher.class.show',$item->id) }}" class="btn btn-info">قرآن آموز ها</a>
                                                    <a href="{{ route('teacher.class.edit',$item->id) }}" class="btn btn-info">ویرایش </a></td>
                                                @break

                                                @case(5)
                                                <td>اتمام شده</td>
                                                <td></td>
                                                @break

                                                @default
                                                <td>نامشخص میباشد به ادمین سایت اطلاع داده شود</td>
                                                <td></td>
                                            @endswitch



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


