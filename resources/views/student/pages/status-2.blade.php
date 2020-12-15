@extends('student.master')
@section('content')

    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">
                        <p class="p-1 text-justify">کاربر گرامی
                            {{$user->student->name}}  {{$user->student->family}}
                  درخواست شما جهت بررسی عضو نهاد خاص بودن به درستی ارسال گردید ، پس از بررسی توسط کارشناسان ما جواب را در همین پنل کاربری ارائه میدهد .
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


