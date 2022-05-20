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


                        <br>



                            <form class="form-horizontal" method="GET" action="{{ route('admin.class.register.report') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-12 control-label" for="start_exam">از تاریخ
                                            : <span class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input  name="from" id="start-exam-show"
                                                    class=" persian-datepicker-time form-control  @error('start_exam') is-invalid @enderror" required/>
                                            @error('start_exam')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-12 control-label"
                                               for="end_exam">تا تاریخ  : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-10">
                                            <input  name="to" id="end-exam-show"
                                                    class="persian-datepicker-time form-control  @error('end_exam') is-invalid @enderror" required/>
                                            @error('end_exam')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-6 padding-top-15">
                                            <label class="col-md-12 col-sm-6 control-label"
                                                   for="province">فیلتر کردن بر اساس تاریخ : <span
                                                        class="required">*</span></label>


                                        </div>

                                        <div class="col-md-6 padding-top-15">

                                            <label class=" control-label"
                                                   for="input-name"><br></label>
                                            <div class="buttons">
                                                <div class="pull-right">
                                                    <input type="submit" class="btn btn-primary"
                                                           value="فیلتر شود">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </form>


                            <br><br>
                            <hr>



                        @if(count($students)>0)
                            <p class="bu-margin-bottom-30">لیست قرآن آموزان : </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کد قرآن آموزی</th>
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>نام پدر</th>
                                        <th>تاریخ ایجاد</th>
                                        <th>نام درس</th>
                                        <th>نام کلاس</th>
                                        <th>کد معلم</th>
                                        <th>نام معلم</th>
                                        <th>وضعیت</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1;@endphp
                                    @foreach($students as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->student->student_id}}</td>
                                            <td>{{$item->student->name}}</td>
                                            <td>{{$item->student->family}}</td>
                                            <td>{{$item->student->f_name}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'H:i Y/m/d')}}</td>
                                            <td>{{$item->classRooms->fieldid->title}}</td>
                                            <td>{{$item->classRooms->name}}</td>
                                            <td>{{$item->teacher->teacher_id}}</td>
                                            <td>{{$item->teacher->name}} {{$item->teacher->f_name}}</td>


                                            @switch($item->status)
                                                @case(1)
                                                <td>ایجاد شده</td>
                                                @break

                                                @case(2)
                                                <td>درحال برگزاری</td>
                                                @break

                                                @case(4)
                                                <td>آزمون</td>
                                                @break

                                                @case(5)
                                                <td>اتمام شده</td>
                                                @break
                                                @case(6)
                                                <td>انصراف داده</td>

                                                @break

                                                @default

                                                <td>نامشخص میباشد به ادمین سایت اطلاع داده شود</td>
                                            @endswitch
                                        </tr>
                                        @php $i++; @endphp
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


