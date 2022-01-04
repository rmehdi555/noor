@extends('teacher.master')
@section('content')
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bu-inner-main-form">
                        <br>



                        <form class="form-horizontal" method="POST" action="{{ route('teacher.work.hours.create.save') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="date">تاریخ : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input  name="date" id="date"  class="persian-datepicker form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="description">ساعت شروع : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="text" name="start_date" id="start_date"  class="only-timepicker form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="description">ساعت پایان : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="text" name="end_date" id="end_date"  class="only-timepicker form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class=" control-label"
                                           for="input-name"><br></label>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <input type="submit" class="btn btn-primary"
                                                   value="ثبت ساعت کارکرد جدید">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>


                        <br><br>
                        <hr>



                            @if(count($workHours)>0)
                                                <p class="bu-margin-bottom-30">لیست ساعات کارکرد های پرداخت نشده : </p>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>تاریخ</th>
                                                            <th>ساعت شروع</th>
                                                            <th>ساعت پایان</th>
                                                            <th>زمان به دقیقه</th>
                                                            <th>تنظیمات</th>
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
                                                                <td>
                                                                    <form class="form-horizontal" method="POST" action="{{ route('teacher.work.hours.delete.save') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{$item->id}}">
                                                                        <button type="button" class="btn btn-danger" onclick="deleteFunction()">حذف </button>
                                                                    </form>
                                                                </td>
                                                            @php $i++;@endphp
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


                            </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Start: Inner main -->





@endsection


