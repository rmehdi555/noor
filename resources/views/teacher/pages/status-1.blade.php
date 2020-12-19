@extends('teacher.master')
@section('content')

    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">
                        <p class="p-1 text-justify">معلم گرامی
                            {{$user->teacher->name}}  {{$user->teacher->family}}
                 مدارک مورد نیاز در ذیل را بارگذاری نمایید .
                        </p>
                        <p>
                            یادسپاری: بارگذاری سوابق و مدارک قرآنی و نیز مدرک تحصیلی، در مصاحبه و فرایند گزینش حائذ اهمیت می باشد.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bu-inner-main">
        <div class="container">
            <form class="form-horizontal" id="form-level-1-save" method="POST"
                  action="{{ route('teacher.level.1.save') }}" enctype="multipart/form-data">
                @csrf
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="row">
                <div class="col-md-6 padding-top-15">
                    <label class="col-md-6 col-sm-6 control-label"
                           for="meli_image">{{__('web/public.meli_image')}} : <span
                                class="required">*</span> </label>
                    <div class="col-md-12 col-sm-10">
                        <div class="custom-file ">
                            <input type="file" class="custom-file-input " id="customFile" name="meli_image" required>
                            <label class="custom-file-label text-align-left" for="customFile"></label>
                        </div>
                        @error('meli_image')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="sh_1_image">{{__('web/public.sh_1_image')}} : <span
                                    class="required">*</span> </label>
                        <div class="col-md-12 col-sm-10">
                            <div class="custom-file ">
                                <input type="file" class="custom-file-input " id="customFile" name="sh_1_image" required>
                                <label class="custom-file-label text-align-left" for="customFile"></label>
                            </div>
                            @error('sh_1_image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="sh_2_image">{{__('web/public.sh_2_image')}} : <span
                                    class="required">*</span></label>
                        <div class="col-md-12 col-sm-10">
                            <div class="custom-file ">
                                <input type="file" class="custom-file-input" id="customFile" name="sh_2_image" required>
                                <label class="custom-file-label" for="customFile"></label>
                            </div>
                            @error('sh_2_image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-9 col-sm-9 control-label"
                               for="p_image">{{__('web/public.p_image')}}  : </label>
                        <div class="col-md-12 col-sm-10">
                            <div class="custom-file ">
                                <input type="file" class="custom-file-input " id="customFile" name="p_image" >
                                <label class="custom-file-label text-align-left" for="customFile"></label>
                            </div>
                            @error('p_image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 padding-top-15">
                        <label class="col-md-6 col-sm-6 control-label"
                               for="m_image">{{__('web/public.m_image')}} : </label>
                        <div class="col-md-12 col-sm-10">
                            <div class="custom-file ">
                                <input type="file" class="custom-file-input" id="customFile" name="m_image" >
                                <label class="custom-file-label" for="customFile"></label>
                            </div>
                            @error('m_image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <br><br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center mb-2 ">
                            <div class="p-2 contract-div-hide">
                                <button type="submit"
                                        class="btn btn-primary">{{__('web/public.btn_upload')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </section>






@endsection


