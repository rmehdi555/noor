<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //return redirect(route('news.index',['SID' => '20']));
        $SID=100;
        $visit=new Visit;
        $visitArray=[];
        $visitArray["getAllUser"]=$visit->getAllUser();
        $visitArray["getAllPage"]=$visit->getAllPage();
        $visitArray["getAllUserToday"]=$visit->getAllUserToday();
        $visitArray["getAllPageToday"]=$visit->getAllPageToday();
        return view('admin.panel',compact('visitArray','SID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadImageSubject()
    {
//        $year = Carbon::now()->year;
//        $month = Carbon::now()->month;
//        $imagePath = "/upload/images/{$year}/{$month}/{$type}/";
//        $filename = $file->getClientOriginalName();
    }
}
