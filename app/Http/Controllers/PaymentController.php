<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
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
    public function payZarinpalCallback(Request $request)
    {

        //dd($request->Authority);
        $payment=Payment::where('authority','=',$request->Authority)->first();
        if(isset($payment->id))
        {
            $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX';
            $Amount = $payment->price; //Amount will be based on Toman
            $Authority = $request->Authority;

            if ($request->Status == 'OK') {

                $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

                $result = $client->PaymentVerification(
                    [
                        'MerchantID' => $MerchantID,
                        'Authority' => $Authority,
                        'Amount' => $Amount,
                    ]
                );

                if ($result->Status == 100) {
                    //echo 'Transaction success. RefID:'.$result->RefID;
                    $payment->update([
                        'refId'=>$result->RefID,
//                        'extraDetail'=>$result->ExtraDetail,
                        'status'=>'5',
                    ]);
                    User::where('id','=',$payment->user_id)->update([
                       'status'=>'4',
                    ]);
                    alert()->success(__('web/messages.success_payment'), __('web/messages.success'))->persistent(__('web/messages.success'));
                    return redirect()->route('login');
                } else {
                    //echo 'Transaction failed. Status:'.$result->Status;
                    $payment->update([
                        'status'=>'4',
                    ]);
                    alert()->error(__('web/messages.error_payment_72'))->persistent(__('web/messages.success'));
                    return redirect()->route('login');
                }
            } else {



                //echo 'Transaction canceled by user';
                $payment->update([
                    'status'=>'3',
                ]);
                alert()->error(__('web/messages.error_payment_cancel_by_user'))->persistent(__('web/messages.success'));
                return redirect()->route('login');
            }


        }else{
            //رکورد وجود ندارد
            alert()->error(__('web/messages.not_exist'))->persistent(__('web/messages.success'));
            return redirect()->route('login');

        }
    }

}