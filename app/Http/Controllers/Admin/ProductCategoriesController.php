<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoriesRequest;
use App\ProductCategories;
use App\Providers\MyProvider;
use Illuminate\Http\Request;

class ProductCategoriesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allProductCategories=ProductCategories::all();
        return view('admin.product-categories.index',compact('allProductCategories','SID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        $categories=ProductCategories::with('children')->get();
        return view('admin.product-categories.create',compact('SID','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoriesRequest $request)
    {
        //auth()->loginUsingId(1);
        $inputs=$request->all();
        $file = $request->file('images');
        if($file) {
            $inputs['images'] = $this->uploadImages($request->file('images'),'productCategories',["300" , "600" , "900"]);
        } else {
            $inputs['images'] = [];
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');
        $inputs["body"]=MyProvider::_insert_text($inputs,'body');

        auth()->user()->productCategories()->create($inputs);

        return redirect(route('productCategories.index',['SID' => '300']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductCategories  $productCategories
     * @return \Illuminate\Http\Response
     */
    public function show($productCategories)
    {
        $categories=ProductCategories::with('children')->get();
        $productCategories=ProductCategories::find($productCategories);
        return view('admin.product-categories.show',compact('productCategories','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategories  $productCategories
     * @return \Illuminate\Http\Response
     */
    public function edit($productCategories)
    {
        $categories=ProductCategories::with('children')->get();
        $productCategories=ProductCategories::find($productCategories);
        return view('admin.product-categories.edit',compact('productCategories','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategories  $productCategories
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoriesRequest $request, $productCategories)
    {
        $file = $request->file('images');
        $inputs = $request->all();
        $productCategories=ProductCategories::find($productCategories);

        if($file) {
            $inputs['images'] = $this->uploadImages($request->file('images'),'productCategories',["300" , "600" , "900"]);
        } else {
            $inputs['images'] = $productCategories->images;
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');
        $inputs["body"]=MyProvider::_insert_text($inputs,'body');

        $productCategories->update($inputs);

        return redirect(route('productCategories.index',['SID' => '300']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategories  $productCategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($productCategories)
    {
        ProductCategories::find($productCategories)->delete();
        return redirect(route('productCategories.index',['SID' => '300']));
    }
}
