@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>{{__('admin/public.students_list')}}</h2>
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
                            <h2>{{__('admin/public.students_list')}}</h2>
                        </div>
                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>{{__('admin/public.actions')}}</th>
                                        <th>{{__('admin/public.student_id')}}</th>
                                        <th>{{__('admin/public.created_at')}}</th>
                                        <th>{{__('admin/public.level')}}</th>
                                        <th>{{__('admin/public.class_type')}}</th>
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
                                    @foreach($students as $item)
                                        <tr class="gradeA">
                                            <td class="actions">

                                                {{--<form action="{{ route('students.destroy', $item->id) }}" method="POST">--}}
                                                {{--@csrf--}}
                                                {{--@method('DELETE')--}}
                                                <a href="{{ route('students.show',$item->id) }}" class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-show"
                                                   data-toggle="tooltip" data-original-title="{{__('admin/public.show')}}"><i class="icon-eye" aria-hidden="true"></i></a>
                                                <a href="{{ route('students.edit',$item->id) }}" class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                                data-toggle="tooltip" data-original-title="{{__('admin/public.edit')}}"><i class="icon-pencil" aria-hidden="true"></i></a>
                                                {{--<button type="submit" class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"--}}
                                                {{--data-toggle="tooltip" data-original-title="{{__('admin/public.remove')}}"><i class="icon-trash" aria-hidden="true"></i></button>--}}
                                                {{--</form>--}}

                                            </td>
                                            <td>{{$item->student_id}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'Y-n-j')}}</td>
                                            <th>{{__('admin/public.student_status_level_'.$item->user->status)}}</th>
                                            <td>{{$item->class_type}}</td>
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
                                            <td>{{$item->studentsProvince->name}}</td>
                                            <td>{{$item->studentsCity->name}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->post_number }}</td>
                                            <td>{{$item->education }}</td>
                                            <td>{{$item->job }}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->number_of_children }}</td>

                                        </tr>
                                    @endforeach



                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{__('admin/public.student_id')}}</th>
                                        <th>{{__('admin/public.created_at')}}</th>
                                        <th>{{__('admin/public.level')}}</th>
                                        <th>{{__('admin/public.class_type')}}</th>
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
                                        <th>{{__('admin/public.actions')}}</th>
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