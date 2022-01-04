@extends('teacher.master')
@section('content')
    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-primary m-1">
                        اطلاعات کارت بانکی خود را جهت واریزی های حق تدریس با دقت وارد نمایید.
                        <br>
                        شماره کارت و شماره شبا اختیاری میباشد و در وارد کردن شماره حساب دقت لازم را داشته باشین زیرا قابل ویرایش نمیباشد .
                        <br>
                        حتما شماره حساب بانک ملی وارد نمایید .
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bu-inner-main-form">
                        <br>



                        <form class="form-horizontal" method="POST" action="{{ route('teacher.card.number.bank.create.save') }}">
                            @csrf
                            <div class="row">
                                {{--<div class="col-md-6 padding-top-15">--}}
                                    {{--<label class="col-md-12 col-sm-6 control-label" for="name">نام بانک : <span class="required">*</span>--}}
                                    {{--</label>--}}
                                    {{--<div class="col-md-12 col-sm-6">--}}
                                        {{--<input type="text" name="bank_name" id="bank_name" placeholder="ملی"  class=" form-control" required/>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="description">شماره حساب : ( بدون فاصله یا خط تیره بنویسید) <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="text" name="hesab_number" id="hesab_number" placeholder="03658965412025" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="description">شماره کارت : ( بدون فاصله یا خط تیره بنویسید)
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="text" name="card_number" id="card_number" placeholder="6037997267595555" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="name">نام و نام خانوادگی صاحب کارت : <span class="required">*</span>
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="text" name="name" id="name" value="{{$user->name}} {{$user->family}}"  class=" form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-6 padding-top-15">
                                    <label class="col-md-12 col-sm-6 control-label" for="description">شماره شبا: ( بدون فاصله یا خط تیره بنویسید)
                                    </label>
                                    <div class="col-md-12 col-sm-6">
                                        <input type="text" name="sheba_number" id="sheba_number" placeholder="IR00001250022255120000" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 padding-top-15">

                                    <label class=" control-label"
                                           for="input-name"><br></label>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <input type="submit" class="btn btn-primary"
                                                   value="ثبت شماره کارت">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>




                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


