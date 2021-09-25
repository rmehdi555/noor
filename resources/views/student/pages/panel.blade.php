@extends('student.master')
@section('content')


    <section class="bu-inner-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success m-1">
                        <p class="p-1 text-justify">
                            کد قرآن آموزی:
                            {{$user->student->student_id }}
                            <br>
                            تاریخ ایجاد :
                            <span >{{\App\Providers\MyProvider::show_date($user->created_at,'H:i j-n-Y ')}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection