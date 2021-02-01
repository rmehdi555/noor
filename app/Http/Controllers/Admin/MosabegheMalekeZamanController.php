<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MosabegheMalekeZaman;
use Illuminate\Http\Request;

class MosabegheMalekeZamanController extends Controller
{
    public function index(Request $request)
    {
        $SID=$request->SID;
        $fields=MosabegheMalekeZaman::all();
        return view('admin.mosabeghe-maleke-zaman.index',compact('fields','SID'));

    }
}
