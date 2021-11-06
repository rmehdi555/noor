<?php

namespace App\Http\Controllers\Teacher;


use App\Messages;
use App\MessagesDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends TeacherController
{
    public function list()
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $messages = Messages::where('user_id_sender','=',$user->id)->orWhere('user_id_reciver','=',$user->id)->orWhere('user_id_reciver','=',0)->orderBy('id','desc')->get();
        return view('teacher.pages.message-list', compact('messages'));
    }

    public function add()
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $reciversAdmin=User::where('level','=','admin')->get();
        $reciversStudent=User::where('level','=','student')->get();
        $reciversTeacher=User::where('level','=','teacher')->get();
        return view('teacher.pages.message-add', compact('reciversAdmin','reciversStudent','reciversTeacher'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'user_id_reciver' => ['required', 'numeric'],
            'title' => ['required', 'string', 'max:255'],
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'description' => ['required', 'string'],
        ]);
        $user=Auth::user();
        $user=User::find($user->id);
        if($request->user_id_reciver==0)
        {
            $message=Messages::create([
                'user_id'=>$user->id,
                'user_id_sender'=>$user->id,
                'user_id_reciver'=>0,
                'title'=>$request->title,
                'visited_sender'=>0,
                'visited_reciver'=>0,
                'status'=>0,
            ]);
        }else{
            $userReciver=User::find($request->user_id_reciver);
            if(!isset($userReciver->id))
            {
                alert()->error('خطا در اطلاعات رخ داده مجدد ثبت کنید',__('web/messages.alert'));
                return redirect()->route('student.message.add');
            }
            $message=Messages::create([
                'user_id'=>$user->id,
                'user_id_sender'=>$user->id,
                'user_id_reciver'=>$userReciver->id,
                'title'=>$request->title,
                'visited_sender'=>0,
                'visited_reciver'=>0,
                'status'=>0,
            ]);
        }


        $file = $request->file('file');
        $urlFile=null;
        if ($file) {
            $urlFile = $this->uploadImage($request->file('file'), 'student');
        }

        $messageDetails=MessagesDetails::create([
            'user_id'=>$user->id,
            'message_id'=>$message->id,
            'description'=>$request->description,
            'file_url'=>$urlFile,
            'status'=>0,
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('teacher.message.list');


    }

    public function show(Request $request,$id)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $message=Messages::find($id);
        if(!isset($message->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.message.list');
        }
        if($message->user_id_reciver==$user->id or $message->user_id_sender==$user->id or $message->user_id_reciver==0 )
        {
            return view('teacher.pages.message-show', compact('message'));
        }else{
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.message.list');
        }

    }


}
