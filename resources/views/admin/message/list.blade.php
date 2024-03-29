@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
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

                            <a class="btn btn-info" href="{{ route('admin.message.add') }}">ثبت پیام جدید</a>

                        <br>
                            <br>
                            <hr>
                        @if(count($messages)>0)
                            <p class="bu-margin-bottom-30">لیست پیام ها : </p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تاریخ</th>
                                        <th>عنوان تیکت</th>
                                        <th>نام ارسال کننده </th>
                                        <th>نام دریافت کننده</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1@endphp
                                    @foreach($messages as $item)
                                        @php
                                            if($item->updated_at!=null)
                                            $item->created_at=$item->updated_at;
                                        @endphp

                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'H:i Y/m/d')}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->userSender->name}} {{$item->userSender->family}}</td>
                                            @if($item->user_id_reciver==0)
                                                <td>پیام عمومی</td>
                                                @else
                                                <td>{{$item->userReciver->name}} {{$item->userReciver->family}}</td>
                                            @endif
                                            <td><a class="btn btn-info" href="{{ route('admin.message.show',$item->id) }}">نمایش پیام</a>

                                                <form class="form-horizontal" method="POST" action="{{ route('admin.message.delete') }}">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <button type="button" class="btn btn-danger" onclick="deleteFunction()">حذف </button>
                                                </form>
                                            </td>
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


        </div>
    </div>


@endsection


