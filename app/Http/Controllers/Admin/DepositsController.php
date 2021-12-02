<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\MyProvider;
use App\Deposits;
use Illuminate\Http\Request;

class DepositsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allDeposits=Deposits::where('status','=',1)->get();
        return view('admin.deposits.index',compact('allDeposits','SID'));
    }

}
