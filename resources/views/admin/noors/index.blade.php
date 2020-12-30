@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>{{__('admin/public.noors_list')}}</h2>
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
                            <h2>{{__('admin/public.noors_list')}}</h2>
                        </div>
                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>{{__('admin/public.noor_id')}}</th>
                                        <th>{{__('admin/public.created_at')}}</th>
                                        <th>{{__('admin/public.level')}}</th>
                                        <th>{{__('admin/public.noor_type')}}</th>
                                        <th>{{__('admin/public.mobile')}}</th>
                                        <th>{{__('admin/public.noor_description')}}</th>
                                        <th>{{__('admin/public.price')}}({{__('web/public.currency_name_IRR')}})</th>
                                        <th>{{__('admin/public.sex')}}</th>
                                        <th>{{__('admin/public.name')}}</th>
                                        <th>{{__('admin/public.family')}}</th>
                                        <th>{{__('admin/public.f_name')}}</th>
                                        <th>{{__('admin/public.meli_number')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($noors as $item)
                                        <tr class="gradeA">
                                            <td>{{$item->id}}</td>
                                            <td>{{\App\Providers\MyProvider::show_date($item->created_at,'Y-n-j')}}</td>
                                            <th>{{__('admin/public.noor_status_level_'.$item->status)}}</th>
                                            <td>{{$item->type}}</td>
                                            <td>{{$item->mobile}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>{{number_format($item->price)}}</td>
                                            <td>{{__('admin/public.'.$item->sex)}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->family}}</td>
                                            <td>{{$item->f_name}}</td>
                                            <td>{{$item->meli_number}}</td>
                                        </tr>
                                    @endforeach



                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{__('admin/public.noor_id')}}</th>
                                        <th>{{__('admin/public.created_at')}}</th>
                                        <th>{{__('admin/public.level')}}</th>
                                        <th>{{__('admin/public.noor_type')}}</th>
                                        <th>{{__('admin/public.mobile')}}</th>
                                        <th>{{__('admin/public.noor_description')}}</th>
                                        <th>{{__('admin/public.price')}}({{__('web/public.currency_name_IRR')}})</th>
                                        <th>{{__('admin/public.sex')}}</th>
                                        <th>{{__('admin/public.name')}}</th>
                                        <th>{{__('admin/public.family')}}</th>
                                        <th>{{__('admin/public.f_name')}}</th>
                                        <th>{{__('admin/public.meli_number')}}</th>

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