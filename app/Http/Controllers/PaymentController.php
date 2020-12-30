<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Noor;
use App\Payment;
use App\User;
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
    public function payZarinpalCallback(Request $request)
    {

        //dd($request->Authority);
        $payment = Payment::where('authority', '=', $request->Authority)->first();
        if (isset($payment->id)) {
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
                        'refId' => $result->RefID,
//                        'extraDetail'=>$result->ExtraDetail,
                        'status' => '5',
                    ]);
                    User::where('id', '=', $payment->user_id)->update([
                        'status' => '4',
                    ]);
                    alert()->success(__('web/messages.success_payment'), __('web/messages.success'));
                    return redirect()->route('login');
                } else {
                    //echo 'Transaction failed. Status:'.$result->Status;
                    $payment->update([
                        'status' => '4',
                    ]);
                    alert()->error(__('web/messages.error_payment_72'));
                    return redirect()->route('login');
                }
            } else {


                //echo 'Transaction canceled by user';
                $payment->update([
                    'status' => '3',
                ]);
                alert()->error(__('web/messages.error_payment_cancel_by_user'));
                return redirect()->route('login');
            }


        } else {
            //رکورد وجود ندارد
            alert()->error(__('web/messages.not_exist'));
            return redirect()->route('login');

        }
    }


    public function payZarinpalCallbackTeacher(Request $request)
    {

        //dd($request->Authority);
        $payment = Payment::where('authority', '=', $request->Authority)->first();
        if (isset($payment->id)) {
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
                        'refId' => $result->RefID,
//                        'extraDetail'=>$result->ExtraDetail,
                        'status' => '5',
                    ]);
                    User::where('id', '=', $payment->user_id)->update([
                        'status' => '4',
                    ]);
                    alert()->success(__('web/messages.success_payment'), __('web/messages.success'));
                    return redirect()->route('login');
                } else {
                    //echo 'Transaction failed. Status:'.$result->Status;
                    $payment->update([
                        'status' => '4',
                    ]);
                    alert()->error(__('web/messages.error_payment_72'));
                    return redirect()->route('login');
                }
            } else {


                //echo 'Transaction canceled by user';
                $payment->update([
                    'status' => '3',
                ]);
                alert()->error(__('web/messages.error_payment_cancel_by_user'));
                return redirect()->route('login');
            }


        } else {
            //رکورد وجود ندارد
            alert()->error(__('web/messages.not_exist'));
            return redirect()->route('login');

        }
    }


    public function payZarinpalCallbackNoor(Request $request)
    {

        $payment = Payment::where('authority', '=', $request->Authority)->first();
        if (isset($payment->id)) {
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
                        'refId' => $result->RefID,
//                        'extraDetail'=>$result->ExtraDetail,
                        'status' => '5',
                    ]);

                    $noor = Noor::find($payment->user_code);
                    $noor->update([
                        'status' => '4',
                    ]);
                    alert()->success(__('web/messages.success_payment'), __('web/messages.success'));
                    return view('web.pages.noor-level-2-type-all', compact('noor'));
                } else {
                    //echo 'Transaction failed. Status:'.$result->Status;
                    $payment->update([
                        'status' => '4',
                    ]);
                    alert()->error(__('web/messages.error_payment_72'));
                    return view('web.pages.noor-level-1');
                }
            } else {


                //echo 'Transaction canceled by user';
                $payment->update([
                    'status' => '3',
                ]);
                alert()->error(__('web/messages.error_payment_cancel_by_user'));
                return view('web.pages.noor-level-1');
            }


        } else {
            //رکورد وجود ندارد
            alert()->error(__('web/messages.not_exist'));
            return redirect()->route('login');

        }
    }


    public function payMeliCallback(Request $request)
    {
        if(!isset($request->token) or empty($request->token) )
        {
            alert()->error(__('web/messages.error_payment_cancel_by_user'));
            return redirect()->route('login');
        }

        $key = config('app.bankMeli.Key');
        $OrderId = $request->OrderId;
        $Token = $request->token;
        $ResCode = $request->ResCode;
        $payment = Payment::where('Token', '=', $Token)->first();
        if (isset($payment->id)) {
            if ($ResCode == 0) {
                $verifyData = array('Token' => $Token, 'SignData' => $this->encrypt_pkcs7($Token, $key));
                $str_data = json_encode($verifyData);
                $res = $this->CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify', $str_data);
                $arrres = json_decode($res);
            }else{
                alert()->error(__('web/messages.error_payment_cancel_by_user'));
                return redirect()->route('login');
            }
            if ($arrres->ResCode != -1 && $arrres->ResCode == 0) {
                $payment->update([
                    'RetrivalRefNo' => $arrres->RetrivalRefNo,
                    'SystemTraceNo' => $arrres->SystemTraceNo,
                    'status' => '5',
                ]);
                User::where('id', '=', $payment->user_id)->update([
                    'status' => '4',
                ]);
                if(!Auth::check()) {
                    Auth::loginUsingId($payment->user_id);
                }
                alert()->success(__('web/messages.success_payment'), __('web/messages.success'));
                return redirect()->route('login');

            } else
                $payment->update([
                    'status' => '4',
                ]);
            alert()->error(__('web/messages.error_payment_72'));
            return redirect()->route('login');
        } else {
            //رکورد وجود ندارد
            alert()->error(__('web/messages.not_exist'));
            return redirect()->route('login');

        }

    }


    public function payMeliCallbackTeacher(Request $request)
    {
        if(!isset($request->token) or empty($request->token) )
        {
            alert()->error(__('web/messages.error_payment_cancel_by_user'));
            return redirect()->route('login');
        }
        $key = config('app.bankMeli.Key');
        $OrderId = $request->OrderId;
        $Token = $request->token;
        $ResCode = $request->ResCode;
        $payment = Payment::where('Token', '=', $Token)->first();
        if (isset($payment->id)) {
            if ($ResCode == 0) {
                $verifyData = array('Token' => $Token, 'SignData' => $this->encrypt_pkcs7($Token, $key));
                $str_data = json_encode($verifyData);
                $res = $this->CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify', $str_data);
                $arrres = json_decode($res);
            }else{
                alert()->error(__('web/messages.error_payment_cancel_by_user'));
                return redirect()->route('login');
            }
            if ($arrres->ResCode != -1 && $arrres->ResCode == 0) {
                $payment->update([
                    'RetrivalRefNo' => $arrres->RetrivalRefNo,
                    'SystemTraceNo' => $arrres->SystemTraceNo,
                    'status' => '5',
                ]);
                User::where('id', '=', $payment->user_id)->update([
                    'status' => '4',
                ]);
                if(!Auth::check()) {
                    Auth::loginUsingId($payment->user_id);
                }
                $this->send_sms_register_teacher($payment->mobile,$payment->user_code);
                alert()->success(__('web/messages.success_payment'), __('web/messages.success'));
                return redirect()->route('login');

            } else
                $payment->update([
                    'status' => '4',
                ]);
            alert()->error(__('web/messages.error_payment_72'));
            return redirect()->route('login');
        } else {
            //رکورد وجود ندارد
            alert()->error(__('web/messages.not_exist'));
            return redirect()->route('login');

        }

    }


    public function payMeliCallbackNoor(Request $request)
    {

        if(!isset($request->token) or empty($request->token) )
        {
            alert()->error(__('web/messages.error_payment_cancel_by_user'));
            return view('web.pages.noor-level-1');
        }
        $key = config('app.bankMeli.Key');
        $OrderId = $request->OrderId;
        $Token = $request->token;
        $ResCode = $request->ResCode;
        $payment = Payment::where('Token', '=', $Token)->first();
        if (isset($payment->id)) {
            if ($ResCode == 0) {
                $verifyData = array('Token' => $Token, 'SignData' => $this->encrypt_pkcs7($Token, $key));
                $str_data = json_encode($verifyData);
                $res = $this->CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify', $str_data);
                $arrres = json_decode($res);
            }else{
                alert()->error(__('web/messages.error_payment_cancel_by_user'));
                return view('web.pages.noor-level-1');
            }
            if ($arrres->ResCode != -1 && $arrres->ResCode == 0) {
                $payment->update([
                    'RetrivalRefNo' => $arrres->RetrivalRefNo,
                    'SystemTraceNo' => $arrres->SystemTraceNo,
                    'status' => '5',
                ]);
                $noor = Noor::find($payment->user_code);
                $noor->update([
                    'status' => '4',
                ]);
                $this->send_sms_register_noor($noor->mobile,__('web/public.sex_sms_'.$noor->sex).' '.$noor->name.' '.$noor->family);
                alert()->success(__('web/messages.success_payment'), __('web/messages.success'));
                return view('web.pages.noor-level-2-type-all', compact('noor'));

            } else
                $payment->update([
                    'status' => '4',
                ]);
            alert()->error(__('web/messages.error_payment_72'));
            return view('web.pages.noor-level-1');
        } else {
            //رکورد وجود ندارد
            alert()->error(__('web/messages.not_exist'));
            return view('web.pages.noor-level-1');

        }

    }

}
