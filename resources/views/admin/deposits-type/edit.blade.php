@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">




            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>{{__('admin/public.edit')}}</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('depositsType.update',$depositsType->id) }}" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PATCH')
                                @include('admin.section.errors')
                                <div class="form-group">
                                    <label>{{__('admin/public.title')}} :</label>
                                    <input type="text" name="title" class="form-control" value="{{\App\Providers\MyProvider::_text($depositsType->title)}}" required>
                                </div>

                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.type')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="type" class="multiselect multiselect-custom" >
                                            <option value="amount">مبلغ توسط ادمین مشخص میشود</option>
                                            <option value="noamount" {{($depositsType->type=="noamount")?"selected":""}}>مبلغ توسط کاربر مشخص میشود</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4 col-md-12">
                                    <label>نوع کاربر :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="user_type" class="multiselect multiselect-custom" >
                                            <option value="student">برای قرآن آموزان</option>
                                            <option value="teacher" {{($depositsType->user_type=="teacher")?"selected":""}}>برای معلم القرآن ها</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('admin/public.price')}}  ریال   :</label>
                                    <input type="text" name="price" class="form-control" value="{{$depositsType->price}}" required>
                                </div>



                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.status')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="status" class="multiselect multiselect-custom" >
                                            <option value="0">{{__('admin/public.inactive')}}</option>
                                            <option value="1" {{$depositsType->status?"selected":""}}>{{__('admin/public.active')}}</option>
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