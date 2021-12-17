@extends('teacher.master')
@section('content')



    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success m-1">
                        <p class="p-1 text-justify">
                            کد معلم القرآن:
                            {{$user->teacher->teacher_id }}
                            <br>
                            تاریخ ایجاد :
                            <span >{{\App\Providers\MyProvider::show_date($user->created_at,'H:i j-n-Y ')}}</span>
                        </p>
                    </div>
                </div>
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
                        <td>{{\App\Providers\MyProvider::show_date($item->created_at,'H:i Y/m/d')}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->userSender->name}} {{$item->userSender->family}}</td>
                        @if($item->user_id_reciver==0)
                            <td>پیام عمومی</td>
                        @else
                            <td>{{$item->userReciver->name}} {{$item->userReciver->family}}</td>
                        @endif
                        <td><a class="btn btn-info" href="{{ route('teacher.message.show',$item->id) }}">نمایش پیام</a></td>
                    </tr>
                    @php $i++ @endphp
                @endforeach
                </tbody>
            </table>
        </div>


    @endif


@endsection