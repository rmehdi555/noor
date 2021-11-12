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
                            <form id="basic-form" action="{{ route('meeting.update',$meeting->id) }}" method="POST"
                                  enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PATCH')
                                @include('admin.section.errors')
                                <h5>تنها میتوانید اطلاعات گزارش را ببینید و درصورت نیاز به تغییر متن یا افراد ارسال کننده ابتدا این جلسه را غیر فعال کنید و مجدد جلسه جدید ایجاد کنید .</h5>
                                <div class="form-group col-lg-8 col-md-12">
                                    <label>افرادی که متن جلسه را برای آنها ارسال کرده اید :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="resivered[]" multiple class="multiselect multiselect-custom" >
                                            @foreach($meeting->meetingAccess() as $item)
                                                <option value="{{$item->userReciver->id}}">{{$item->userReciver->name}} {{$item->userReciver->family}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <?php
                                $allLang = \App\Providers\MyProvider::get_languages();
                                foreach ($allLang as $kay => $value)
                                {
                                ?>
                                <div class="form-group">
                                    <label>{{__('admin/public.title')}} ({{$kay}}):</label>
                                    <input type="text" name="title_{{$kay}}" class="form-control"
                                           value="{{\App\Providers\MyProvider::_text($meeting->title,$kay)}}" required>
                                </div>
                                <?php
                                }
                                ?>

                                <div class="form-group">
                                    <label>متن جلسه :</label>
                                    <textarea name="description" id="description" class="form-control" rows="5" cols="30" required>{{$meeting->description}}</textarea>

                                </div>


<!---->
                                {{--<div class="form-group">--}}
                                    {{--<label>فایل :</label>--}}
                                    {{--<input type="file" name="file" class="form-control" value="" >--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <td>  <a href="{{asset($meeting->file_url)}}" target="_blank">جهت مشاهده فایل  قبلی اینجا کلیک کنید</a></td>
                                </div>


                                <div class="form-group col-lg-4 col-md-12">
                                    <label>{{__('admin/public.status')}} :</label>
                                    <div class="multiselect_div">
                                        <select id="single-selection" name="status"
                                                class="multiselect multiselect-custom">
                                            <option value="0">{{__('admin/public.inactive')}}</option>
                                            <option value="1" {{$meeting->status?"selected":""}}>{{__('admin/public.active')}}</option>
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