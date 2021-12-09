<?php

namespace App\Http\Controllers\Student;

use Adlino\Locations\Facades\locations;
use App\Cities;
use App\Field;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Provinces;
use App\Students;
use App\StudentsDocuments;
use App\StudentsFields;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use niklasravnsborg\LaravelPdf\PdfWrapper;
use SoapClient;

class ClassController extends StudentController
{
    public function list()
    {
        $fields = Field::where('type','=','student')->get();
        $user=Auth::user();
        $studentFields = StudentsFields::where([['user_id', '=',$user->id],['status','>',1]])->orderBy('id','desc')->get();
        return view('student.pages.class-list', compact('fields', 'studentFields'));
    }
    public function register()
    {
        $fields = Field::where('type','=','student')->get();
        $user=Auth::user();
        $studentFields = StudentsFields::where([['user_id', '=',$user->id],['status','=',1]])->orderBy('id')->get();
        return view('student.pages.class-register', compact('fields', 'studentFields'));
    }

    public function registerSave(Request $request)
    {
        $this->createPayment();
        $user=Auth::user();
        $fields = Field::where('type','=','student')->get();
        $studentFields = StudentsFields::where([['user_id', '=',$user->id],['status','=',1]])->orderBy('id')->get();
        return view('student.pages.class-register-show-factor-pay', compact('fields','studentFields'));
    }

    public function createPayment()
    {
        if (config('app.bankPay.active') == 'meli') {
            $url='payment.online.meli.callback.student.class.register';
        }else{
            $url='payment.online.zarinpal.callback.student.class.register';
        }
        $user=Auth::user();
        $studentFields = StudentsFields::where([['user_id', '=',$user->id],['status','=',1]])->orderBy('id')->get();
        $allPrice=0;
        foreach ($studentFields as $field)
        {
            $allPrice+=$field->price;
        }
        if($allPrice<1000)
        {
            $allPrice=1000;
        }
        Payment::where([['status','=','1'],['user_id','=',$user->id]])->delete();
        $payment=Payment::create([
            'price' => $allPrice,
            'description' => '',
            'user_id' => $user->id,
            'user_type' => $user->level,
            'user_code' => $user->student->student_id,
            'email' => $user->email,
            'mobile' => $user->phone,
            'callbackURL'=>route($url),
            'status'=>'1'
        ]);
        foreach ($studentFields as $field)
        {
            $field->update([
                'payment_id'=>$payment->id
            ]);
        }

    }

}
