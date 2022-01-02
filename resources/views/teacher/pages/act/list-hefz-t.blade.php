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
                            <input type="hidden" name="act_type" value="act_list_hefz_t">
                            <input type="hidden" name="class_rooms_id" value="{{$classRooms->id}}">
                            <input type="hidden" name="class_rooms_students_id" value="{{$classRoomsStudents->id}}">
                            <div class="row">
                                <div class="col-md-4 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="date">تاریخ : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input  name="date" id="date"  class="persian-datepicker form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-4 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="description">توضیح : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="text" name="description" id="description"  class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-4 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره حفظ :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_hefz" id="mark_hefz"  class="form-control" />
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دو درس :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_do_dars" id="mark_do_dars"  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره هشت درس :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_hasht_dars" id="mark_hasht_dars"  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره حفظ تخصصی :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_hefz_t" id="mark_hefz_t"  class="form-control" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره درس 1 :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_d1" id="mark_d1"  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">جزء درس 1 :
                                    </label>
                                    <select id="single-selection" name="j_d1" class="form-control multiselect multiselect-custom"  >
                                        @for($i=1;$i<=30;$i++)
                                          <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره درس 2 :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_d2" id="mark_d1"  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">جزء درس 2 :
                                    </label>
                                    <select id="single-selection" name="j_d2" class="form-control multiselect multiselect-custom"  >
                                        @for($i=1;$i<=30;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره درس 3 :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_d3" id="mark_d3"  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">جزء درس 3 :
                                    </label>
                                    <select id="single-selection" name="j_d3" class="form-control multiselect multiselect-custom"  >
                                        @for($i=1;$i<=30;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره درس 4 :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_d4" id="mark_d4"  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">جزء درس 4 :
                                    </label>
                                    <select id="single-selection" name="j_d4" class="form-control multiselect multiselect-custom"  >
                                        @for($i=1;$i<=30;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره درس 5 :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_d5" id="mark_d5"  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">جزء درس 5 :
                                    </label>
                                    <select id="single-selection" name="j_d5" class="form-control multiselect multiselect-custom"  >
                                        @for($i=1;$i<=30;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره درس 6 :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_d6" id="mark_d6"  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">جزء درس 6 :
                                    </label>
                                    <select id="single-selection" name="j_d6" class="form-control multiselect multiselect-custom"  >
                                        @for($i=1;$i<=30;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark" id="mark"  class="form-control" />
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



                            @if(count($listHefzT)>0)
                                                <p class="bu-margin-bottom-30">لیست فعالیت های این قرآن آموز : </p>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>تاریخ</th>
                                                            <th>توضیح</th>
                                                            <th>نمره حفظ</th>
                                                            <th>نمره دو درس</th>
                                                            <th>نمره هشت درس</th>
                                                            <th>نمره درس 1</th>
                                                            <th>جزء درس 1</th>
                                                            <th>نمره درس 2</th>
                                                            <th>جزء درس 2</th>
                                                            <th>نمره درس 3</th>
                                                            <th>جزء درس 3</th>
                                                            <th>نمره درس 4</th>
                                                            <th>جزء درس 4</th>
                                                            <th>نمره درس 5</th>
                                                            <th>جزء درس 5</th>
                                                            <th>نمره درس 6</th>
                                                            <th>جزء درس 6</th>
                                                            <th>نمره حفظ تخصصی</th>
                                                            <th>نمره</th>
                                                            <th>حاضر یا غایب</th>
                                                            <th>تنظیمات</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php $i=1 ;@endphp
                                                        @foreach($listHefzT as $item)
                                                            <tr>
                                                                <td>{{$i}}</td>
                                                                <td>{{\App\Providers\MyProvider::show_date($item->date,'Y-m-d')}}</td>
                                                                <td>{{$item->description}}</td>
                                                                <td>{{$item->mark_hefz}}</td>
                                                                <td>{{$item->mark_do_dars}}</td>
                                                                <td>{{$item->mark_hasht_dars}}</td>
                                                                <td>{{$item->mark_d1}}</td>
                                                                <td>{{$item->j_d1}}</td>
                                                                <td>{{$item->mark_d2}}</td>
                                                                <td>{{$item->j_d2}}</td>
                                                                <td>{{$item->mark_d3}}</td>
                                                                <td>{{$item->j_d3}}</td>
                                                                <td>{{$item->mark_d4}}</td>
                                                                <td>{{$item->j_d4}}</td>
                                                                <td>{{$item->mark_d5}}</td>
                                                                <td>{{$item->j_d5}}</td>
                                                                <td>{{$item->mark_d6}}</td>
                                                                <td>{{$item->j_d6}}</td>
                                                                <td>{{$item->mark_hefz_t}}</td>
                                                                <td>{{$item->mark}}</td>
                                                                <td>{{$item->presence?'حاضر':'غایب'}}</td>
                                                                <td>
                                                                    <form class="form-horizontal" method="POST" action="{{ route('teacher.act.list.delete') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="act_id" value="{{$item->id}}">
                                                                        <input type="hidden" name="act_type" value="act_list_hefz_t">
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


