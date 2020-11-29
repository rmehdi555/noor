<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Providers\MyProvider;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allSlider=Slider::all();
        return view('admin.slider.index',compact('allSlider','SID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        return view('admin.slider.create',compact('SID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        //auth()->loginUsingId(1);
        $inputs=$request->all();
        $inputs['images'] = $this->uploadImages($request->file('images'),'slider',["920-380" , "600" , "920"]);

        $inputs["title"]=MyProvider::_insert_text($inputs,'title');

        auth()->user()->slider()->create($inputs);

        return redirect(route('slider.index',['SID' => '100']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($slider)
    {
        $slider=Slider::find($slider);
        return view('admin.slider.show',compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($slider)
    {
        $slider=Slider::find($slider);
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $slider)
    {
        $file = $request->file('images');
        $inputs = $request->all();
        $slider=Slider::find($slider);

        if($file) {
            $inputs['images'] = $this->uploadImages($request->file('images'),'slider',["920-380" , "600" , "920"]);
        } else {
            $inputs['images'] = $slider->images;
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');

        $slider->update($inputs);

        return redirect(route('slider.index',['SID' => '100']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($slider)
    {
        Slider::find($slider)->delete();
        return redirect(route('slider.index',['SID' => '100']));
    }
}
