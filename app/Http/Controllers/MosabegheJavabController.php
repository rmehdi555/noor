<?php

namespace App\Http\Controllers;

use App\MosabegheMalekeZaman;
use Illuminate\Http\Request;

class MosabegheJavabController extends Controller
{
    private $mosabegheTimeTest=true;
    private $mosabegheTimeNaghashi=true;
    private $mosabegheTimeTestPasokh=false;
    public function login()
    {
        return view('web.pages.mosabeghe-javab-login');
    }
    public function loginCheck(Request $request)
    {
        $request->validate([
            'meli_number' => ['required', 'numeric', 'digits:10'],
            'id' => ['required', 'numeric'],
            'type' => ['required', 'array', 'max:191'],
            'type.*' => ['required', 'string', 'max:191'],
        ]);
        $nextM=false;

        $mosabegheMalekeZaman = MosabegheMalekeZaman::where([['meli_number','=',$request->meli_number],['id','=',$request->id]])->get()->first();
        if(!isset($mosabegheMalekeZaman->id))
        {
            return back()->withErrors(['code'=>'کاربری با این مشخصات در مسابقه ثبت نام نکرده است .']);
        }
        if($this->mosabegheTimeTestPasokh)
        {
            return view('web.pages.mosabeghe-pasohk',compact('mosabegheMalekeZaman'));
        }

        if(count($request->type)==2)
        {
            $nextM=true;
            if(!$this->mosabegheTimeTest)
            {
                return back()->withErrors(['code'=>'در حال حاظر امکان شرکت در آزمون کتاب خوانی وجود ندارد']);
            }
            if(!$this->mosabegheTimeNaghashi)
            {
                return back()->withErrors(['code'=>'در حال حاظر امکان شرکت در آزمون هنرنمایی در قاب نقاشی وجود ندارد']);
            }
            return view('web.pages.mosabeghe-javab-test',compact('mosabegheMalekeZaman','nextM'));
        }else if(in_array('کتاب خوانی',$request->type))
        {
            if(!$this->mosabegheTimeTest)
            {
                return back()->withErrors(['code'=>'در حال حاظر امکان شرکت در آزمون کتاب خوانی وجود ندارد']);
            }
            return view('web.pages.mosabeghe-javab-test',compact('mosabegheMalekeZaman','nextM'));
        }else{
            if(!$this->mosabegheTimeNaghashi)
            {
                return back()->withErrors(['code'=>'در حال حاظر امکان شرکت در آزمون هنرنمایی در قاب نقاشی وجود ندارد']);
            }
            return view('web.pages.mosabeghe-javab-naghashi',compact('mosabegheMalekeZaman'));
        }

    }
}
