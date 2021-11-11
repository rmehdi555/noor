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
                            <form id="basic-form" action="{{ route('methodOfLetter.update',$methodOfLetter->id) }}" method="POST"
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
                                           value="{{\App\Providers\MyProvider::_text($methodOfLetter->title,$kay)}}" required>
                                </div>
                                <?php
                                }
                                ?>



                                <div class="form-group">
                                    <label>فایل شیوه نامه :</label>
                                    <input type="file" name="file" class="form-control" value="" >
                                </div>
                                <div class="form-group">
                                    <td>  <a href="{{asset($methodOfLetter->file_url)}}" target="_blank">جهت مشاهده فایل شیوه نامه قبلی اینجا کلیک کنید</a></td>
                                </div>


                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.status')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="status"
                                                class="multiselect multiselect-custom">
                                            <option value="0">{{__('admin/public.inactive')}}</option>
                                            <option value="1" {{$methodOfLetter->status?"selected":""}}>{{__('admin/public.active')}}</option>
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