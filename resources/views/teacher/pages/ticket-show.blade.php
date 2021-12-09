@extends('teacher.master')
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
                        <h5>
                            عنوان تیکت پشتیبانی :
                            {{$ticket->title}}
                        </h5>
                        <div class="row">

                            <div class="mesgs">
                                <div class="msg_history">
                                    @foreach($ticket->ticketsDetails as $item)
                                        @if($item->user_id==$user->id)
                                            <div class="outgoing_msg">
                                                <div class="sent_msg">
                                                    <p><span>{!! $item->description !!}</span></p>
                                                    @if($item->file_url!=null)
                                                        <p>برای مشاهده فایل
                                                        <a href="{{asset($item->file_url)}}" target="_blank">اینجا</a>
                                                        کلیک کنید</p>
                                                        @endif

                                                    <span class="time_date"> {{\App\Providers\MyProvider::show_date($item->created_at,'%B %d، %Y  H:i')}}</span> </div>
                                            </div>
                                            @else
                                            <div class="incoming_msg">
                                                <div class="incoming_msg_img"> <img src="{{asset('web/2020/assets/img/theme/user-profile.png')}}" alt="sunil"> </div>
                                                <div class="received_msg">
                                                    <div class="received_withd_msg">
                                                        <p><span>{!! $item->description !!}</span></p>
                                                        @if($item->file_url!=null)
                                                            <p>برای مشاهده فایل
                                                                <a href="{{asset($item->file_url)}}" target="_blank">اینجا</a>
                                                                کلیک کنید</p>
                                                        @endif
                                                        <span class="time_date"> {{\App\Providers\MyProvider::show_date($item->created_at,'%B %d، %Y  H:i')}}</span></div>
                                                </div>
                                            </div>
                                            @endif

                                    @endforeach

                                </div>

                            </div>


                        </div>

                            <h5>برای پاسخ به تیکت پشتیبانی اطلاعات زیر را وارد نمایید</h5>


                            <form class="form-horizontal" method="POST" action="{{ route('teacher.ticket.save.ans') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">


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
                                           for="province">متن پاسخ: <span
                                                class="required">*</span></label>
                                    <div class="col-md-12 col-sm-6">
                                        <textarea name="description" rows="10" id="input-enquiry" class="form-control  @error('description') is-invalid @enderror"></textarea>

                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" name="ticket_id" value="{{$ticket->id}}">

                                    <div class="col-md-6 padding-top-15">

                                        <label class=" control-label"
                                               for="input-name"><br></label>
                                        <div class="buttons">
                                            <div class="pull-right">
                                                <input type="submit" class="btn btn-primary"
                                                       value="ثبت ادامه / پاسخ تیکت">
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


