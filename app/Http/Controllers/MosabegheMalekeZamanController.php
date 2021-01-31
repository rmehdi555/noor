<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Http\Controllers\Controller;
use App\MosabegheMalekeZaman;
use App\Provinces;
use Illuminate\Http\Request;

class MosabegheMalekeZamanController extends Controller
{
    public function level1()
    {
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('web.pages.mosabeghe-level-1',compact('provinces', 'cities'));
    }
    public function level1Save(Request $request)
    {
        $request->phone=\App\Providers\MyProvider::convert_phone_number($request->phone);
        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'family' => ['required', 'string', 'max:191'],
            'f_name' => ['required', 'string', 'max:191'],
            'meli_number' => ['required', 'numeric', 'digits:10','unique:mosabeghe_maleke_zamen'],
            'phone' => ['required', 'numeric', 'digits:11'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);
        $mosabegheMalekeZaman = MosabegheMalekeZaman::create([
            'name' => $request->name,
            'family' => $request->family,
            'f_name' => $request->f_name,
            'meli_number' => $request->meli_number,
            'phone' => \App\Providers\MyProvider::convert_phone_number($request->phone),
            'city' => $request->city,
            'province' => $request->province,
            'address' => $request->address,
        ]);
        $this->send_sms_register_mosabeghe($mosabegheMalekeZaman->phone,$mosabegheMalekeZaman->id);
        return view('web.pages.mosabeghe-level-2',compact('mosabegheMalekeZaman'));
    }
}
