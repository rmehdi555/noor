<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoapClient;

/*
 * 1- جدید
 * 2- ارسال برای پرداخت
 * 3-کنسل شدن توسط کاربر
 * 4-خطای وریفای و بازگشت تا 72 ساعت
 * 5- تایید نهایی
 */
class PaymentController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        //dd($user->teacher->teachersFields);
        $payment=Payment::where('user_id','=',$user->id)->orderBy('id','DESC')->first();
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
        if ($result->Status == 100) {
            $payment->update([
                'authority'=>$result->Authority,
                'status'=>'2',
            ]);
            Header('Location: https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
            exit;
        } else {
            alert()->error(__('web/messages.error_connect_bank'),__('web/messages.success'));
            return redirect()->route('teacher.panel');
        }
    }
}
