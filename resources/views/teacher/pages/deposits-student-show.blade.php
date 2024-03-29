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



            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>لیست پرداختی ها</h2>
                        </div>
                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                    <tr>
                                        <th>{{__('admin/public.id')}}</th>
                                        <th>کد پرداختی</th>
                                        <th>تاریخ پرداختی</th>
                                        <th>{{__('admin/public.title')}}</th>
                                        <th>کد کاربری</th>
                                        <th>نام و نام خانوادگی</th>
                                        <th>سال</th>
                                        <th>ماه</th>
                                        <th>{{__('admin/public.price')}} ریال</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allDeposits as $item)
                                        <tr class="gradeA">
                                            <td>{{$item->id}}</td>
                                            <td>dti-{{$item->deposits_type_id }}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'H:i Y/m/d')}}</td>
                                            <td>{{\App\Providers\MyProvider::_text($item->title)}}</td>
                                            <td>{{$item->user->user_name}}</td>
                                            <td>{{$item->user->name}} {{$item->user->family}}</td>
                                            <td>{{$item->year}}</td>
                                            <td>{{$item->month}}</td>
                                            <td>{{$item->price}}     </td>
                                        </tr>
                                    @endforeach



                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{__('admin/public.id')}}</th>
                                        <th>{{__('admin/public.title')}}</th>
                                        <th>نام و نام خانوادگی</th>
                                        <th>{{__('admin/public.price')}} ریال</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection