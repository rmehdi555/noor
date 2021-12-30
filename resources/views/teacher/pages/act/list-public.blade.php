@extends('teacher.master')
@section('content')
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bu-inner-main-form">
                        <br>
                        <div class="row">
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label">نام قرآن آموز :  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$student->name}}</label>

                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label">فامیلی قرآن آموز :  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$student->family}}</label>

                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label">کد قرآن اموز :  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$student->student_id}}</label>

                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label">نام پدر قرآن آموز :  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$student->f_name}}</label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label">نام کلاس :  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$classRooms->name}}</label>

                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label">توضیح :  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$classRooms->description}}</label>

                            </div>
                        </div>
                        <hr>


                        <form class="form-horizontal" method="POST" action="{{ route('teacher.act.list.save') }}">
                            @csrf
                            <input type="hidden" name="act_type" value="act_list_public">
                            <input type="hidden" name="class_rooms_id" value="{{$classRooms->id}}">
                            <input type="hidden" name="class_rooms_students_id" value="{{$classRoomsStudents->id}}">
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="date">تاریخ : <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input  name="date" id="date"  class="persian-datepicker form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="description">توضیح : <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="text" name="description" id="description"  class=" form-control" required/>
                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-md-4 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark" id="mark"  class=" form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">حاضر یا غایب :
                                    </label>


                                        <select id="single-selection" name="presence" class="form-control multiselect multiselect-custom"  >
                                            <option value="1">حاضر</option>
                                            <option value="0">غایب</option>
                                        </select>

                                </div>

                                <div class="col-md-4 padding-top-15">

                                    <label class=" control-label"
                                           for="input-name"><br></label>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <input type="submit" class="btn btn-primary"
                                                   value="ثبت فعالیت جدید">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>


                        <br><br>
                        <hr>



                            @if(count($listPublics)>0)
                                                <p class="bu-margin-bottom-30">لیست معلم های این کلاس : </p>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>تاریخ</th>
                                                            <th>توضیح</th>
                                                            <th>نمره</th>
                                                            <th>حاضر یا غایب</th>
                                                            <th>تنظیمات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php $i=1 ;@endphp
                                                        @foreach($listPublics as $item)
                                                            <tr>
                                                                <td>{{$i}}</td>
                                                                <td>{{\App\Providers\MyProvider::show_date($item->date,'Y-m-d')}}</td>
                                                                <td>{{$item->description}}</td>
                                                                <td>{{$item->mark}}</td>
                                                                <td>{{$item->presence?'حاضر':'غایب'}}</td>
                                                                <td>
                                                                    <form class="form-horizontal" method="POST" action="{{ route('teacher.act.list.delete') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="act_id" value="{{$item->id}}">
                                                                        <input type="hidden" name="act_type" value="act_list_public">
                                                                        <input type="hidden" name="class_rooms_id" value="{{$classRooms->id}}">
                                                                        <input type="hidden" name="class_rooms_students_id" value="{{$classRoomsStudents->id}}">
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


