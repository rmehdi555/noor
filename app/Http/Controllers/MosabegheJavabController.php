<?php

namespace App\Http\Controllers;

use App\MosabegheJavabNaghashi;
use App\MosabegheMalekeZaman;
use App\MosabegheMalekeZamanNazar;
use Carbon\Carbon;
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
        $request->meli_number=\App\Providers\MyProvider::convert_phone_number($request->meli_number);
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

    public function naghashiSave(Request $request)
    {
        $request->validate([
            'user_meli_number' => ['required', 'numeric', 'digits:10'],
            'user_mosabeghe_id' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'file_url' => 'required|max:2048|mimes:jpeg,png,bmp,jpg,jpeg,bmp',
        ]);
        $mosabegheMalekeZaman = MosabegheMalekeZaman::where([['meli_number','=',$request->user_meli_number],['id','=',$request->user_mosabeghe_id]])->get()->first();
        if(!isset($mosabegheMalekeZaman->id))
        {
            return back()->withErrors(['code'=>'کاربری با این مشخصات در مسابقه ثبت نام نکرده است .']);
        }
        $file=$request->file('file_url');
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $imagePath = "/upload/file/mosabeghe-maleke-zaman/{$year}/{$month}/";
        $filename = $file->getClientOriginalName();
        $filename=explode('.',$filename);
        $filename=end($filename);
        $filename = $request->user_meli_number.'-'.$request->user_mosabeghe_id.'.'.$filename;
        $file = $file->move(public_path($imagePath) , $filename);
        $url=$imagePath .$filename;
        MosabegheJavabNaghashi::create([
            'mosabeghe_name' => 'مالک زمان',
            'file_url' => $url,
            'description' => $request->description,
            'user_meli_number' => $request->user_meli_number,
            'user_mosabeghe_id' => $request->user_mosabeghe_id,
        ]);
        if($mosabegheMalekeZaman->status==0)
        {
            $status=2;
        }
        if($mosabegheMalekeZaman->status==1)
        {
            $status=3;
        }
        $mosabegheMalekeZaman->update([
            'status'=>$status,
        ]);
        $type="هنرنمایی در قاب نقاشی";
        return view('web.pages.mosabeghe-nazar',compact('mosabegheMalekeZaman','type'));
    }

    public function nazarSave(Request $request)
    {
        $mosabegheMalekeZaman = MosabegheMalekeZaman::where([['meli_number','=',$request->user_meli_number],['id','=',$request->user_mosabeghe_id]])->get()->first();
        if(!isset($mosabegheMalekeZaman->id))
        {
            return redirect()->route('web.mosabeghe.javab.login')->withErrors(['code'=>'کاربری با این مشخصات در مسابقه ثبت نام نکرده است .']);
        }
        foreach ($request->title as $key=>$value)
        {
            MosabegheMalekeZamanNazar::create([
                'type' => $request->type,
                'title' => $request->title[$key],
                'value' => $request->value[$key],
                'user_meli_number' => $request->user_meli_number,
                'user_mosabeghe_id' => $request->user_mosabeghe_id,
            ]);
        }
        return redirect()->route('web.mosabeghe.end');

    }
    public function end()
    {
        return view('web.pages.mosabeghe-end');
    }
}
