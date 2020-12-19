@extends('teacher.master')
@section('content')

    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info m-1">
                        <p class="p-1 text-justify">معلم گرامی
                            {{$user->teacher->name}}  {{$user->teacher->family}}
                            هزینه ثبت نام در ذیل ذکر شده است ، بعد از پرداخت آن ثبت نام شما نهایی خواهد شد .
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
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>هزینه ثبت نام</th>
                            <th>{{\App\Providers\MyProvider::_text($siteDetailsProvider["price_register_m"]->value)}}({{__('web/public.currency_name_IRR')}})</th>
                            {{--<th>{{__('web/public.setting')}}</th>--}}
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <br><br>


            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center mb-2 ">
                        <div class="p-2 contract-div-hide">
                            <a href="{{ route('teacher.payment.index') }}"
                               class="btn btn-primary">{{__('web/public.btn_payment')}}</a>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


