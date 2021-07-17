@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">




            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>{{__('admin/public.show')}}</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('specialization.update',$specialization->id) }}" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PATCH')
                                @include('admin.section.errors')
                                <?php
                                $allLang=\App\Providers\MyProvider::get_languages();
                                foreach ($allLang as $kay => $value)
                                {
                                ?>
                                <div class="form-group">
                                    <label>{{__('admin/public.title')}} ({{$kay}}):</label>
                                    <input type="text" name="title_{{$kay}}" class="form-control" value="{{\App\Providers\MyProvider::_text($specialization->title,$kay)}}" required>
                                </div>
                                <?php
                                }
                                $allLang=\App\Providers\MyProvider::get_languages();
                                foreach ($allLang as $kay => $value)
                                {
                                ?>
                                <div class="form-group">
                                    <label>{{__('admin/public.description')}} ({{$kay}}):</label>
                                    <textarea name="description_{{$kay}}" id="description_{{$kay}}" class="form-control" rows="5" cols="30" required>{{\App\Providers\MyProvider::_text($specialization->description,$kay)}}</textarea>

                                </div>
                                <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label>{{__('admin/public.priority')}} :</label>
                                    <input type="number" name="priority" class="form-control" value="{{$specialization->priority}}" required>
                                </div>
                                <div class="form-group">
                                    <label>{{__('admin/public.price')}} ({{__('admin/public.IRR')}}) :</label>
                                    <input type="number" name="price" class="form-control" value="{{$specialization->price}}"
                                           required>
                                </div>




                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.status')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="status" class="multiselect multiselect-custom" >
                                            <option value="0">{{__('admin/public.inactive')}}</option>
                                            <option value="1" {{$specialization->status?"selected":""}}>{{__('admin/public.active')}}</option>
                                        </select>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection