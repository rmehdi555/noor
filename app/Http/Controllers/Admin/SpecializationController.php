<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SpecializationRequest;
use App\Providers\MyProvider;
use App\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $allSpecialization=Specialization::latest()->get();
        return view('admin.specialization.index',compact('allSpecialization','SID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        return view('admin.specialization.create',compact('SID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecializationRequest $request)
    {
        $inputs=$request->all();
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');
        auth()->user()->specialization()->create($inputs);

        return redirect(route('specialization.index',['SID' => '51']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function show($specialization)
    {
        $SID='51';
        $specialization=Specialization::find($specialization);
        return view('admin.specialization.show',compact('specialization','SID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function edit($specialization)
    {
        //auth()->loginUsingId(1);
        $SID='51';
        $specialization=Specialization::find($specialization);
        return view('admin.specialization.edit',compact('specialization','SID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function update(SpecializationRequest $request, $specialization)
    {
        // auth()->loginUsingId(1);
        $inputs=$request->all();
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $inputs["description"]=MyProvider::_insert_text($inputs,'description');

        $specialization=Specialization::find($specialization);
        $specialization->update($inputs);

        return redirect(route('specialization.index',['SID' => '51']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function destroy($specialization)
    {
        Specialization::find($specialization)->delete();
        return redirect(route('specialization.index',['SID' => '51']));
    }
}
