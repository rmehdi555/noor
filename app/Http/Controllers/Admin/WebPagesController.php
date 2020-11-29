<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebPagesRequest;
use App\Providers\MyProvider;
use App\WebPages;
use Illuminate\Http\Request;

class WebPagesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allWebPages=WebPages::all();
        return view('admin.web-pages.index',compact('allWebPages','SID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        return view('admin.web-pages.create',compact('SID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WebPagesRequest $request)
    {
        //auth()->loginUsingId(1);
        $inputs=$request->all();
        $inputs['images'] = $this->uploadImages($request->file('images'),'webPages',["920-380" , "600" , "920"]);

        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["body"]=MyProvider::_insert_text($inputs,'body');
        auth()->user()->webPages()->create($inputs);

        return redirect(route('webPages.index',['SID' => '400']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WebPages  $webPages
     * @return \Illuminate\Http\Response
     */
    public function show($webPages)
    {
        $webPages=WebPages::find($webPages);
        return view('admin.web-pages.show',compact('webPages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WebPages  $webPages
     * @return \Illuminate\Http\Response
     */
    public function edit($webPages)
    {
        $webPages=WebPages::find($webPages);
        return view('admin.web-pages.edit',compact('webPages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WebPages  $webPages
     * @return \Illuminate\Http\Response
     */
    public function update(WebPagesRequest $request, $webPages)
    {
        $file = $request->file('images');
        $inputs = $request->all();
        $webPages=WebPages::find($webPages);

        if($file) {
            $inputs['images'] = $this->uploadImages($request->file('images'),'webPages',["920-380" , "600" , "920"]);
        } else {
            $inputs['images'] = $webPages->images;
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["body"]=MyProvider::_insert_text($inputs,'body');

        $webPages->update($inputs);

        return redirect(route('webPages.index',['SID' => '400']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WebPages  $webPages
     * @return \Illuminate\Http\Response
     */
    public function destroy($webPages)
    {
        WebPages::find($webPages)->delete();
        return redirect(route('webPages.index',['SID' => '400']));
    }



}
