@extends('student.master')
@section('content')



    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">

            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-12">
                    <h1 class="title-404 text-center">404</h1>
                    <p class="text-center lead">{{__('web/messages.404_1')}}<br>
                        {{__('web/messages.404_2')}} </p>
                    <div class="buttons text-center"><a class="btn btn-primary btn-lg"
                                                        href="{{ route('web.index') }}"> {{__('web/public.continuation')}}</a>
                    </div>
                </div>
                <!--Middle Part End -->
            </div>


        </div>
    </section>
    <!-- Start: Inner main -->

    @if(count($panelMessages)>0)
        <p class="bu-margin-bottom-30">لیست آخرین پیام ها : </p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover ">
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
                @foreach($panelMessages as $item)
                    @php
                        if($item->updated_at!=null)
                        $item->created_at=$item->updated_at;
                    @endphp

                    <tr>
                        <td>{{$i}}</td>
                        <td>{{\App\Providers\MyProvider::show_date($item->created_at,'%B %d، %Y  H:i')}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->userSender->name}} {{$item->userSender->family}}</td>
                        @if($user->user_id_reciver==0)
                            <td>پیام عمومی</td>
                        @else
                            <td>{{$item->userReciver->name}} {{$item->userReciver->family}}</td>
                        @endif
                        <td><a class="btn btn-info" href="{{ route('student.message.show',$item->id) }}">نمایش پیام</a></td>
                    </tr>
                    @php $i++ @endphp
                @endforeach
                </tbody>
            </table>
        </div>


    @endif


@endsection