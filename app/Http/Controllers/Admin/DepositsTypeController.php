<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepositsTypeRequest;
use App\Providers\MyProvider;
use App\DepositsType;
use Illuminate\Http\Request;

class DepositsTypeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allDepositsType=DepositsType::all();
        return view('admin.deposits-type.index',compact('allDepositsType','SID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        return view('admin.deposits-type.create',compact('SID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepositsTypeRequest $request)
    {
        DepositsType::create([
            'price'=>$request["price"],
            'type'=>$request["type"],
            'title'=>$request["title"],
            'status'=>$request["status"],
        ]);
        return redirect(route('depositsType.index',['SID' => '904']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DepositsType  $depositsType
     * @return \Illuminate\Http\Response
     */
    public function show($depositsType)
    {
        $depositsType=DepositsType::find($depositsType);
        return view('admin.deposits-type.show',compact('depositsType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DepositsType  $depositsType
     * @return \Illuminate\Http\Response
     */
    public function edit($depositsType)
    {
        $depositsType=DepositsType::find($depositsType);
        $SID=904;
        return view('admin.deposits-type.edit',compact('depositsType','SID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DepositsType  $depositsType
     * @return \Illuminate\Http\Response
     */
    public function update(DepositsTypeRequest $request, $depositsType)
    {
        $depositsType=DepositsType::find($depositsType);

        $depositsType->update([
            'price'=>$request["price"],
            'type'=>$request["type"],
            'title'=>$request["title"],
            'status'=>$request["status"],
        ]);

        return redirect(route('depositsType.index',['SID' => '904']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DepositsType  $depositsType
     * @return \Illuminate\Http\Response
     */
    public function destroy($depositsType)
    {
        DepositsType::find($depositsType)->delete();
        return redirect(route('depositsType.index',['SID' => '904']));
    }
}
