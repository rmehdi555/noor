<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Payment;
use App\Students;
use App\StudentsFields;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoapClient;

/*
 * status=0ثبت نام اولیه
 * status=1ایجاد فاکتور و ارسال به درگاه پرداخت
 * status=2درخواست بررسی نهاد برای پرداخت نکردن
 * status=3تایید گرداخت نکردن
 * status=4بارگذاری مدارک
 * status=10 تایید نهایی
 */
class PanelController extends Controller
{
    public function index(Request $request)
    {
        $user=Auth::user();
        //dd($user->student->studentsFields);
        switch (Auth::user()->status)
        {
            case 0:
                $this->createPayment();
                return view('user.pages.panel');
                break;
            case 1:

                $payment=Payment::where('user_id','=',$user->id)->first();
                $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
                $Amount = $payment->price; //Amount will be based on Toman - Required
                $Description = 'توضیحات تراکنش تستی'; // Required
                $Email = $user->email; // Optional
                $Mobile = $user->phone; // Optional
                $CallbackURL = $payment->callbackURL; // Required


                $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

                $result = $client->PaymentRequest(
                    [
                        'MerchantID' => $MerchantID,
                        'Amount' => $Amount,
                        'Description' => $Description,
                        'Email' => $Email,
                        'Mobile' => $Mobile,
                        'CallbackURL' => $CallbackURL,
                    ]
                );
                dd($result);
//Redirect to URL You can do it also by creating a form
                if ($result->Status == 100) {
                    Header('Location: https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
                } else {
                    echo'ERR: '.$result->Status;
                }


                if ($result->Status == 100) {
                    Header('Location: https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
                } else {
                    echo 'ERR: ' . $result->Status;
                }
                //dd($payment);
                return view('user.pages.panel');
                break;
            default:
                return view('user.pages.panel');
                break;
        }

    }

    public function createPayment()
    {
        $user=Auth::user();
        $allPrice=0;
        foreach ($user->student->studentsFields as $field)
        {
            $allPrice+=$field->price;
        }
        Payment::create([
            'price' => $allPrice,
            'description' => '',
            'user_id' => $user->id,
            'user_type' => $user->level,
            'user_code' => $user->student->student_id,
            'email' => $user->email,
            'mobile' => $user->phone,
            'callbackURL'=>route('web.payment.online.zarinpal.callback'),
            'status'=>'1'
        ]);
        $user->update([
            'status'=> '1',
        ]);
    }
}
