<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuCategoriesRequest;
use App\MenuCategories;
use App\Providers\MyProvider;
use Illuminate\Http\Request;

class MenuCategoriesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allMenuCategories=MenuCategories::all();
        return view('admin.menu-categories.index',compact('allMenuCategories','SID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        return view('admin.menu-categories.create',compact('SID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuCategoriesRequest $request)
    {
        $inputs=$request->all();
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');
        auth()->user()->menuCategories()->create($inputs);

        return redirect(route('menuCategories.index',['SID' => '700']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuCategories  $menuCategories
     * @return \Illuminate\Http\Response
     */
    public function show($menuCategories)
    {
        $SID=700;
        $menuCategories=MenuCategories::find($menuCategories);
        return view('admin.menu-categories.show',compact('menuCategories','SID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuCategories  $menuCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($menuCategories)
    {
        $SID=700;
        $menuCategories=MenuCategories::find($menuCategories);

        return view('admin.menu-categories.edit',compact('menuCategories','SID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuCategories  $menuCategories
     * @return \Illuminate\Http\Response
     */
    public function update(MenuCategoriesRequest $request, $menuCategories)
    {

        $inputs = $request->all();
        $menuCategories=MenuCategories::find($menuCategories);

        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');

        $menuCategories->update($inputs);

        return redirect(route('menuCategories.index',['SID' => '700']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuCategories  $menuCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($menuCategories)
    {
        MenuCategories::find($menuCategories)->delete();
        return redirect(route('menuCategories.index',['SID' => '700']));
    }

}
