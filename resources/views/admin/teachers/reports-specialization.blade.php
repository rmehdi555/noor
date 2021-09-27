@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>{{__('admin/public.teachers_list')}}</h2>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        {{--<ul class="breadcrumb justify-content-end">--}}
                            {{--<li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>--}}
                        {{--</ul>--}}
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>{{__('admin/public.teachers_list')}}</h2>
                        </div>

                        <form class="form-horizontal" method="GET" action="{{ route('teachers.reports.specialization') }}">
                            @csrf
                            <input type="hidden" name="SID" value="53">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label"
                                               for="input-name">نوع کلاس را انتخاب نمایید : <span class="required">*</span> </label>
                                        <div class="col-md-10 col-sm-9">
                                            <select name="id" id="select-field-main"
                                                    class="form-control">
                                                @foreach($specializations as $item)
                                                        <option class="option-field-main"
                                                                id="{{$item->id}}"
                                                                value="{{$item->id}}" @php if($id==$item->id)echo"selected";@endphp>{{\App\Providers\MyProvider::_text($item->title)}}</option>
                                                @endforeach

                                            </select>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" control-label"
                                           for="input-name"><br></label>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <input type="submit" class="btn btn-primary"
                                                   value="نمایش گزارش">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>



                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>نوع کلاس</th>
                                        <th>{{__('admin/public.teacher_id')}}</th>
                                        <th>{{__('admin/public.created_at')}}</th>
                                        <th>{{__('admin/public.sex')}}</th>
                                        <th>{{__('admin/public.name')}}</th>
                                        <th>{{__('admin/public.family')}}</th>
                                        <th>{{__('admin/public.f_name')}}</th>
                                        <th>{{__('admin/public.sh_number')}}</th>
                                        <th>{{__('admin/public.meli_number')}}</th>
                                        <th>{{__('admin/public.sh_sodor')}}</th>
                                        <th>{{__('admin/public.tavalod_date')}}</th>
                                        <th>{{__('admin/public.phone_1')}}</th>
                                        <th>{{__('admin/public.phone_2')}}</th>
                                        <th>{{__('admin/public.phone_f')}}</th>
                                        <th>{{__('admin/public.phone_m')}}</th>
                                        <th>{{__('admin/public.tel')}}</th>
                                        <th>{{__('admin/public.province')}}</th>
                                        <th>{{__('admin/public.city')}}</th>
                                        <th>{{__('admin/public.address')}}</th>
                                        <th>{{__('admin/public.post_number')}}</th>
                                        <th>{{__('admin/public.education')}}</th>
                                        <th>{{__('admin/public.job')}}</th>
                                        <th>{{__('admin/public.email')}}</th>
                                        <th>{{__('admin/public.number_of_children')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teachers as $item)
                                        <tr class="gradeA">
                                            <td>{{$item->title}}</td>
                                            <td>{{$item->teacher_id}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'Y-n-j')}}</td>
                                            <td>{{__('admin/public.'.$item->sex)}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->family}}</td>
                                            <td>{{$item->f_name}}</td>
                                            <td>{{$item->sh_number}}</td>
                                            <td>{{$item->meli_number}}</td>
                                            <td>{{$item->sh_sodor}}</td>
                                            <td>{{$item->tavalod_date}}</td>
                                            <td>{{$item->phone_1}}</td>
                                            <td>{{$item->phone_2}}</td>
                                            <td>{{$item->phone_f}}</td>
                                            <td>{{$item->phone_m}}</td>
                                            <td>{{$item->tel}}</td>
                                            <td>{{$item->province}}</td>
                                            <td>{{$item->city}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->post_number}}</td>
                                            <td>{{$item->education }}</td>
                                            <td>{{$item->job }}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->number_of_children }}</td>
                                        </tr>
                                    @endforeach



                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>نوع کلاس</th>
                                        <th>{{__('admin/public.teacher_id')}}</th>
                                        <th>{{__('admin/public.created_at')}}</th>
                                        <th>{{__('admin/public.sex')}}</th>
                                        <th>{{__('admin/public.name')}}</th>
                                        <th>{{__('admin/public.family')}}</th>
                                        <th>{{__('admin/public.f_name')}}</th>
                                        <th>{{__('admin/public.sh_number')}}</th>
                                        <th>{{__('admin/public.meli_number')}}</th>
                                        <th>{{__('admin/public.sh_sodor')}}</th>
                                        <th>{{__('admin/public.tavalod_date')}}</th>
                                        <th>{{__('admin/public.phone_1')}}</th>
                                        <th>{{__('admin/public.phone_2')}}</th>
                                        <th>{{__('admin/public.phone_f')}}</th>
                                        <th>{{__('admin/public.phone_m')}}</th>
                                        <th>{{__('admin/public.tel')}}</th>
                                        <th>{{__('admin/public.city')}}</th>
                                        <th>{{__('admin/public.province')}}</th>
                                        <th>{{__('admin/public.address')}}</th>
                                        <th>{{__('admin/public.post_number')}}</th>
                                        <th>{{__('admin/public.education')}}</th>
                                        <th>{{__('admin/public.job')}}</th>
                                        <th>{{__('admin/public.email')}}</th>
                                        <th>{{__('admin/public.number_of_children')}}</th>

                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection