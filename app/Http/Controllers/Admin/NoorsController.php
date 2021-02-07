<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Noor;
use Illuminate\Http\Request;

class NoorsController extends Controller
{
    public function index(Request $request)
    {
        $SID=$request->SID;
        $noors=Noor::all();
        return view('admin.noors.index',compact('noors','SID'));
    }
}
