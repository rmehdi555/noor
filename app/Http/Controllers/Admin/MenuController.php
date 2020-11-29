<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Menu;
use App\MenuCategories;
use App\Providers\MyProvider;
use Illuminate\Http\Request;

class MenuController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $menus=Menu::all();
        return view('admin.menus.index',compact('menus','SID'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        $menus=Menu::with('children')->get();
        $categories=MenuCategories::all();
        return view('admin.menus.create',compact('SID','menus','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $inputs=$request->all();
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        auth()->user()->menu()->create($inputs);
        return redirect(route('menus.index',['SID' => '500']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menus
     * @return \Illuminate\Http\Response
     */
    public function show($menu)
    {
        $SID=500;
        $menu=Menu::find($menu);
        $menus=Menu::with('children')->get();
        $categories=MenuCategories::all();
        return view('admin.menus.show',compact('menus','menu','categories','SID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menus
     * @return \Illuminate\Http\Response
     */
    public function edit($menu)
    {
        $SID=500;
        $menu=Menu::find($menu);
        $menus=Menu::with('children')->get();
        $categories=MenuCategories::all();
        return view('admin.menus.edit',compact('menus','menu','categories','SID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menus
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request,$menus)
    {
        $inputs = $request->all();
        $menus=Menu::find($menus);

        $inputs["title"]=MyProvider::_insert_text($inputs,'title');

        $menus->update($inputs);

        return redirect(route('menus.index',['SID' => '500']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menus
     * @return \Illuminate\Http\Response
     */
    public function destroy($menus)
    {
        //dd($menus);
        Menu::find($menus)->delete();
        return redirect(route('menus.index',['SID' => '500']));
    }

}
