<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MethodOfLetterRequest;
use App\MethodOfLetter;
use App\Providers\MyProvider;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MethodOfLetterController extends AdminController
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $SID=$request->SID;
        $methodOfLetters=MethodOfLetter::all();
        return view('admin.method-of-letter.index',compact('methodOfLetters','SID'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $SID=$request->SID;
        return view('admin.method-of-letter.create',compact('SID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MethodOfLetterRequest $request)
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $inputs=$request->all();
        $urlFile=null;
        $file = $request->file('file');
        if ($file) {
            $urlFile = $this->uploadImage($request->file('file'), 'admin');
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        MethodOfLetter::create([
            'user_id'=>$user->id,
            'title'=>$inputs["title"],
            'file_url'=>$urlFile,
            'status'=>1,
        ]);

        return redirect(route('methodOfLetter.index',['SID' => '530']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MethodOfLetter  $methodOfLetter
     * @return \Illuminate\Http\Response
     */
    public function show($methodOfLetter)
    {
        $SID=530;
        $methodOfLetter=MethodOfLetter::find($methodOfLetter);
        return view('admin.method-of-letter.show',compact('methodOfLetter','SID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MethodOfLetter  $methodOfLetter
     * @return \Illuminate\Http\Response
     */
    public function edit($methodOfLetter)
    {
        $SID=530;
        $methodOfLetter=MethodOfLetter::find($methodOfLetter);
        return view('admin.method-of-letter.edit',compact('methodOfLetter','SID'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MethodOfLetter  $methodOfLetter
     * @return \Illuminate\Http\Response
     */
    public function update(MethodOfLetterRequest $request,$methodOfLetter)
    {
        $methodOfLetter=MethodOfLetter::find($methodOfLetter);

        $user=Auth::user();
        $user=User::find($user->id);
        $inputs=$request->all();
        $urlFile=$methodOfLetter->file_url;
        $file = $request->file('file');
        if ($file) {
            $urlFile = $this->uploadImage($request->file('file'), 'admin');
        }
        $inputs["title"]=MyProvider::_insert_text($inputs,'title');
        $methodOfLetter->update([
            'title'=>$inputs["title"],
            'file_url'=>$urlFile,
            'status'=>$inputs["status"],
        ]);
        return redirect(route('methodOfLetter.index',['SID' => '530']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MethodOfLetter  $methodOfLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy($methodOfLetter)
    {
        //dd($methodOfLetter);
        MethodOfLetter::find($methodOfLetter)->delete();
        return redirect(route('methodOfLetter.index',['SID' => '530']));
    }
}
