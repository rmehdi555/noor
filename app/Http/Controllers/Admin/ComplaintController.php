<?php

namespace App\Http\Controllers\Admin;

use App\Complaint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComplaintController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allComplaint=Complaint::all();
        return view('admin.complaint.index',compact('allComplaint','SID'));
    }
}
