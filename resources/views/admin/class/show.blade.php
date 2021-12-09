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
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label">نام کلاس :  </label>
                                    <label class="col-md-12 col-sm-6 control-label">{{$classRoms->name}}</label>

                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label">توضیح :  </label>
                                    <label class="col-md-12 col-sm-6 control-label">{{$classRoms->description}}</label>

                                </div>


                            </div>
                            <hr>


                            <form class="form-horizontal" method="POST" action="{{ route('admin.class.register.save') }}">
                                @csrf
                                @if($classRoms->type=="student")
                                    <div class="row">
                                        <div class="col-md-6 padding-top-15">
                                            <label class="col-md-12 col-sm-6 control-label"
                                                   for="province">جستجو قرآن آموز جدید : <span
                                                        class="required">*</span></label>
                                            <div class="col-md-12 col-sm-6">

                                                <select class="form-control js-example-basic-single" name="studentFieldId">
                                                    @foreach ($studentsRegister as $item)
                                                        <option value="{{$item->id}}">{{$item->student->student_id}} : {{$item->student->name}} {{$item->student->family}} </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>





                        @else
                                            <div class="row">
                                                <div class="col-md-6 padding-top-15">
                                                    <label class="col-md-12 col-sm-6 control-label"
                                                           for="province">جستجو معلم جدید : <span
                                                                class="required">*</span></label>
                                                    <div class="col-md-12 col-sm-6">

                                                        <select class="form-control js-example-basic-single" name="teacher_id">
                                                            @foreach ($teachers as $item)
                                                                <option value="{{$item->id}}">{{$item->teacher_id}} : {{$item->name}} {{$item->family}} </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                </div>
                                    @endif
                                        <input type="hidden" name="classRoomsId" value="{{$classRoms->id}}">

                                        <div class="col-md-6 padding-top-15">

                                            <label class=" control-label"
                                                   for="input-name"><br></label>
                                            <div class="buttons">
                                                <div class="pull-right">
                                                    <input type="submit" class="btn btn-primary"
                                                           value="اضافه کردن به کلاس">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            </form>


                            <br><br>
                            <hr>



                        @if(count($students)>0 OR count($teachersR)>0)
                            <p class="bu-margin-bottom-30">لیست قرآن آموزان این کلاس : </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>تاریخ ایجاد</th>
                                        <th>تنظیمات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($classRoms->type=="student")
                                    @php $i=1@endphp
                                    @foreach($students as $item)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->student->name}}</td>
                                            <td>{{$item->student->family}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'%B %d، %Y  H:i')}}</td>
                                            <td>

                                                <form class="form-horizontal" method="POST" action="{{ route('admin.class.register.delete') }}">
                                                @csrf
                                                    <input type="hidden" name="class_room_student_id" value="{{$item->id}}">
                                                    <button type="button" class="btn btn-danger" onclick="deleteFunction()">حذف قرآن آموز از کلاس</button>

                                                </form>

                                            </td>

                                        @php $i++ @endphp
                                    @endforeach
                                        @else
                                        @php $i=1@endphp
                                        @foreach($teachersR as $item)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$item->teacher->name}}</td>
                                                <td>{{$item->teacher->family}}</td>
                                                <td>{{\App\Providers\MyProvider::show_date($item->created_at,'%B %d، %Y  H:i')}}</td>
                                                <td>

                                                    <form class="form-horizontal" method="POST" action="{{ route('admin.class.register.teacher.delete') }}">
                                                        @csrf
                                                        <input type="hidden" name="class_room_student_id" value="{{$item->id}}">
                                                        <button type="button" class="btn btn-danger" onclick="deleteFunction()">حذف معلم از کلاس</button>

                                                    </form>

                                                </td>

                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
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


