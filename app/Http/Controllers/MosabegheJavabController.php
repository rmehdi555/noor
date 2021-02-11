<?php

namespace App\Http\Controllers;

use App\MosabegheJavab;
use App\MosabegheJavabNaghashi;
use App\MosabegheMalekeZaman;
use App\MosabegheMalekeZamanNazar;
use App\MosabegheSoal;
use App\MosabegheSoalJavab;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MosabegheJavabController extends Controller
{
    private $mosabegheTimeTest=false;
    private $mosabegheTimeNaghashi=false;
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
            $mosabegheJavabs=MosabegheJavab::where('user_mosabeghe_id','=',$mosabegheMalekeZaman->id)->take(10)->get();
            if(count($mosabegheJavabs)<10)
            {
                return back()->withErrors(['code'=>'شما در مسابقه کتابخوانی شرکت نکرده اید.']);
            }
            return view('web.pages.mosabeghe-pasokh',compact('mosabegheMalekeZaman','mosabegheJavabs'));
        }
        if($mosabegheMalekeZaman->status==3)
        {
            return back()->withErrors(['code'=>'شما در هردو آزمون شرکت کرده ایید و دیگر امکان آزمون مجدد نمیباشد.']);
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
            if($mosabegheMalekeZaman->status==1)
            {
                return back()->withErrors(['code'=>'شما در آزمون کتاب خوانی شرکت کرده اید و دیگر امکان آزمون مجدد نمیباشد .']);
            }
            if($mosabegheMalekeZaman->status==2)
            {
                return back()->withErrors(['code'=>'شما در آزمون هنرنمایی در قاب نقاشی شرکت کرده اید و دیگر امکان آزمون مجدد نمیباشد .']);
            }

            $soals=MosabegheSoal::where('type','=',rand(1,2))->get();
            return view('web.pages.mosabeghe-javab-test',compact('mosabegheMalekeZaman','nextM','soals'));
        }else if(in_array('کتاب خوانی',$request->type))
        {
            if(!$this->mosabegheTimeTest)
            {
                return back()->withErrors(['code'=>'در حال حاظر امکان شرکت در آزمون کتاب خوانی وجود ندارد']);
            }
            if($mosabegheMalekeZaman->status==1)
            {
                return back()->withErrors(['code'=>'شما در آزمون کتاب خوانی شرکت کرده اید و دیگر امکان آزمون مجدد نمیباشد .']);
            }

            $soals=MosabegheSoal::where('type','=',rand(1,2))->get();
            return view('web.pages.mosabeghe-javab-test',compact('mosabegheMalekeZaman','nextM','soals'));
        }else{
            if(!$this->mosabegheTimeNaghashi)
            {
                return back()->withErrors(['code'=>'در حال حاظر امکان شرکت در آزمون هنرنمایی در قاب نقاشی وجود ندارد']);
            }
            if($mosabegheMalekeZaman->status==2)
            {
                return back()->withErrors(['code'=>'شما در آزمون هنرنمایی در قاب نقاشی شرکت کرده اید و دیگر امکان آزمون مجدد نمیباشد .']);
            }
            return view('web.pages.mosabeghe-javab-naghashi',compact('mosabegheMalekeZaman'));
        }

    }

    public function naghashiSave(Request $request)
    {
        $mosabegheMalekeZaman = MosabegheMalekeZaman::where([['meli_number','=',$request->user_meli_number],['id','=',$request->user_mosabeghe_id]])->get()->first();
        if(!isset($mosabegheMalekeZaman->id))
        {
            return redirect()->route('web.mosabeghe.javab.login')->withErrors(['code'=>'کاربری با این مشخصات در مسابقه ثبت نام نکرده است .']);
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

    public function testSave(Request $request)
    {
        $mosabegheMalekeZaman = MosabegheMalekeZaman::where([['meli_number','=',$request->user_meli_number],['id','=',$request->user_mosabeghe_id]])->get()->first();
        if(!isset($mosabegheMalekeZaman->id))
        {
            return redirect()->route('web.mosabeghe.javab.login')->withErrors(['code'=>'کاربری با این مشخصات در مسابقه ثبت نام نکرده است .']);
        }
        foreach ($request->javabs as $key=>$value)
        {
            $pasokh=MosabegheSoalJavab::where([['soal_id','=',$key],['type','=',1]])->get()->first();
            MosabegheJavab::create([
                'soal_id' => $key,
                'javab_id' => $pasokh->id,
                'javab_user_id' => $value,
                'user_meli_number' => $request->user_meli_number,
                'user_mosabeghe_id' => $request->user_mosabeghe_id,
            ]);
        }

        if($mosabegheMalekeZaman->status==0)
        {
            $status=1;
        }
        if($mosabegheMalekeZaman->status==2)
        {
            $status=3;
        }
        $mosabegheMalekeZaman->update([
            'status'=>$status,
        ]);
        if($request->nextM)
        {
            return view('web.pages.mosabeghe-javab-naghashi',compact('mosabegheMalekeZaman'));
        }
        $type="کتاب خوانی";
        return view('web.pages.mosabeghe-nazar',compact('mosabegheMalekeZaman','type'));
    }
}
