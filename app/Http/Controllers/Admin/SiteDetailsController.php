<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteDetailsRequest;
use App\Providers\MyProvider;
use App\SiteDetails;
use Illuminate\Http\Request;

class SiteDetailsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allSiteDetails=SiteDetails::latest()->get();
        return view('admin.site-details.index',compact('allSiteDetails','SID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        return view('admin.site-details.create',compact('SID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiteDetailsRequest $request)
    {
        //auth()->loginUsingId(1);
        if($request->input('type')=='image')
        {
            $file=$request->file('images');
            $imagesURL=$this->uploadImages($file,'product',["300" , "600" , "900"]);
            $value="";
        }else
        {
            $imagesURL=[];
            $value=MyProvider::_insert_text($request->all(),'value');
        }
        $result=array_merge($request->all() , [ 'images' => $imagesURL]);
        $result=array_merge($result , [ 'value' => $value]);


        auth()->user()->siteDetails()->create($result);

        return redirect(route('siteDetails.index',['SID' => '900']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteDetails  $siteDetails
     * @return \Illuminate\Http\Response
     */
    public function show($siteDetails)
    {
        $siteDetails=SiteDetails::find($siteDetails);
        return view('admin.site-details.show',compact('siteDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteDetails  $siteDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($siteDetails)
    {
        //auth()->loginUsingId(1);
        $siteDetails=SiteDetails::find($siteDetails);
        return view('admin.site-details.edit',compact('siteDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteDetails  $siteDetails
     * @return \Illuminate\Http\Response
     */
    public function update(SiteDetailsRequest $request, $siteDetails)
    {
       // auth()->loginUsingId(1);
        $inputs = $request->all();
        $inputs['value']=MyProvider::_insert_text($inputs,'value');
        $siteDetails=SiteDetails::find($siteDetails);
        if($request->input('type')=='image')
        {
            $file = $request->file('images');
            if($file) {
                $inputs['images'] = $this->uploadImages($request->file('images'),'product',["300" , "600" , "900"]);
            } else {
                $inputs['images'] = $siteDetails->images;
            }
        }else
        {
            $inputs['images'] = $siteDetails->images;
        }


        $siteDetails->update($inputs);

        return redirect(route('siteDetails.index',['SID' => '900']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteDetails  $siteDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy($siteDetails)
    {
        SiteDetails::find($siteDetails)->delete();
        return redirect(route('siteDetails.index',['SID' => '900']));
    }
}
