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
                                <label class="col-md-12 col-sm-6 control-label">نام خانوادگی قرآن آموز :  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$student->family}}</label>

                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label">کد قرآن آموزی :  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$student->student_id}}</label>

                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label">نام پدر قرآن آموز :  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$student->f_name}}</label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label">عنوان کلاس :  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$classRooms->name}}</label>

                            </div>
                            <div class="col-md-3 padding-top-15">
                                <label class="col-md-12 col-sm-6 control-label">توضیحات کلاس:  </label>
                                <label class="col-md-12 col-sm-6 control-label">{{$classRooms->description}}</label>

                            </div>
                        </div>
                        <hr>

                        @if($act_type=='act_list_hefz')


                        <form class="form-horizontal" method="POST" action="{{ route('teacher.act.list.edit.save') }}">
                            @csrf
                            <input type="hidden" name="act_type" value="act_list_hefz">
                            <input type="hidden" name="class_rooms_id" value="{{$classRooms->id}}">
                            <input type="hidden" name="class_rooms_students_id" value="{{$classRoomsStudents->id}}">
                            <input type="hidden" name="act_id" value="{{$act->id}}">
                            <div class="row">
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="date">تاریخ : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input  name="date" id="date"  class="persian-datepicker form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="description">توضیح :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="text" name="description" id="description" value="{{$act->description}}"  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره حفظ :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_hefz" id="mark_hefz"  value="{{$act->mark_hefz}}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره ده درس :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_dah_dars" id="mark_dah_dars" value="{{$act->mark_dah_dars}}" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دوره 1 :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_d1" id="mark_d1" value="{{$act->mark_d1}}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">شماره جزء 1 :
                                    </label>
                                    <select id="single-selection" name="j_d1" class="form-control multiselect multiselect-custom"  >
                                        <option value="NULL">هیچکدام</option>
                                        @for($i=1;$i<=30;$i++)
                                          <option value="{{$i}}" {{$act->j_d1==$i?"selected":""}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دوره 2 :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_d2" id="mark_d1"  value="{{$act->mark_d2}}" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">شماره جزء 2 :
                                    </label>
                                    <select id="single-selection" name="j_d2" class="form-control multiselect multiselect-custom"  >
                                        <option value="NULL">هیچکدام</option>
                                        @for($i=1;$i<=30;$i++)
                                            <option value="{{$i}}" {{$act->j_d2==$i?"selected":""}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دوره 3 :
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="number" step="0.001" name="mark_d3" id="mark_d1" value="{{$act->mark_d3}}"  class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">شماره جزء 3 :
                                    </label>
                                    <select id="single-selection" name="j_d3" class="form-control multiselect multiselect-custom"  >
                                        <option value="NULL">هیچکدام</option>
                                        @for($i=1;$i<=30;$i++)
                                            <option value="{{$i}}" {{$act->j_d3==$i?"selected":""}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-3 padding-top-15">
                                    <label class="col-md-12 col-sm-4 control-label" for="presence">حاضر یا غایب :
                                    </label>
                                        <select id="single-selection" name="presence" class="form-control multiselect multiselect-custom"  >
                                            <option value="1">حاضر</option>
                                            <option value="0" {{$act->presence==0?"selected":""}}>غایب</option>
                                        </select>
                                </div>

                                <div class="col-md-3 padding-top-15">

                                    <label class=" control-label"
                                           for="input-name"><br></label>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <input type="submit" class="btn btn-primary"
                                                   value="ویرایش فعالیت">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        @elseif($act_type=='act_list_hefz_t')
                            <form class="form-horizontal" method="POST" action="{{ route('teacher.act.list.edit.save') }}">
                                @csrf
                                <input type="hidden" name="act_type" value="act_list_hefz_t">
                                <input type="hidden" name="class_rooms_id" value="{{$classRooms->id}}">
                                <input type="hidden" name="class_rooms_students_id" value="{{$classRoomsStudents->id}}">
                                <input type="hidden" name="act_id" value="{{$act->id}}">
                                <div class="row">
                                    <div class="col-md-4 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="date">تاریخ : <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input  name="date" id="date"  class="persian-datepicker form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="description">توضیح :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="text" name="description" id="description" value="{{$act->description}}"  class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره حفظ :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark_hefz" id="mark_hefz" value="{{$act->mark_hefz}}" class="form-control" />
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دو درس :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark_do_dars" id="mark_do_dars" value="{{$act->mark_do_dars}}"  class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره هشت درس :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark_hasht_dars" id="mark_hasht_dars" value="{{$act->mark_hasht_dars}}"  class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره حفظ تخصصی :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark_hefz_t" id="mark_hefz_t" value="{{$act->mark_hefz_t}}"  class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دوره 1 :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark_d1" id="mark_d1" value="{{$act->mark_d1}}"  class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-4 control-label" for="presence">شماره جزء 1 :
                                        </label>
                                        <select id="single-selection" name="j_d1" class="form-control multiselect multiselect-custom"  >
                                            <option value="NULL">هیچکدام</option>
                                            @for($i=1;$i<=30;$i++)
                                                <option value="{{$i}}" {{$act->j_d1==$i?"selected":""}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دوره 2 :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark_d2" id="mark_d1" value="{{$act->mark_d2}}"   class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-4 control-label" for="presence">شماره جزء 2 :
                                        </label>
                                        <select id="single-selection" name="j_d2" class="form-control multiselect multiselect-custom"  >
                                            <option value="NULL">هیچکدام</option>
                                            @for($i=1;$i<=30;$i++)
                                                <option value="{{$i}}" {{$act->j_d2==$i?"selected":""}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دوره 3 :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark_d3" id="mark_d3"  value="{{$act->mark_d3}}"  class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-4 control-label" for="presence">شماره جزء 3 :
                                        </label>
                                        <select id="single-selection" name="j_d3" class="form-control multiselect multiselect-custom"  >
                                            <option value="NULL">هیچکدام</option>
                                            @for($i=1;$i<=30;$i++)
                                                <option value="{{$i}}" {{$act->j_d3==$i?"selected":""}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دوره 4 :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark_d4" id="mark_d4"  value="{{$act->mark_d4}}"  class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-4 control-label" for="presence">شماره جزء 4 :
                                        </label>
                                        <select id="single-selection" name="j_d4" class="form-control multiselect multiselect-custom"  >
                                            <option value="NULL">هیچکدام</option>
                                            @for($i=1;$i<=30;$i++)
                                                <option value="{{$i}}" {{$act->j_d4==$i?"selected":""}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دوره 5 :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark_d5" id="mark_d5" value="{{$act->mark_d5}}"   class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-4 control-label" for="presence">شماره جزء 5 :
                                        </label>
                                        <select id="single-selection" name="j_d5"  class="form-control multiselect multiselect-custom"  >
                                            <option value="NULL">هیچکدام</option>
                                            @for($i=1;$i<=30;$i++)
                                                <option value="{{$i}}" {{$act->j_d1=5==$i?"selected":""}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره دوره 6 :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark_d6" id="mark_d6" value="{{$act->mark_d6}}"   class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 padding-top-15">
                                        <label class="col-md-12 col-sm-4 control-label" for="presence">شماره جزء 6 :
                                        </label>
                                        <select id="single-selection" name="j_d6" class="form-control multiselect multiselect-custom"  >
                                            <option value="NULL">هیچکدام</option>
                                            @for($i=1;$i<=30;$i++)
                                                <option value="{{$i}}" {{$act->j_d5==$i?"selected":""}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">صفحه حفظ تحویلی :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="s_h_t" id="s_h_t" value="{{$act->s_h_t}}"   class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 padding-top-15">
                                        <label class="col-md-12 col-sm-4 control-label" for="presence">حاضر یا غایب :
                                        </label>
                                        <select id="single-selection" name="presence" class="form-control multiselect multiselect-custom"  >
                                            <option value="1">حاضر</option>
                                            <option value="0" {{$act->presence==0?"selected":""}}>غایب</option>
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

                        @elseif($act_type=='act_list_public')
                            <form class="form-horizontal" method="POST" action="{{ route('teacher.act.list.edit.save') }}">
                                @csrf
                                <input type="hidden" name="act_type" value="act_list_public">
                                <input type="hidden" name="class_rooms_id" value="{{$classRooms->id}}">
                                <input type="hidden" name="class_rooms_students_id" value="{{$classRoomsStudents->id}}">
                                <input type="hidden" name="act_id" value="{{$act->id}}">
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="date">تاریخ : <span class="required">*</span>
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input  name="date" id="date"  class="persian-datepicker form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="description">توضیح :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="text" name="description" id="description"  value="{{$act->description}}" class=" form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label" for="mark">نمره :
                                        </label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="number" step="0.001" name="mark" id="mark"  value="{{$act->mark}}"  class=" form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 padding-top-15">
                                        <label class="col-md-12 col-sm-4 control-label" for="presence">حاضر یا غایب :
                                        </label>


                                        <select id="single-selection" name="presence" class="form-control multiselect multiselect-custom"  >
                                            <option value="1">حاضر</option>
                                            <option value="0" {{$act->presence==0?"selected":""}}>غایب</option>
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


                        @endif

                        <br><br>
                        <hr>




                    </div>
                </div>
            </div>
    </section>
    <!-- Start: Inner main -->





@endsection


