<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\ProductCategories;
use App\Products;
use App\Providers\MyProvider;
use Illuminate\Http\Request;

class ProductsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $products=Products::all();
        return view('admin.products.index',compact('products','SID'));

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
        return view('admin.products.create',compact('SID','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $inputs=$request->all();
        $file = $request->file('images');
        if($file) {
            $inputs['images'] = $this->uploadImages($request->file('images'),'products',["50" ,"66", "200" , "350","500"]);
        } else {
            $inputs['images'] = [];
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');
        $inputs["body"]=MyProvider::_insert_text($inputs,'body');

        auth()->user()->product()->create($inputs);

        return redirect(route('products.index',['SID' => '200']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($products)
    {
        $SID=200;
        $products=Products::find($products);
        $categories=ProductCategories::with('children')->get();
        return view('admin.products.show',compact('products','categories','SID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($products)
    {
        $SID=200;
        $products=Products::find($products);
        $categories=ProductCategories::with('children')->get();

        return view('admin.products.edit',compact('products','categories','SID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request,$products)
    {
        $file = $request->file('images');
        $inputs = $request->all();
        $products=Products::find($products);

        if($file) {
            $inputs['images'] = $this->uploadImages($request->file('images'),'products',["50" ,"66", "200" , "350","500"]);
        } else {
            $inputs['images'] = $products->images;
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');
        $inputs["body"]=MyProvider::_insert_text($inputs,'body');

        $products->update($inputs);

        return redirect(route('products.index',['SID' => '200']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($products)
    {
        //dd($products);
        Products::find($products)->delete();
        return redirect(route('products.index',['SID' => '200']));
    }

}
