<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->level=='student')
        {
            return redirect()->route('student.panel');
        }elseif (Auth::user()->level=='teacher'){
            return redirect()->route('teacher.panel');
        }elseif (Auth::user()->level=='admin'){
            return redirect()->route('admin.panel');
        }{
            return redirect()->route('web.home');
        }


    }
}
