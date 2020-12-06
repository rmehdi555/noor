<?php

namespace App\Http\Controllers;

use App\Field;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public  function index()
    {
        $allField=Field::all();
        return view('web.pages.fields',compact('allField'));
    }
    public  function show($id)
    {
        $field=Field::find($id);
        if(!isset($field) OR empty($field))
            return redirect()->route('web.404');
        return view('web.pages.field',compact('field'));
    }
}
