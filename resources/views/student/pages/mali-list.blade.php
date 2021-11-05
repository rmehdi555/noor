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


                        <br>
                        @if(count($malis)>0)
                            <p class="bu-margin-bottom-30">لیست واریزی ها : </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>تاریخ</th>
                                        <th>توضیح</th>
                                        <th>{{__('web/public.price')}}({{__('web/public.currency_name_IRR')}})</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1@endphp
                                    @foreach($malis as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'%B %d، %Y  H:i')}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>{{number_format($item->price)}}</td>
                                            @switch($item->status)
                                                @case(1)
                                                <td>پرداخت شده</td>
                                                @break

                                                @default
                                                <td>نامشخص میباشد به ادمین سایت اطلاع داده شود</td>
                                            @endswitch
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


