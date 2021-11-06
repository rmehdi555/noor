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
use App\Tickets;
use App\TicketsDetails;
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

class TicketController extends TeacherController
{
    public function list()
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $tickets = Tickets::where('user_id_sender','=',$user->id)->orWhere('user_id_reciver','=',$user->id)->orderBy('visited_reciver')->orderBy('id','desc')->get();
        return view('teacher.pages.ticket-list', compact('tickets'));
    }

    public function add()
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $reciversAdmin=User::where('id','=',5)->get();
        return view('teacher.pages.ticket-add', compact('reciversAdmin'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'user_id_reciver' => ['required', 'numeric'],
            'title' => ['required', 'string', 'max:255'],
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'description' => ['required', 'string'],
        ]);
        $userReciver=User::find($request->user_id_reciver);
        $user=Auth::user();
        $user=User::find($user->id);
        if(!isset($userReciver->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد ثبت کنید',__('web/messages.alert'));
            return redirect()->route('student.ticket.add');
        }
        $file = $request->file('file');
        $urlFile=null;
        if ($file) {
            $urlFile = $this->uploadImage($request->file('file'), 'student');
        }
        $ticket=Tickets::create([
            'user_id'=>$user->id,
            'user_id_sender'=>$user->id,
            'user_id_reciver'=>$userReciver->id,
            'title'=>$request->title,
            'visited_sender'=>0,
            'visited_reciver'=>0,
            'status'=>0,
        ]);
        $ticketDetails=TicketsDetails::create([
            'user_id'=>$user->id,
            'ticket_id'=>$ticket->id,
            'description'=>$request->description,
            'file_url'=>$urlFile,
            'status'=>0,
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('teacher.ticket.list');


    }

    public function show(Request $request,$id)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $ticket=Tickets::find($id);
        if(!isset($ticket->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.ticket.list');
        }
        if($ticket->user_id_reciver==$user->id or $ticket->user_id_sender==$user->id )
        {
            return view('teacher.pages.ticket-show', compact('ticket'));
        }else{
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.ticket.list');
        }

    }


    public function saveAns(Request $request)
    {
        $request->validate([
            'ticket_id' => ['required', 'numeric'],
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'description' => ['required', 'string'],
        ]);
        $ticket=Tickets::find($request->ticket_id);
        $user=Auth::user();
        $user=User::find($user->id);


        if(!isset($ticket->id)  )
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.ticket.list');
        }
        if($ticket->user_id_reciver==$user->id or $ticket->user_id_sender==$user->id )
        {
            $file = $request->file('file');
            $urlFile=null;
            if ($file) {
                $urlFile = $this->uploadImage($request->file('file'), 'teacher');
            }
            if($ticket->user_id_reciver==$user->id)
            {
                $status=1;
            }else{
                $status=0;
            }
            $ticket->update([
                'visited_sender'=>0,
                'visited_reciver'=>0,
                'status'=>$status,
            ]);
            $ticketDetails=TicketsDetails::create([
                'user_id'=>$user->id,
                'ticket_id'=>$ticket->id,
                'description'=>$request->description,
                'file_url'=>$urlFile,
                'status'=>0,
            ]);
            alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
            return redirect()->route('teacher.ticket.show',$ticket->id);
        }else{
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.ticket.list');
        }

    }

}
