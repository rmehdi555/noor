<?php

namespace App\Http\Controllers\Teacher;

use Adlino\Locations\Facades\locations;
use App\Cities;
use App\ClassRooms;
use App\ClassRoomsStudents;
use App\Field;
use App\Http\Controllers\Controller;
use App\Mali;
use App\Payment;
use App\Practices;
use App\PracticesAccess;
use App\PracticesDetails;
use App\Provinces;
use App\Students;
use App\StudentsDocuments;
use App\StudentsFields;
use App\Teachers;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use niklasravnsborg\LaravelPdf\PdfWrapper;
use SoapClient;

class PracticeController extends TeacherController
{
    public function list()
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $classRooms=ClassRooms::select('id')->where('user_id','=',$user->id)->get();
        $classRoomsId=array();
        foreach($classRooms as $item)
        {
            array_push($classRoomsId,$item->id);
        }
       // dd($classRoomsId);
       // dd($classRooms->toArray());
        $practices = Practices::whereIn('class_rooms_id',$classRoomsId)->orderBy('status')->orderBy('id','desc')->get();
        $classActive=ClassRoomsStudents::where([['teacher_id','=',$user->teacher->id],['status','!=','5']])->get();
        return view('teacher.pages.practice-list', compact('practices','classActive'));
    }

//    public function add()
//    {
//        $user=Auth::user();
//        $user=User::find($user->id);
//        $classActive=ClassRoomsStudents::where([['teacher_id','=',$user->teacher->id],['status','!=','5']])->get();
//        if(count($classActive)<1)
//        {
//            alert()->error('شما هیچ کلاس فعالی ندارید',__('web/messages.alert'));
//            return redirect()->route('teacher.practice.list');
//        }
//        return view('teacher.pages.practice-add', compact('classActive'));
//    }
//
//    public function save(Request $request)
//    {
//        $request->validate([
//            'class_room_teacher_id' => ['required', 'numeric'],
//            'title' => ['required', 'string', 'max:255'],
//            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
//            'description' => ['required', 'string'],
//        ]);
//        $classRoomStudent=ClassRoomsStudents::find($request->class_room_teacher_id);
//        $user=Auth::user();
//        $user=User::find($user->id);
//        if(!isset($classRoomStudent->id) or $classRoomStudent->teacher_id!=$user->teacher->id)
//        {
//            alert()->error('خطا در اطلاعات رخ داده مجدد ثبت کنید',__('web/messages.alert'));
//            return redirect()->route('teacher.practice.add');
//        }
//        $file = $request->file('file');
//        $urlFile=null;
//        if ($file) {
//            $urlFile = $this->uploadImage($request->file('file'), 'teacher');
//        }
//        $practice=Practices::create([
//            'user_id'=>$user->id,
//            'class_rooms_id'=>$classRoomStudent->class_rooms_id,
//            'title'=>$request->title,
//            'visited'=>0,
//            'status'=>0,
//        ]);
//        $practiceDetails=PracticesDetails::create([
//            'user_id'=>$user->id,
//            'practice_id'=>$practice->id,
//            'description'=>$request->description,
//            'file_url'=>$urlFile,
//            'status'=>0,
//        ]);
//        $teacher=Teachers::find($classRoomStudent->teacher_id);
//        PracticesAccess::create([
//            'user_id'=>$user->id,
//            'practice_id'=>$practice->id,
//            'user_id_send'=>$user->id,
//            'user_id_get'=>$teacher->user->id,
//            'visited'=>0,
//            'status'=>0,
//        ]);
//
//        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
//        return redirect()->route('teacher.practice.list');
//
//
//    }

    public function show(Request $request,$id)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $classRooms=ClassRooms::select('id')->where('user_id','=',$user->id)->get();
        $classRoomsId=array();
        foreach($classRooms as $item)
        {
            array_push($classRoomsId,$item->id);
        }

        $practice=Practices::find($id);
        if(!isset($practice->id) or !in_array($practice->class_rooms_id, $classRoomsId) )
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.practice.list');
        }
        $practice->update([
            'visited'=>'1'
        ]);
        return view('teacher.pages.practice-show', compact('practice'));

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
        $classRooms=ClassRooms::select('id')->where('user_id','=',$user->id)->get();
        $classRoomsId=array();
        foreach($classRooms as $item)
        {
            array_push($classRoomsId,$item->id);
        }

        if(!isset($practice->id) or !in_array($practice->class_rooms_id, $classRoomsId) )
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.practice.list');
        }
        $file = $request->file('file');
        $urlFile=null;
        if ($file) {
            $urlFile = $this->uploadImage($request->file('file'), 'teacher');
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
        return redirect()->route('teacher.practice.show',$practice->id);
    }

}
