<?php

namespace App\Http\Controllers\Teacher;


use App\Deposits;
use App\DepositsType;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoapClient;

class DepositsController extends TeacherController
{
    public function create()
    {
        $user=Auth::user();
        $depositsType = DepositsType::where([['status', '=',1],['user_type','=','teacher']])->orderBy('id','desc')->get();
        return view('teacher.pages.deposits-create', compact('depositsType'));
    }
    public function save( Request $request )
    {
        $user=Auth::user();
        $depositsType = DepositsType::where('status', '=',1)->orderBy('id','desc')->get();
        $request->validate([
            'deposits_type_id' => ['required', 'numeric'],
            'year'=> ['required', 'numeric'],
            'month'=> ['required', 'numeric'],
        ]);
        $depositsType=DepositsType::find($request->deposits_type_id);
        if(!isset($depositsType->id))
        {
            alert()->error(__('خطا رخ داده است مجدد تلاش کنید'),__('web/messages.alert'));
            return redirect()->route('teacher.deposits.create');
        }
        if($depositsType->type=="amount")
        {
            $deposit= Deposits::create([
                'price' => $depositsType->price,
                'user_type'=>'teacher',
                'deposits_type_id' => $depositsType->id,
                'user_id' => $user->id,
                'payment_id' => 0,
                'title' => $depositsType->title,
                'year' => $request->year,
                'month' => $request->month,
                'status' => 0,
            ]);
        }else{
            $request->validate([
                'price' => ['required','numeric', 'min:10000'],
            ]);
            $deposit= Deposits::create([
                'price' => $request->price,
                'user_type'=>'teacher',
                'deposits_type_id' => $depositsType->id,
                'user_id' => $user->id,
                'payment_id' => 0,
                'title' => $request->title,
                'year' => $request->year,
                'month' => $request->month,
                'status' => 0,
            ]);

        }

        if (config('app.bankPay.active') == 'meli') {
            $url='payment.online.meli.callback.teacher.deposit';
        }else{
            $url='payment.online.zarinpal.callback.teacher.deposit';
        }

        $payment=Payment::create([
            'price' => $deposit->price,
            'description' => $deposit->title,
            'user_id' => $user->id,
            'user_type' => $user->level,
            'user_code' => $user->teacher->teacher_id,
            'email' => $user->email,
            'mobile' => $user->phone,
            'callbackURL'=>route($url),
            'status'=>'1'
        ]);

        $deposit->update([
            'payment_id' => $payment->id,
        ]);


        if (config('app.bankPay.active') == 'meli') {
            $key = config('app.bankMeli.Key');
            $MerchantId = config('app.bankMeli.MerchantId');
            $TerminalId = config('app.bankMeli.TerminalId');
            $Amount = $payment->price; //Rials
            $OrderId = $payment->id;
            $LocalDateTime = date("m/d/Y g:i:s a");
            $ReturnUrl = $payment->callbackURL;
            $SignData = $this->encrypt_pkcs7("$TerminalId;$OrderId;$Amount", "$key");
            $data = array('TerminalId' => $TerminalId,
                'MerchantId' => $MerchantId,
                'Amount' => $Amount,
                'SignData' => $SignData,
                'ReturnUrl' => $ReturnUrl,
                'LocalDateTime' => $LocalDateTime,
                'OrderId' => $OrderId);
            $str_data = json_encode($data);
            $res = $this->CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest', $str_data);
            $arrres = json_decode($res);
            if ($arrres->ResCode == 0) {
                $Token = $arrres->Token;
                $url = "https://sadad.shaparak.ir/VPG/Purchase?Token=$Token";
                $payment->update([
                    'Token' => $Token,
                    'status' => '2',
                ]);
                header("Location:$url");
            } else
                alert()->error(__('web/messages.error_connect_bank'), __('web/messages.success'));
            return redirect()->route('teacher.panel');
        } else {

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
                return redirect()->route('web.pages.noor-level-1');
            }


        }
    }




}
