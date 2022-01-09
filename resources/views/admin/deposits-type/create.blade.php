@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>{{__('admin/public.create')}}</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('depositsType.store') }}" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                @include('admin.section.errors')
                                <div class="form-group">
                                    <label>{{__('admin/public.title')}} :</label>
                                    <input type="text" name="title" class="form-control" value="{{old('title')}}" required>
                                </div>

                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.type')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="type" class="multiselect multiselect-custom" >
                                            <option value="amount">مبلغ توسط ادمین مشخص میشود</option>
                                            <option value="noamount">مبلغ توسط کاربر مشخص میشود</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <label>نوع کاربر :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="user_type" class="multiselect multiselect-custom" >
                                            <option value="student">برای قرآن آموزان</option>
                                            <option value="teacher">برای معلم القرآن ها</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('admin/public.price')}}  ریال   :</label>
                                    <input type="text" name="price" class="form-control" value="0" required>
                                </div>



                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.status')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="status" class="multiselect multiselect-custom" >
                                            <option value="1">{{__('admin/public.active')}}</option>
                                            <option value="0">{{__('admin/public.inactive')}}</option>
                                        </select>
                                    </div>
                                </div>


                                <br>
                                <button type="submit" class="btn btn-primary">{{__('admin/public.submit')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection