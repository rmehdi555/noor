@extends('admin.master')
@section('content')
    <div id="main-content">
        <div class="container-fluid">



            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>ایجاد جلسه</h2>
                        </div>
                        <div class="body">
                            <form id="basic-form" action="{{ route('meeting.store') }}" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                @include('admin.section.errors')
                                <div class="form-group col-lg-8 col-md-12">
                                    <label>افرادی که بتوانند متن جلسه را ببیند را انتخاب نمایید :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="resivered[]" multiple class="multiselect multiselect-custom" >
                                            <option value="0">ارسال به همه</option>
                                            @foreach($reciversTeacher as $techer)
                                                <option value="{{$techer->id}}">{{$techer->name}} {{$techer->family}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>


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
                                    <label>متن جلسه :</label>
                                    <textarea name="description" id="description" class="form-control" rows="5" cols="30" required>{{old('description')}}</textarea>

                                </div>

                                <div class="form-group">
                                    <label>فایل :</label>
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