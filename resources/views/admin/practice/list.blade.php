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


                            <hr>
                        @if(count($practices)>0)
                            <p class="bu-margin-bottom-30">لیست فعالیت های ثبت شده : </p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تاریخ</th>
                                        <th>عنوان کلاس</th>
                                        <th>کد قرآن آموز</th>
                                        <th>نام قرآن آموز</th>
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
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'%B %d، %Y  H:i')}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->user->student->id}}</td>
                                            <td>{{$item->user->student->name}} {{$item->user->student->family}}</td>
                                            @switch($item->visited)
                                                @case(1)
                                                <td>مشاهده شده</td>
                                                @break
                                                @default
                                                <td>مشاهده نشده</td>
                                            @endswitch
                                            <td><a class="btn btn-info" href="{{ route('admin.practice.show',$item->id) }}">نمایش فعالیت</a></td>
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


