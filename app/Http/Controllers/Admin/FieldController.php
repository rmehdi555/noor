<?php

namespace App\Http\Controllers\Admin;

use App\Field;
use App\Http\Controllers\Controller;
use App\Http\Requests\FieldRequest;
use App\Providers\MyProvider;
use Illuminate\Http\Request;

class FieldController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allField=Field::all();
        return view('admin.fields.index',compact('allField','SID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        $fields=Field::with('children')->get();
        return view('admin.fields.create',compact('SID','fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldRequest $request)
    {
        //auth()->loginUsingId(1);
        $inputs=$request->all();
        $file = $request->file('images');
        if($file) {
            $inputs['images'] = $this->uploadImages($request->file('images'),'fields',["300" , "600" , "900"]);
        } else {
            $inputs['images'] = [];
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');
        $inputs["body"]=MyProvider::_insert_text($inputs,'body');

        auth()->user()->fields()->create($inputs);

        return redirect(route('fields.index',['SID' => '30']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FieldController  $fields
     * @return \Illuminate\Http\Response
     */
    public function show($field)
    {
        $SID=30;
        $fields=Field::with('children')->get();
        $field=Field::find($field);
        return view('admin.fields.show',compact('field','fields','SID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FieldController  $fields
     * @return \Illuminate\Http\Response
     */
    public function edit($field)
    {
        $SID=30;
        $fields=Field::with('children')->get();
        $field=Field::find($field);
        return view('admin.fields.edit',compact('field','fields','SID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FieldController  $fields
     * @return \Illuminate\Http\Response
     */
    public function update(FieldRequest $request, $fields)
    {
        $file = $request->file('images');
        $inputs = $request->all();
        $fields=Field::find($fields);

        if($file) {
            $inputs['images'] = $this->uploadImages($request->file('images'),'fields',["300" , "600" , "900"]);
        } else {
            $inputs['images'] = $fields->images;
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');
        $inputs["body"]=MyProvider::_insert_text($inputs,'body');

        $fields->update($inputs);

        return redirect(route('fields.index',['SID' => '30']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FieldController  $fields
     * @return \Illuminate\Http\Response
     */
    public function destroy($fields)
    {
        Field::find($fields)->delete();
        return redirect(route('fields.index',['SID' => '30']));
    }
}
