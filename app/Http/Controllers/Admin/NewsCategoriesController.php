<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCategoriesRequest;
use App\NewsCategories;
use App\Providers\MyProvider;
use Illuminate\Http\Request;

class NewsCategoriesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allNewsCategories=NewsCategories::all();
        return view('admin.news-categories.index',compact('allNewsCategories','SID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        $categories=NewsCategories::with('children')->get();
        return view('admin.news-categories.create',compact('SID','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsCategoriesRequest $request)
    {
        //auth()->loginUsingId(1);
        $inputs=$request->all();
        $file = $request->file('images');
        if($file) {
            $inputs['images'] = $this->uploadImages($request->file('images'),'newsCategories',["300" , "600" , "900"]);
        } else {
            $inputs['images'] = [];
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');
        $inputs["body"]=MyProvider::_insert_text($inputs,'body');

        auth()->user()->newsCategories()->create($inputs);

        return redirect(route('newsCategories.index',['SID' => '10']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsCategories  $newsCategories
     * @return \Illuminate\Http\Response
     */
    public function show($newsCategories)
    {
        $SID=10;
        $categories=NewsCategories::with('children')->get();
        $newsCategories=NewsCategories::find($newsCategories);
        return view('admin.news-categories.show',compact('newsCategories','categories','SID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsCategories  $newsCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($newsCategories)
    {
        $SID=10;
        $categories=NewsCategories::with('children')->get();
        $newsCategories=NewsCategories::find($newsCategories);
        return view('admin.news-categories.edit',compact('newsCategories','categories','SID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsCategories  $newsCategories
     * @return \Illuminate\Http\Response
     */
    public function update(NewsCategoriesRequest $request, $newsCategories)
    {
        $file = $request->file('images');
        $inputs = $request->all();
        $newsCategories=NewsCategories::find($newsCategories);

        if($file) {
            $inputs['images'] = $this->uploadImages($request->file('images'),'newsCategories',["300" , "600" , "900"]);
        } else {
            $inputs['images'] = $newsCategories->images;
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');
        $inputs["body"]=MyProvider::_insert_text($inputs,'body');

        $newsCategories->update($inputs);

        return redirect(route('newsCategories.index',['SID' => '10']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsCategories  $newsCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($newsCategories)
    {
        NewsCategories::find($newsCategories)->delete();
        return redirect(route('newsCategories.index',['SID' => '10']));
    }
}
