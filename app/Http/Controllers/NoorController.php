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
                'meli_number' => $request->meli_numbere,
                'mobile' => \App\Providers\MyProvider::convert_phone_number($request->mobile),
                'description'=>$request->description,
                'monthly_payment'=>$request->monthly_payment,
                'status' => '1',
            ]);
            alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
            return view('web.pages.noor-level-2-type-1',compact('noor'));
        }else{


            $noor = Noor::create([
                'type' => $request->type,
                'name' => $request->name,
                'family' => $request->family,
                'f_name' => $request->f_name,
                'meli_number' => $request->meli_numbere,
                'mobile' => \App\Providers\MyProvider::convert_phone_number($request->mobile),
                'price'=>$request->price,
                'monthly_payment'=>$request->monthly_payment,
                'status' => '1',
            ]);
            $payment=$this->createPayment($noor);

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
                    'authority'=>$result->Authority,
                    'status'=>'2',
                ]);
                Header('Location: https://sandbox.zarinpal.com/pg/StartPay/'.$result->Authority);
                exit;
            } else {
                alert()->error(__('web/messages.error_connect_bank'),__('web/messages.success'));
                return redirect()->route('web.pages.noor-level-1');
            }



        }




    }

    public function createPayment($noor)
    {

        $payment=Payment::create([
            'price' => $noor->price,
            'description' => $noor->type,
            'user_type' => $noor->type,
            'user_code'=>$noor->id,
            'mobile' => $noor->mobile,
            'callbackURL'=>route('web.payment.online.zarinpal.callback.noor'),
            'status'=>'1'
        ]);

        return $payment;

    }
}
