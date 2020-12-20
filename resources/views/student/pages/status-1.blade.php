@extends('student.master')
@section('content')

    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">
                        <p class="p-1 text-justify">قرآن آموز گرامی
                            {{$user->student->name}}  {{$user->student->family}}
                            احراز هویت شماره همراه شما به درستی انجام شده و برای ادامه ثبت نام لیست رشته های انتخابی را
                            مشاهده و پرداخت نمایید .
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success m-1">
                        <p class="p-1 text-justify"> درصورت عضو نهاد خاص بودن هزینه دوره ها با تخفیف درنظر گرفته خواهد شد
                            ، که لازم است تیک گزینه عضو نهاد های خاص را کلیک نموده و مدرک مورد نظر را بارگذاری نمایید
                            تا توسط کارشناس های ما بررسی و نتیجه را اعلام نماییند.

                        <br>
                            نهاد هایی که شامل تخفیف خواهند شد :
                         <br>
                            - تحت پوشش کمیته امداد امام خمینی
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">

            <div class="row">
                <p class="bu-margin-bottom-30">{{__('web/public.student_field_select')}} : </p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('web/public.title_field')}}</th>
                            <th>{{__('web/public.price')}}({{__('web/public.currency_name_IRR')}})</th>
                            {{--<th>{{__('web/public.setting')}}</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; $finalPrice=0;@endphp
                        @foreach($user->student->studentsFields as $item)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{number_format($item->price)}}</td>
                                {{--<td><a class="btn btn-danger btn-sm"--}}
                                {{--href="{{ route('web.students.field.delete',$item->id) }}">{{__('web/public.delete')}}</a>--}}
                                {{--</td>--}}
                            </tr>
                            @php $i++; $finalPrice+=$item->price; @endphp
                        @endforeach
                        <tr class="table-primary">
                            <td colspan='2'>{{__('web/public.price_final')}}
                                ({{__('web/public.currency_name_IRR')}}) :
                            </td>
                            <td colspan='2'>{{number_format($finalPrice)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                <br><br>

            <form class="form-horizontal" id="form-level-1-save" method="POST"
                  action="{{ route('student.level.1.save') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-form__two">
                            <input id="contract-checkbox"
                                   type="checkbox">عضو نهاد های خاص هستم
                        </div>
                        <div class="comment-submit-btn text-center contract-button">
                            <div class="custom-file mb-3 col-6">
                                <input type="file" class="custom-file-input" id="customFile" name="filename" required>
                                <label class="custom-file-label" for="customFile">مدرک عضو نهاد را بارگذاری نمایید</label>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('web/public.submit')}}</button>
                        </div>
                    </div>
                </div>
            </form>
                <br><br>

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center mb-2 ">
                            <div class="p-2 contract-div-hide">
                                <a href="{{ route('student.payment.index') }}"
                                        class="btn btn-primary">{{__('web/public.btn_payment')}}</a>
                            </div>
                        </div>
                    </div>
                </div>





        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


