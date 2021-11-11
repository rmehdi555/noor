<?php

namespace App\Http\Controllers\Admin;
use App\Tickets;
use App\TicketsDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TicketController extends AdminController
{
    public function list(Request $request)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $tickets = Tickets::orderBy('id','desc')->get();
        $SID=$request->SID;
        return view('admin.ticket.list', compact('tickets','SID'));
    }

    public function show(Request $request,$id)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $ticket=Tickets::find($id);
        if(!isset($ticket->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.ticket.list');
        }
        $SID=90;
        return view('admin.ticket.show', compact('ticket','SID'));
    }

    public function saveAns(Request $request)
    {
        $request->validate([
            'ticket_id' => ['required', 'numeric'],
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
            'description' => ['required', 'string'],
        ]);
        $SID=90;
        $ticket=Tickets::find($request->ticket_id);
        $user=Auth::user();
        $user=User::find($user->id);
        if(!isset($ticket->id)  )
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.ticket.list');
        }

        $file = $request->file('file');
        $urlFile=null;
        if ($file) {
            $urlFile = $this->uploadImage($request->file('file'), 'teacher');
        }
        $ticket->update([
            'visited_sender'=>0,
            'visited_reciver'=>0,
            'status'=>1,
        ]);
        $ticketDetails=TicketsDetails::create([
            'user_id'=>$user->id,
            'ticket_id'=>$ticket->id,
            'description'=>$request->description,
            'file_url'=>$urlFile,
            'status'=>0,
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('admin.ticket.show',$ticket->id);

    }

}
