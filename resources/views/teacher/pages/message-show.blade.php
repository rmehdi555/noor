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
                            عنوان پیام :
                            {{$message->title}}
                        </h5>
                        <div class="row">

                            <div class="mesgs">
                                <div class="msg_history">
                                    @foreach($message->messagesDetails as $item)
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






                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


