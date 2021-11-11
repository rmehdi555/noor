@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>ایجاد شیوه نامه جدید</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('methodOfLetter.store') }}" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                @include('admin.section.errors')
                                <?php
                                $allLang=\App\Providers\MyProvider::get_languages();
                                foreach ($allLang as $kay => $value)
                                {
                                ?>
                                <div class="form-group">
                                    <label>{{__('admin/public.title')}} ({{$kay}}):</label>
                                    <input type="text" name="title_{{$kay}}" class="form-control" value="{{old('title_'.$kay)}}" required>
                                </div>
                                <?php
                                }
                                ?>

                                <div class="form-group">
                                    <label>فایل شیوه نامه :</label>
                                    <input type="file" name="file" class="form-control" value="" required>
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