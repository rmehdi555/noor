<?php

namespace App\Http\Controllers;

use App\ActivationCode;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public  function activationAccountByEmail($token)
    {
        $activationCode=ActivationCode::whereCode($token)->first();
        if(! $activationCode)
        {
            alert()->error(__('web/messages.not_exist_activation_code'),__('web/messages.alert'));
            return redirect('/');
        }
        if( $activationCode->expire < Carbon::now())
        {
            alert()->error(__('web/messages.expire_activation_code'),__('web/messages.alert'));
            return redirect()->route('login');
        }
        if( $activationCode->used == true)
        {
            alert()->error(__('web/messages.used_activation_code'),__('web/messages.alert'));
            return redirect()->route('login');
        }
        $activationCode->user->update([
            'active'=>1
        ]);
        $activationCode->update([
            'used'=>true
        ]);
        auth()->loginUsingId($activationCode->user->id);
        alert()->success(__('web/messages.active_your_panel'),__('web/messages.success'));
        return redirect()->route('login');
    }
    public  function activationAccountBySms(Request $request)
    {
        $user=User::wherePhone($request->input('phone'))->first();
        if(!$user)
        {
            alert()->error(__('web/messages.expire_activation_code'),__('web/messages.alert'));
            return redirect('/');
        }
        $activationCode=ActivationCode::where([['user_id','=',$user->id],['code','=',$request->input('code')]])->first();
        if(! $activationCode)
        {
            alert()->error(__('web/messages.not_exist_activation_code'),__('web/messages.alert'));
            return redirect()->route('login.sms');
        }
        if( $activationCode->expire < Carbon::now())
        {
            alert()->error(__('web/messages.expire_activation_code'),__('web/messages.alert'));
            return redirect()->route('login.sms');
        }
        if( $activationCode->used == true)
        {
            alert()->error(__('web/messages.used_activation_code'),__('web/messages.alert'));
            return redirect()->route('login.sms');
        }
        $activationCode->user->update([
            'active'=>1
        ]);
        $activationCode->update([
            'used'=>true
        ]);
        auth()->loginUsingId($activationCode->user->id);
        alert()->success(__('web/messages.active_your_panel'),__('web/messages.success'));
        return redirect()->route('login.sms');
    }

    public  function resetPasswordBySMS(Request $request)
    {
        $user=User::wherePhone($request->input('phone'))->first();
        if(!$user)
        {
            alert()->error(__('web/messages.expire_activation_code'),__('web/messages.alert'));
            return redirect('/');
        }
        $passwordTable = DB::table(config('auth.passwords.users.table'));
        //$activationCode = $passwordTable->where($user->phone);
        $activationCode=$passwordTable->where([['email','=',$user->phone],['token','=',$request->input('code')]])->first();
        if(! $activationCode)
        {
            alert()->error(__('web/messages.not_exist_activation_code'),__('web/messages.alert'));
            return redirect()->route('password.request.sms');
        }

        return view('auth.passwords.reset-sms',compact('user','activationCode'));
    }


}
