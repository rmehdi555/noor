@extends('student.master')
@section('content')



    <!-- Start: Inner main -->
    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
                        @foreach($studentFields as $item)
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

        </div>
    </section>
    <!-- Start: Inner main -->





@endsection


