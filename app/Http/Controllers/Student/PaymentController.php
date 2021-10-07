<?php

namespace App\Http\Controllers\Student;

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
        if (config('app.bankPay.active') == 'meli') {
            $user = Auth::user();
            $payment = Payment::where('user_id', '=', $user->id)->orderBy('id', 'DESC')->first();
            $key=config('app.bankMeli.Key');
            $MerchantId=config('app.bankMeli.MerchantId');
            $TerminalId=config('app.bankMeli.TerminalId');
            $Amount=$payment->price; //Rials
            $OrderId=$payment->id;
            $LocalDateTime=date("m/d/Y g:i:s a");
            $ReturnUrl=$payment->callbackURL;
            $SignData=$this->encrypt_pkcs7("$TerminalId;$OrderId;$Amount","$key");
            $data = array('TerminalId'=>$TerminalId,
                'MerchantId'=>$MerchantId,
                'Amount'=>$Amount,
                'SignData'=> $SignData,
                'ReturnUrl'=>$ReturnUrl,
                'LocalDateTime'=>$LocalDateTime,
                'OrderId'=>$OrderId);
            $str_data = json_encode($data);
            $res=$this->CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest',$str_data);
            $arrres=json_decode($res);
            if($arrres->ResCode==0)
            {
                $Token= $arrres->Token;
                $url="https://sadad.shaparak.ir/VPG/Purchase?Token=$Token";
                $payment->update([
                    'Token' => $Token,
                    'status' => '2',
                ]);
                header("Location:$url");
            }
            else
                alert()->error(__('web/messages.error_connect_bank'), __('web/messages.success'));
            return redirect()->route('student.panel');
        } else {
            $user = Auth::user();
            $payment = Payment::where('user_id', '=', $user->id)->orderBy('id', 'DESC')->first();
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
                    'authority' => $result->Authority,
                    'status' => '2',
                ]);
                Header('Location: https://sandbox.zarinpal.com/pg/StartPay/' . $result->Authority);
                exit;
            } else {
                alert()->error(__('web/messages.error_connect_bank'), __('web/messages.success'));
                return redirect()->route('student.panel');
            }

        }
    }
}
