<?php

namespace App\Http\Controllers\Admin;

use App\ClassRooms;
use App\ClassRoomsStudents;
use App\Practices;
use App\PracticesDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticeController extends AdminController
{
    public function list(Request $request)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $SID=$request->SID;
        $practices = Practices::orderBy('id','desc')->get();
        return view('admin.practice.list', compact('practices','SID'));
    }

    public function show(Request $request,$id)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $practice=Practices::find($id);
        if(!isset($practice->id) )
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.practice.list');
        }
        $SID=520;
        return view('admin.practice.show', compact('practice','SID'));

    }


    public function saveAns(Request $request)
    {
        $request->validate([
            'practice_id' => ['required', 'numeric'],
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'description' => ['required', 'string'],
        ]);
        $practice=Practices::find($request->practice_id);
        $user=Auth::user();
        $user=User::find($user->id);

        if(!isset($practice->id)  )
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.practice.list');
        }
        $file = $request->file('file');
        $urlFile=null;
        if ($file) {
            $urlFile = $this->uploadImage($request->file('file'), 'admin');
        }
        $practice->update([
            'status'=>1,
        ]);
        $practiceDetails=PracticesDetails::create([
            'user_id'=>$user->id,
            'practice_id'=>$practice->id,
            'description'=>$request->description,
            'file_url'=>$urlFile,
            'status'=>0,
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('admin.practice.show',$practice->id);
    }

}
