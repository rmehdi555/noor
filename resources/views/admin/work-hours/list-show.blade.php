@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
            </div>

            <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bu-inner-main-form">

                        <a class="btn btn-info" href="{{ route('admin.work.hours.list.show.pay') }}">جهت تهیه لیست پرداختی کارکرد های پرداخت نشده اینجا کلیک نمایید </a>
<br>
                        <br>
                        <br>
                        <hr>
                        <br>
                        <br>



                            @if(count($teachersWorkHoursList)>0)
                                                <p class="bu-margin-bottom-30">لیست ساعات کارکرد ها : </p>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                        <thead>
                                                        <tr>
                                                            <th>کد فیش پرداختی</th>
                                                            <th>تاریخ ثبت فیش</th>
                                                            <th>عنوان</th>
                                                            <th>توضیحات</th>
                                                            <th>زمان کارکرد  به ساعت</th>
                                                            <th>مبلغ هر ساعت به ریال</th>
                                                            <th>توضیحات مموع افزوده ها</th>
                                                            <th>مبلغ افزوده ها به ریال</th>
                                                            <th>توضیحات مموع کسری ها</th>
                                                            <th>مبلغ کسری ها به ریال</th>
                                                            <th>مجموع پرداختی به ریال</th>
                                                            <th>نام معلم</th>
                                                            <th>نام خانوادگی معلم</th>
                                                            <th>نام پدر معلم</th>
                                                            <th>کد معلم القرآنی</th>
                                                            <th>نام صاحب کارت</th>
                                                            <th>شماره حساب</th>
                                                            <th>شماره کارت</th>
                                                            <th>شماره شبا</th>
                                                            <th>نام بانک</th>
                                                            <th>وضعیت</th>
                                                            <th>تنظیمات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($teachersWorkHoursList as $item)
                                                            <tr>
                                                                <td>{{$item->id}}</td>
                                                                <td>{{\App\Providers\MyProvider::show_date($item->created_at,'Y-m-d')}}</td>
                                                                <td>{{$item->name}}</td>
                                                                <td>{{$item->description}}</td>
                                                                <td>{{$item->hours}}</td>
                                                                <td>{{$item->price_hours}}</td>
                                                                <td>{{$item->a_description}}</td>
                                                                <td>{{$item->a_price}}</td>
                                                                <td>{{$item->k_description}}</td>
                                                                <td>{{$item->k_price}}</td>
                                                                <td>{{$item->totalSum}}</td>
                                                                <td>{{$item->user->name}}</td>
                                                                <td>{{$item->user->family}}</td>
                                                                <td>{{isset($item->user->teacher->f_name)?$item->user->teacher->f_name:'-'}}</td>
                                                                <td>{{isset($item->user->teacher->teacher_id)?$item->user->teacher->teacher_id:'-'}}</td>
                                                                <td>{{$item->card_name}}</td>
                                                                <td>{{$item->hesab_number}}</td>
                                                                <td>{{$item->card_number}}</td>
                                                                <td>{{$item->sheba_number}}</td>
                                                                <td>{{$item->bank_name}}</td>

                                                                @switch($item->status)
                                                                    @case(1)
                                                                    <td>درحال پرداخت</td>
                                                                    <td>
                                                                        <form class="form-horizontal" method="POST" action="{{ route('admin.work.hours.list.delete') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                                            <button type="button" class="btn btn-danger" onclick="deleteFunction()">حذف </button>
                                                                        </form>
                                                                        <form class="form-horizontal" method="POST" action="{{ route('admin.work.hours.list.pay') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                                            <button type="submit" class="btn btn-info">تایید پرداخت </button>
                                                                        </form>
                                                                        <form class="form-horizontal" method="POST" action="{{ route('admin.work.hours.list.show.details') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                                            <button type="submit" class="btn btn-info">نمایش ریز جزئیات پرداختی </button>
                                                                        </form>
                                                                    </td>
                                                                    @break
                                                                    @case (5)
                                                                    <td> پرداخت شده </td>
                                                                    <td>
                                                                        <form class="form-horizontal" method="POST" action="{{ route('admin.work.hours.list.show.details') }}">
                                                                            @csrf
                                                                            <input type="hidden" name="id" value="{{$item->id}}">
                                                                            <button type="submit" class="btn btn-info">نمایش ریز جزئیات پرداختی </button>
                                                                        </form>
                                                                    </td>
                                                                    @break
                                                                    @default
                                                                    <td>نامشخص</td>
                                                                    <td></td>

                                                                @endswitch




                                                            </tr>
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

                        <br><br>


                            </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Start: Inner main -->





@endsection


