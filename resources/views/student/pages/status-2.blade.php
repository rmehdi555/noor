@extends('student.master')
@section('content')

    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">
                        <p class="p-1 text-justify">قرآن آموز گرامی
                            {{$user->student->name}}  {{$user->student->family}}
                            درخواست شما جهت بررسی عضو نهاد خاص بودن به درستی ارسال گردیده و حداکثر پس از دو روز کاری درخواست شما توسط کارشناسان بررسی و پاسخ برای ادامه فرایند ثبت نام در همین پنل کاربری بارگذاری خواهد شد
                            در صورت عدم دریافت پاسخ پس از دو روز کاری میتوانید از قسمت ارتباط با ما با ما تماس حاصل فرمایید
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


