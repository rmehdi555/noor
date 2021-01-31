<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function encrypt_pkcs7($str, $key)
    {
        $key = base64_decode($key);
        $ciphertext = OpenSSL_encrypt($str,"DES-EDE3", $key, OPENSSL_RAW_DATA);
        return base64_encode($ciphertext);
    }
//Send Data
    public function CallAPI($url, $data = false)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data)));
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    public function send_sms_register_student($number,$verificationCode)
    {
        try {

            $username = config('app.smsPanelUser');
            $password = config('app.smsPanelPass');
            $from = config('app.smsPanelFrom');
            $pattern_code = "eu2turs748";
            $to = array($number);
            $input_data = array("verification-code" => $verificationCode);
            $url = config('app.smsPanelUrl') .'?username='. $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
            $handler = curl_init($url);
            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($handler);
        } catch (ApiException $e) {
            Log::error($e->errorMessage());
        } catch (HttpException $e) {
            Log::error($e->errorMessage());
        }


    }
    public function send_sms_register_teacher($number,$verificationCode)
    {
        try {
            $username = config('app.smsPanelUser');
            $password = config('app.smsPanelPass');
            $from = config('app.smsPanelFrom');
            $pattern_code = "cm7opf9tu2";
            $to = array($number);
            $input_data = array("verification-code" => $verificationCode);
            $url = config('app.smsPanelUrl') .'?username='. $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
            $handler = curl_init($url);
            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($handler);
        } catch (ApiException $e) {
            Log::error($e->errorMessage());
        } catch (HttpException $e) {
            Log::error($e->errorMessage());
        }

    }
    public function send_sms_register_noor($number,$name)
    {

        try {
            $username = config('app.smsPanelUser');
            $password = config('app.smsPanelPass');
            $from = config('app.smsPanelFrom');
            $pattern_code = "uhcz4lwsez";
            $to = array($number);
            $input_data = array("name" => $name);
            $url = config('app.smsPanelUrl') .'?username='. $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
            $handler = curl_init($url);
            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($handler);
        } catch (ApiException $e) {
            Log::error($e->errorMessage());
        } catch (HttpException $e) {
            Log::error($e->errorMessage());
        }

    }

    public function send_sms_register_mosabeghe($number,$verificationCode)
    {
        try {
            $username = config('app.smsPanelUser');
            $password = config('app.smsPanelPass');
            $from = config('app.smsPanelFrom');
            $pattern_code = "n5bl2nuk1l";
            $to = array($number);
            $input_data = array("verification-code" => $verificationCode);
            $url = config('app.smsPanelUrl') .'?username='. $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
            $handler = curl_init($url);
            curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($handler);
        } catch (ApiException $e) {
            Log::error($e->errorMessage());
        } catch (HttpException $e) {
            Log::error($e->errorMessage());
        }

    }
}
