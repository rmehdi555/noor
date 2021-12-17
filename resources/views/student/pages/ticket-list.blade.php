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

                            <a class="btn btn-info" href="{{ route('student.ticket.add') }}">ثبت تیکت جدید</a>

                        <br>
                            <br>
                            <hr>
                        @if(count($tickets)>0)
                            <p class="bu-margin-bottom-30">لیست پشتیبانی های ثبت شده : </p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کد پیگیری</th>
                                        <th>تاریخ</th>
                                        <th>عنوان تیکت</th>
                                        <th>نام ارسال کننده </th>
                                        <th>نام دریافت کننده</th>
                                        <th>وضعیت</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1@endphp
                                    @foreach($tickets as $item)
                                        @php
                                            if($item->updated_at!=null)
                                            $item->created_at=$item->updated_at;
                                        @endphp

                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->id}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'H:i Y/m/d')}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->userSender->name}} {{$item->userSender->family}}</td>
                                            <td>{{$item->userReciver->name}} {{$item->userReciver->family}}</td>
                                            @switch($item->status)
                                                @case(1)
                                                <td>پاسخ داده شده</td>
                                                @break
                                                @default
                                                <td>در انتظار پاسخ</td>
                                            @endswitch
                                            <td><a class="btn btn-info" href="{{ route('student.ticket.show',$item->id) }}">نمایش تیکت</a></td>
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


