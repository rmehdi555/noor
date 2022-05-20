@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="body">


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

                            <a class="btn btn-info" href="{{ route('admin.class.create') }}">ایجاد کلاس جدید </a>

                            <br><br>
                        @if(count($classes)>0)
                            <p class="bu-margin-bottom-30">لیست کلاس ها : </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>کد کلاس</th>
                                        <th>عنوان رشته (اصلی)</th>
                                        <th>عنوان رشته (فرعی)</th>
                                        <th>نام</th>
                                        <th>توضیحات</th>
                                        <th>کد مغلم القرآن</th>
                                        <th>نام و نام خانوادگی معلم القرآن</th>
                                        <th>وضعیت کلاس</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($classes as $item)
                                        @php
                                            $typeTitle="قرآن آموز ها";
                                            if($item->type=="teacher")
                                                $typeTitle="معلم ها";
                                        @endphp

                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{($item->parent_id==0)?$item->fieldId->title:$item->classRooms->title}}</td>
                                            <td>{{$item->fieldId->title}}</td>
                                            <td >{{$item->name}}</td>
                                            <td style="max-width: 100px; overflow-x: auto"> {{$item->description}}</td>
                                            <td style="max-width: 100px; overflow-x: auto">{{$item->user->user_name}}</td>
                                            <td>{{$item->user->name}} {{$item->user->family}}</td>
                                            @switch($item->status)
                                                @case(1)
                                                <td>ایجاد شده</td>
                                                <td><a href="{{ route('admin.class.show',$item->id) }}" class="btn btn-info">{{$typeTitle}}</a><br>
                                                    <a href="{{ route('admin.class.edit',$item->id) }}" class="btn btn-warning">ویرایش </a>
                                                    <form class="form-horizontal" method="POST" action="{{ route('admin.class.delete') }}">
                                                        @csrf
                                                        <input type="hidden" name="class_room_id" value="{{$item->id}}">
                                                        <button type="button" class="btn btn-danger" onclick="deleteFunction()">حذف کلاس</button>

                                                    </form>
                                                </td>
                                                @break

                                                @case(2)
                                                <td>درحال برگزاری</td>
                                                <td><a href="{{ route('admin.class.show',$item->id) }}" class="btn btn-info">{{$typeTitle}}</a><br>
                                                    <a href="{{ route('admin.class.edit',$item->id) }}" class="btn btn-warning">ویرایش </a>
                                                    <form class="form-horizontal" method="POST" action="{{ route('admin.class.delete') }}">
                                                        @csrf
                                                        <input type="hidden" name="class_room_id" value="{{$item->id}}">
                                                        <button type="button" class="btn btn-danger" onclick="deleteFunction()">حذف کلاس</button>

                                                    </form>
                                                </td>
                                                @break

                                                @case(4)
                                                <td>آزمون</td>
                                                <td><a href="{{ route('admin.class.show',$item->id) }}" class="btn btn-info">{{$typeTitle}}</a><br>
                                                    <a href="{{ route('admin.class.edit',$item->id) }}" class="btn btn-warning">ویرایش </a></td>
                                                @break

                                                @case(5)
                                                <td>اتمام شده</td>
                                                <td><a href="{{ route('admin.class.show',$item->id) }}" class="btn btn-info">{{$typeTitle}}</a><br>
                                                    <a href="{{ route('admin.class.edit',$item->id) }}" class="btn btn-warning">ویرایش </a></td>

                                                @break

                                                @default
                                                <td>نامشخص میباشد به ادمین سایت اطلاع داده شود</td>
                                                <td></td>
                                            @endswitch



                                        </tr>

                                        @php $i++; @endphp
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


