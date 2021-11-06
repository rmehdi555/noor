<?php

namespace App\Http\Controllers\Student;


use App\Messages;
use App\MessagesDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends StudentController
{
    public function list()
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $messages = Messages::where('user_id_sender','=',$user->id)->orWhere('user_id_reciver','=',$user->id)->orWhere('user_id_reciver','=',0)->orderBy('id','desc')->get();
        return view('student.pages.message-list', compact('messages'));
    }



    public function show(Request $request,$id)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $message=Messages::find($id);
        if(!isset($message->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('student.message.list');
        }
        if($message->user_id_reciver==$user->id or $message->user_id_sender==$user->id or $message->user_id_reciver==0 )
        {
            return view('student.pages.message-show', compact('message'));
        }else{
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('student.message.list');
        }

    }


}
