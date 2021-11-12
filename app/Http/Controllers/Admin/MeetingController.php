<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeetingRequest;
use App\Meeting;
use App\MeetingAccess;
use App\Providers\MyProvider;
use App\Teachers;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends AdminController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $meetings=Meeting::all();

        return view('admin.meeting.index',compact('meetings','SID'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        $reciversTeacher=User::where('level','=','teacher')->get();
        return view('admin.meeting.create',compact('SID','reciversTeacher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingRequest $request)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $inputs=$request->all();
        $urlFile=null;
        $file = $request->file('file');
        if ($file) {
            $urlFile = $this->uploadImage($request->file('file'), 'admin');
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $meeting=Meeting::create([
            'user_id'=>$user->id,
            'title'=>$inputs["title"],
            'description'=>$request->description,
            'file_url'=>$urlFile,
            'status'=>1,
        ]);
        if(in_array(0,$request->resivered))
        {
            $reciversTeacher=User::where('level','=','teacher')->get();
            foreach ($reciversTeacher as $teacher)
            {
                MeetingAccess::create([
                    'user_id_reciver'=>$teacher->id,
                    'meting_id'=>$meeting->id,
                    'visited_reciver'=>0,
                    'status'=>1,
                ]);
            }
        }else{
            foreach ($request->resivered as $teacher)
            {
                MeetingAccess::create([
                    'user_id_reciver'=>$teacher,
                    'meting_id'=>$meeting->id,
                    'visited_reciver'=>0,
                    'status'=>1,
                ]);
            }

        }

        return redirect(route('meeting.index',['SID' => '540']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show($meeting)
    {
        $SID=540;
        $meeting=Meeting::find($meeting);
        return view('admin.meeting.show',compact('meeting','SID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit($meeting)
    {
        $SID=540;
        $meeting=Meeting::find($meeting);
        //dd($meeting->meetingAccess());
        return view('admin.meeting.edit',compact('meeting','SID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(MeetingRequest $request,$meeting)
    {
        $meeting=Meeting::find($meeting);

        $user=Auth::user();
        $user=User::find($user->id);
        $inputs=$request->all();
        $urlFile=$meeting->file_url;
        $file = $request->file('file');
        if ($file) {
            $urlFile = $this->uploadImage($request->file('file'), 'admin');
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $meeting->update([
            'status'=>$inputs["status"],
        ]);
        return redirect(route('meeting.index',['SID' => '540']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy($meeting)
    {
        //dd($meeting);
        Meeting::find($meeting)->delete();
        return redirect(route('meeting.index',['SID' => '540']));
    }
}
