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

                            @if(count($classActive)>0)
                                <a class="btn btn-info" href="{{ route('student.practice.add') }}">ثبت فعالیت جدید</a>
                                @else
                                <h4>برای ثبت فعالیت نیاز هست که کلاس توسط معلم برگذار شود، شما هیچ کلاس فعالی در حال حاظر ندارید .</h4>
                            @endif
                        <br>
                            <br>
                            <hr>
                        @if(count($practices)>0)
                            <p class="bu-margin-bottom-30">لیست فعالیت های ثبت شده : </p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تاریخ</th>
                                        <th>عنوان</th>
                                        <th>وضعیت</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1@endphp
                                    @foreach($practices as $item)
                                        @php
                                            if($item->updated_at!=null)
                                            $item->created_at=$item->updated_at;
                                        @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'H:i Y/m/d')}}</td>
                                            <td>{{$item->title}}</td>
                                            @switch($item->status)
                                                @case(1)
                                                <td>پاسخ داده شد</td>
                                                @break
                                                @default
                                                <td>ارسال شده</td>
                                            @endswitch
                                            <td><a class="btn btn-info" href="{{ route('student.practice.show',$item->id) }}">نمایش فعالیت</a></td>
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


