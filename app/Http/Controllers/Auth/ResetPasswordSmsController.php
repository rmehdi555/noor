<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ResetPasswordSmsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    //protected $redirectTo = 'password/sms';


    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset-sms')->with(
            ['token' => $token, 'phone' => $request->phone]
        );
    }
    public function reset(Request $request)
    {
       // $request->validate($this->rules(), $this->validationErrorMessages());
       // $this->validator($request->all())->validate();





        $password=$request->input('password');
        $user=User::wherePhone($request->input('phone'))->first();
        if(!$user)
        {
            alert()->error(__('web/messages.not_exist_phone'),__('web/messages.alert'));
            return redirect('/');
        }
        $passwordTable = DB::table(config('auth.passwords.users.table'));
        //$activationCode = $passwordTable->where($user->phone);
        $activationCode=$passwordTable->where([['email','=',$user->phone],['token','=',$request->input('token')]])->first();
        if(! $activationCode)
        {
            alert()->error(__('web/messages.not_exist_activation_code'),__('web/messages.alert'));
            return redirect()->route('password.request.sms');
        }

        if($request->input('password')!=$request->input('password_confirmation') OR strlen($request->input('password')<8))
        {
            alert()->error(__('web/messages.not_confirmed_password'),__('web/messages.alert'));
            return view('auth.passwords.reset-sms',compact('user','activationCode'));
        }

        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

       // $this->guard()->login($user);
        Auth::logout();
        alert()->success(__('web/messages.success_reset_password'),__('web/messages.success'))->persistent(__('web/public.ok'));;
        return redirect()->route('login.sms');
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'phone' => 'required|digits:11',
            'password' => 'required|confirmed|min:8',
        ];
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'token' => ['required'],
            'phone' => ['required', 'numeric', 'digits:11'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }






}
