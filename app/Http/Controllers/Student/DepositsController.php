<?php

namespace App\Http\Controllers\Student;

use Adlino\Locations\Facades\locations;
use App\Cities;
use App\DepositsType;
use App\Field;
use App\Http\Controllers\Controller;
use App\Mali;
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

class DepositsController extends StudentController
{
    public function create()
    {
        $user=Auth::user();
        $depositsType = DepositsType::where('status', '=',1)->orderBy('id','desc')->get();
        return view('student.pages.deposits-create', compact('depositsType'));
    }
    public function save( Request $request )
    {
        $user=Auth::user();
        $depositsType = DepositsType::where('status', '=',1)->orderBy('id','desc')->get();


        $noor = Noor::create([
            'type' => $request->type,
            'name' => $request->name,
            'family' => $request->family,
            'f_name' => $request->f_name,
            'meli_number' => $request->meli_number,
            'mobile' => \App\Providers\MyProvider::convert_phone_number($request->mobile),
            'price' => $request->price,
            'monthly_payment' => $request->monthly_payment,
            'sex'=>$request->sex,
            'status' => '1',
        ]);
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
            return redirect()->route('student.panel');
        } else {

            $MerchantID = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX'; //Required
            $Amount = $payment->price; //Amount will be based on Toman - Required
            $Description = 'توضیحات تراکنش تستی'; // Required
            $Email = $noor->email; // Optional
            $Mobile = $noor->phone; // Optional
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
