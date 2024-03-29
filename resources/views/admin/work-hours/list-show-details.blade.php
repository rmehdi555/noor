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
                        <br>
                        <h3>اطلاعات فردی</h3>
                        <br>

                        <div class="row">
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label" for="date">نام :
                                    {{$user->name}}
                                </label>
                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label" for="date">نام خانوادگی :
                                    {{$user->family}}
                                </label>
                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label" for="date">نام پدر :
                                    {{$user->teacher->f_name}}
                                </label>
                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label" for="date">کد معلم القرآنی :
                                    {{$user->teacher->teacher_id}}
                                </label>
                            </div>

                         </div>
                        <br><br>
                        <hr>
                        <h3>اطلاعات کارت بانکی</h3>
                        <br>

                        <div class="row">
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label" for="date">نام صاحب کارت :
                                    {{$cardNumberBank->name}}
                                </label>
                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label" for="date">نام بانک :
                                    {{$cardNumberBank->bank_name}}
                                </label>
                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label" for="date">شماره کارت :
                                    {{$cardNumberBank->card_number}}
                                </label>
                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label" for="date">شماره حساب :
                                    {{$cardNumberBank->hesab_number}}
                                </label>
                            </div>

                        </div>
                        <br><br>
                        <hr>





                        @php $totalTime=0;@endphp

                            @if(count($workHours)>0)
                                                <p class="bu-margin-bottom-30">لیست ساعات کارکرد ها : </p>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>تاریخ</th>
                                                            <th>ساعت شروع</th>
                                                            <th>ساعت پایان</th>
                                                            <th>زمان به دقیقه</th>
                                                            <th>وضعیت</th>
                                                            {{--<th>تنظیمات</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php $i=1 ;@endphp
                                                        @foreach($workHours as $item)
                                                            <tr>
                                                                <td>{{$i}}</td>
                                                                <td>{{\App\Providers\MyProvider::show_date($item->date,'Y-m-d')}}</td>
                                                                <td>{{\App\Providers\MyProvider::show_date($item->start_date,'H:i')}}</td>
                                                                <td>{{\App\Providers\MyProvider::show_date($item->end_date,'H:i')}}</td>
                                                                <td>{{\App\Providers\MyProvider::submission_date($item->end_date,$item->start_date)}}</td>
                                                                @php $totalTime+=\App\Providers\MyProvider::submission_date($item->end_date,$item->start_date);@endphp
                                                                @switch($item->status)
                                                                    @case(1)
                                                                    <td>ایجاد شده</td>
                                                                    @break
                                                                    @case(2)
                                                                    <td>درحال پرداخت</td>
                                                                    @break
                                                                    @case (5)
                                                                    <td> پرداخت شده </td>
                                                                    @break
                                                                    @default
                                                                    <td>نامشخص</td>
                                                                @endswitch
                                                            @php $i++;@endphp
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>

                            <br><br>
                            <hr>

                            <br>
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="name">عنوان فیش :<span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="text"  name="name" id="name"  class="form-control" value="{{$teachersWorkHoursList->name}}" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="description">توضیحات فیش :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="text" name="description" id="description"  value="{{$teachersWorkHoursList->description}}" class="form-control"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="a_description">توضیحات مجموع افزوده ها :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="text"  name="a_description" id="a_description" value="{{$teachersWorkHoursList->a_description}}" class="form-control"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="a_price">مبلغ مجموع افزوده ها : ( به ریال ) <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="a_price" id="a_price" value="{{$teachersWorkHoursList->a_price}}" class="form-control" value="0" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="k_description">توضیحات مجموع کسری ها :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="text"  name="k_description" id="k_description" value="{{$teachersWorkHoursList->k_description}}" class="form-control"  />
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="k_price">مبلغ مجموع کسری ها : ( به ریال ) <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="k_price" id="k_price" value="{{$teachersWorkHoursList->k_price}}" class="form-control" value="0"  required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="hours">مجموع ساعات فعالیت ثبت شده توسط کاربر : ( به ساعت ) <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="hours" id="hours"  class="form-control" value="{{$teachersWorkHoursList->hours}}" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="hours">مجموع ساعات فعالیت محاسبه توسط سیستم : ( به ساعت ) <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="hours" id="hours"  class="form-control" value="{{round($totalTime/60,3,1)}}" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="price_hours">مبلغ هر ساعت فعالیت : ( به ریال ) <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="price_hours" id="price_hours"  class="form-control" value="{{$teachersWorkHoursList->price_hours}}" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="totalSum">مجموع کل پرداختی : ( به ریال ) <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="totalSum" id="totalSum"  class="form-control" value="{{$teachersWorkHoursList->totalSum}}"  required/>
                                        </div>
                                    </div>

                                </div>


                            <br><br>
                            <hr>
                            <br><br>
                            <hr>


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


