@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            {{--<div class="block-header">--}}
            {{--<div class="row">--}}
            {{--<div class="col-lg-5 col-md-8 col-sm-12">--}}
            {{--<h2>Jquery Datatable</h2>--}}
            {{--</div>--}}
            {{--<div class="col-lg-7 col-md-4 col-sm-12 text-right">--}}
            {{--<ul class="breadcrumb justify-content-end">--}}
            {{--<li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}


            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>{{__('admin/public.edit')}}</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('menus.update',$menu->id) }}" method="POST"
                                  enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PATCH')
                                @include('admin.section.errors')
                                <?php
                                $allLang = \App\Providers\MyProvider::get_languages();
                                foreach ($allLang as $kay => $value)
                                {
                                ?>
                                <div class="form-group">
                                    <label>{{__('admin/public.title')}} ({{$kay}}):</label>
                                    <input type="text" name="title_{{$kay}}" class="form-control"
                                           value="{{\App\Providers\MyProvider::_text($menu->title,$kay)}}" required>
                                </div>
                                <?php
                                }
                                ?>
                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.menu_categories_id')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="menu_categories_id"
                                                class="multiselect multiselect-custom">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{($menu->menu_categories_id==$category->id)?"selected":""}}>{{\App\Providers\MyProvider::_text($category->title)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.parent_id')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="parent_id"
                                                class="multiselect multiselect-custom">
                                            <option value="0">{{__('admin/public.base_parent_id')}}</option>
                                            @foreach($menus as $value)
                                                <option value="{{$value->id}}" {{($menu->parent_id==$value->id)?"selected":""}}>{{\App\Providers\MyProvider::_text($value->title)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('admin/public.link')}} :</label>
                                    <input type="text" name="link" class="form-control" value="{{$menu->link}}" required>
                                </div>

                                <div class="form-group">
                                    <label>{{__('admin/public.priority')}} :</label>
                                    <input type="number" name="priority" class="form-control"
                                           value="{{$menu->priority}}" required>
                                </div>

                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.status')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="status"
                                                class="multiselect multiselect-custom">
                                            <option value="0">{{__('admin/public.inactive')}}</option>
                                            <option value="1" {{$menu->status?"selected":""}}>{{__('admin/public.active')}}</option>
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