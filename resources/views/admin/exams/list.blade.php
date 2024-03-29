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


                            <a class="btn btn-info" href="{{ route('admin.exams.create') }}">طراحی آزمون جدید</a>

                            <br>
                            <br>
                            <hr>
                        @if(count($exams)>0)
                            <p class="bu-margin-bottom-30">لیست آزمون ها : </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان</th>
                                        <th>تاریخ شروع آزمون</th>
                                        <th>تاریخ پایان آزمون</th>
                                        <th>تنظیمات</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1@endphp
                                    @foreach($exams as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->title}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->start_exam,'H:i Y/m/d')}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->end_exam,'H:i Y/m/d')}}</td>
                                            <td><a class="btn btn-info" href="{{ route('admin.exams.show',$item->id) }}">نمایش سوالات آزمون</a></td>
                                            <td><a class="btn btn-info" href="{{ route('admin.exams.edit',$item->id) }}">ویرایش ساعت آزمون</a></td>
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


