<?php

namespace App\Http\Controllers;

use App\Noor;
use App\Payment;
use Illuminate\Http\Request;
use SoapClient;

class NoorController extends Controller
{
    public function level1()
    {
        return view('web.pages.noor-level-1');
    }


    public function level1Cancel(Request $request)
    {
        return redirect()->route('web.home');
    }



    public function level1Save(Request $request)
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'family' => ['nullable', 'string', 'max:255'],
            'f_name' => ['nullable', 'string', 'max:255'],
            'meli_number' => ['nullable', 'numeric', 'digits:10'],
            'mobile' => ['required', 'numeric', 'digits:11'],
            'type' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable','numeric', 'min:10000'],
            'sex' => ['required', 'string', 'max:255'],
        ]);



        if($request->monthly_payment)
        {
            $request->monthly_payment=1;
        }else{
            $request->monthly_payment=0;
        }

        if($request->type=='1')
        {
            $request->type="وقف";
            $noor = Noor::create([
                'type' => $request->type,
                'name' => $request->name,
                'family' => $request->family,
                'f_name' => $request->f_name,
                'meli_number' => $request->meli_number,
                'mobile' => \App\Providers\MyProvider::convert_phone_number($request->mobile),
                'description'=>$request->description,
                'monthly_payment'=>$request->monthly_payment,
                'sex'=>$request->sex,
                'status' => '2',
            ]);
            $this->send_sms_register_noor($noor->mobile,__('web/public.sex_sms_'.$noor->sex).' '.$noor->name.' '.$noor->family);
            alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
            //return view('web.pages.noor-level-2-type-1',compact('noor'));
            return redirect()->route('web.noor.level.2.show',['id'=>$noor->id,'mobile'=>$noor->mobile]);
        }else {

            if($request->type=='5')
            {
                $request->type="کمک های نقدی";
            }
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
            $payment = $this->createPayment($noor);


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

    public function noorLevel2Show($id,$mobile)
    {
        $noor=Noor::where([['id','=',$id],['mobile','=',$mobile]])->get()->first();
        if(!isset($noor->id))
            return redirect()->route('web.home');
        return view('web.pages.noor-level-2-type-1',compact('noor'));
    }

    public function createPayment($noor)
    {
        if (config('app.bankPay.active') == 'meli') {
            $url='web.payment.online.meli.callback.noor';
        }else{
            $url='web.payment.online.zarinpal.callback.noor';
        }

        $payment=Payment::create([
            'price' => $noor->price,
            'description' => $noor->type,
            'user_type' => $noor->type,
            'user_code'=>$noor->id,
            'mobile' => $noor->mobile,
            'callbackURL'=>route($url),
            'status'=>'1'
        ]);

        return $payment;

    }
}
