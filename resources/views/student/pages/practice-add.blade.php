@extends('student.master')
@section('content')


    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bu-inner-main-form">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif




                            <form class="form-horizontal" method="POST" action="{{ route('student.practice.save') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label"
                                               for="province">ابتدا کلاس خود را که میخواهید فعالیت آن را ثبت نمایید انتخاب کنید : <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-6">

                                            <select class=" form-control js-example-basic-single" name="class_room_student_id">
                                                @foreach ($classActive as $item)
                                                    <option value="{{$item->id}}">{{$item->classRoms->name}} : {{$item->teacher->name}} {{$item->teacher->family}} </option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-12 col-sm-6 control-label"
                                               for="province">عنوان فعالیت: <span
                                                    class="required">*</span></label>
                                        <div class="col-md-12 col-sm-6">
                                            <input type="text" name="title" id="title" value="{{old('title')}}"
                                                   class="form-control  @error('title') is-invalid @enderror" required/>
                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror

                                        </div>

                                    </div>

                                    <div class="col-md-6 padding-top-15">
                                        <label class="col-md-6 col-sm-6 control-label"
                                               for="meli_image">فایل : </label>
                                        <div class="col-md-12 col-sm-10">
                                            <div class="custom-file ">
                                                <input type="file" class="custom-file-input " id="file" name="file">
                                                <label class="custom-file-label text-align-left" for="customFile"></label>
                                            </div>
                                            <span ><strong>تنها فایل : jpg,jpeg,png,pdf قابل بارگذاری میباشد</strong></span>
                                            @error('file')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>



                                </div>
                                <div class="row">

                                    <label class="col-md-12 col-sm-6 control-label"
                                           for="province">متن فعالیت: <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-6">
                                        <textarea name="description" rows="10" id="input-enquiry" class="form-control  @error('description') is-invalid @enderror"></textarea>

                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 padding-top-15">

                                        <label class=" control-label"
                                               for="input-name"><br></label>
                                        <div class="buttons">
                                            <div class="pull-right">
                                                <input type="submit" class="btn btn-primary"
                                                       value="ثبت فعالیت">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </form>


                            <br><br>
                            <hr>





                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


