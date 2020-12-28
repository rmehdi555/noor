<?php

namespace App\Listeners\UserActivation;

use App\Events\UserActivation;
use App\Events\UserActivationSms;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class SendSmsNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  UserActivation  $event
     * @return void
     */
    public function handle(UserActivationSms $event)
    {

        try {

            $username = config('app.smsPanelUser');
            $password = config('app.smsPanelPass');
            $from = config('app.smsPanelFrom');
            $pattern_code = "srkt6lvuat";
            $to = array($event->user->phone);
            $input_data = array("verification-code" => $event->activationCode);
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
