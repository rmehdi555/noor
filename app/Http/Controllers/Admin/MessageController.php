<?php

namespace App\Http\Controllers\Admin;


use App\Messages;
use App\MessagesDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends AdminController
{
    public function list(Request $request)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $messages = Messages::orderBy('id','desc')->get();
        $SID=$request->SID;
        return view('admin.message.list', compact('messages','SID'));
    }

    public function add(Request $request)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $reciversAdmin=User::where('level','=','admin')->get();
        $reciversStudent=User::where('level','=','student')->get();
        $reciversTeacher=User::where('level','=','admin')->get();
        $SID=$request->SID;
        return view('admin.message.add', compact('reciversAdmin','reciversStudent','reciversTeacher','SID'));
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
        return redirect()->route('admin.message.list');


    }

    public function show(Request $request,$id)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $message=Messages::find($id);
        if(!isset($message->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.message.list');
        }
        $SID=80;
        return view('admin.message.show', compact('message','SID'));

    }


}
