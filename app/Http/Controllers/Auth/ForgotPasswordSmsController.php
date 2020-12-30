<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

class ForgotPasswordSmsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.sms');
    }


    public function sendResetLinkSms(Request $request)
    {
        $this->validatePhone($request);
        $user = User::wherePhone($request->input('phone'))->first();

        if($user) {
            $token = $this->createToken($user, config('auth.passwords.users.table'));
            $this->sendSmsLink($user, $token);

            alert()->success(__('web/messages.save_register_and_send_sms'),__('web/messages.success'));
            return view('auth.passwords.confirm-sms-code',compact('user'));
        }

        return back()->withErrors(
            ['phone' => __('web/messages.not_exist_phone')]
        );
    }

    /**
     * Validate the email for the given request.
     *
     * @param \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validatePhone(Request $request)
    {
        $this->validate($request, ['phone' => 'required|digits:11']);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    private function createToken($user, $tableName)
    {
        $passwordTable = DB::table($tableName);
        $password = $passwordTable->whereEmail($user->phone);
        $token = rand(10001,99999);

        if($password->first()) {
            $password->update(['token' => $token , 'created_at' => Carbon::now()]);
        } else {
            $passwordTable->insert(
                ['email' => $user->phone , 'token' => $token , 'created_at' => Carbon::now()]
            );
        }

        return $token;
    }

    /**
     * @param $user
     * @param $token
     */
    private function sendSmsLink($user, $token)
    {
        try {

            $username = config('app.smsPanelUser');
            $password = config('app.smsPanelPass');
            $from = config('app.smsPanelFrom');
            $pattern_code = "r6a2a96wdv";
            $to = array($user->phone);
            $input_data = array("verification-code" => $token);
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
