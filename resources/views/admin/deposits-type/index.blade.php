@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2>لیست نوع های پرداختی</h2>
                    </div>
                    <div class="col-lg-7 col-md-4 col-sm-12 text-right">
                        {{--<ul class="breadcrumb justify-content-end">--}}
                            {{--<li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>--}}
                        {{--</ul>--}}
                    </div>
                </div>
            </div>


            <a class="btn btn-info" href="{{ route('depositsType.create') }}">ثبت نوع های پرداختی جدید</a>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>لیست نوع های پرداختی</h2>
                        </div>
                        <div class="body">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>کد پرداختی</th>
                                        <th>{{__('admin/public.title')}}</th>
                                        <th>{{__('admin/public.type')}}</th>
                                        <th>{{__('admin/public.price')}} ریال</th>
                                        <th>نوع کاربر</th>
                                        <th>{{__('admin/public.status')}}</th>
                                        <th>{{__('admin/public.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allDepositsType as $item)
                                        <tr class="gradeA">
                                            <td>dti-{{$item->id}}</td>
                                            <td>{{\App\Providers\MyProvider::_text($item->title)}}</td>
                                            <td>@if($item->type=="amount")مبلغ توسط مدیر انتخاب شود@elseمبلغ توسط کاربر انتخاب شود@endif</td>
                                            <td>{{$item->price}}     </td>
                                            <td>@if($item->user_type=="student")برای قرآن آموزان@elseبرای معلم القرآن ها@endif</td>

                                            <td>{{$item->status?__('admin/public.active'):__('admin/public.inactive')}}</td>
                                            <td class="actions">

                                                <form action="{{ route('depositsType.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{--<a href="{{ route('depositsType.show',$item->id) }}" class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-show"--}}
                                                       {{--data-toggle="tooltip" data-original-title="{{__('admin/public.show')}}"><i class="icon-eye" aria-hidden="true"></i></a>--}}
                                                    <a href="{{ route('depositsType.edit',$item->id) }}" class="btn btn-sm btn-icon btn-pure btn-default on-default m-r-5 button-edit"
                                                       data-toggle="tooltip" data-original-title="{{__('admin/public.edit')}}"><i class="icon-pencil" aria-hidden="true"></i></a>
                                                    {{--<button type="submit" class="btn btn-sm btn-icon btn-pure btn-default on-default button-remove"--}}
                                                            {{--data-toggle="tooltip" data-original-title="{{__('admin/public.remove')}}"><i class="icon-trash" aria-hidden="true"></i></button>--}}
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach



                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{__('admin/public.id')}}</th>
                                        <th>{{__('admin/public.title')}}</th>
                                        <th>{{__('admin/public.type')}}</th>
                                        <th>{{__('admin/public.price')}} ریال</th>
                                        <th>{{__('admin/public.status')}}</th>
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