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
                            <form id="basic-form" action="{{ route('slider.update',$slider->id) }}" method="post" enctype="multipart/form-data" novalidate>
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
                                    <input type="text" name="title_{{$kay}}" class="form-control" value="{{\App\Providers\MyProvider::_text($slider->title,$kay)}}" required>
                                </div>
                                <?php
                                }
                                ?>

                                <div class="form-group">
                                    <label>{{__('admin/public.images')}} :</label>
                                    <input type="file" name="images" class="form-control" value="{{old('images')}}" >
                                </div>
                                <div class="media">
                                    <img class="media-object " src="{{$slider->images["thumb"]}}" alt="">
                                    {{--<div class="media-body">--}}
                                    {{--<span class="name">Joge Lucky</span>--}}
                                    {{--<span class="message">Sales Lead</span>--}}
                                    {{--<span class="badge badge-outline status"></span>--}}
                                    {{--</div>--}}
                                </div>
                                <div class="form-group">
                                    <label>{{__('admin/public.link')}} :</label>
                                    <input type="text" name="link" class="form-control" value="{{$slider->link}}" required>
                                </div>
                                <div class="form-group">
                                    <label>{{__('admin/public.type')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="type" class="multiselect multiselect-custom" >
                                            <option value="index">{{__('admin/public.index')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('admin/public.priority')}} :</label>
                                    <input type="number" name="priority" class="form-control" value="{{$slider->priority}}" required>
                                </div>




                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.status')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="status" class="multiselect multiselect-custom" >
                                            <option value="0">{{__('admin/public.inactive')}}</option>
                                            <option value="1" {{$slider->status?"selected":""}}>{{__('admin/public.active')}}</option>
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