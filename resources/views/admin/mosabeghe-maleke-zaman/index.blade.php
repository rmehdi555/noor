@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>{{__('admin/public.mosabeghe_maleke_zaman_list')}}</h2>
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
                            <h2>{{__('admin/public.mosabeghe_maleke_zaman_list')}}</h2>
                        </div>
                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>{{__('admin/public.id')}}</th>
                                        <th>{{__('admin/public.created_at')}}</th>
                                        <th>{{__('admin/public.type')}}</th>
                                        <th>{{__('admin/public.name')}}</th>
                                        <th>{{__('admin/public.family')}}</th>
                                        <th>{{__('admin/public.f_name')}}</th>
                                        <th>{{__('admin/public.meli_number')}}</th>
                                        <th>{{__('admin/public.phone')}}</th>
                                        <th>{{__('admin/public.province')}}</th>
                                        <th>{{__('admin/public.city')}}</th>
                                        <th>{{__('admin/public.address')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fields as $item)
                                        <tr class="gradeA">
                                            <td>{{$item->id}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'Y-n-j')}}</td>
                                            <th>{!! $item->type !!}</th>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->family}}</td>
                                            <td>{{$item->f_name}}</td>
                                            <td>{{$item->meli_number}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td>{{$item->Province->name}}</td>
                                            <td>{{$item->City->name}}</td>
                                            <td>{{$item->address}}</td>

                                        </tr>
                                    @endforeach



                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{__('admin/public.id')}}</th>
                                        <th>{{__('admin/public.created_at')}}</th>
                                        <th>{{__('admin/public.type')}}</th>
                                        <th>{{__('admin/public.name')}}</th>
                                        <th>{{__('admin/public.family')}}</th>
                                        <th>{{__('admin/public.f_name')}}</th>
                                        <th>{{__('admin/public.meli_number')}}</th>
                                        <th>{{__('admin/public.phone')}}</th>
                                        <th>{{__('admin/public.province')}}</th>
                                        <th>{{__('admin/public.city')}}</th>
                                        <th>{{__('admin/public.address')}}</th>
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