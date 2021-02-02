<?php

namespace App\Http\Controllers\Admin;

use App\Cities;
use App\Http\Controllers\Controller;
use App\MosabegheMalekeZaman;
use App\Provinces;
use App\Students;
use Illuminate\Http\Request;

class MosabegheMalekeZamanController extends Controller
{
    public function index(Request $request)
    {
        $SID=$request->SID;
        $fields=MosabegheMalekeZaman::all();
        return view('admin.mosabeghe-maleke-zaman.index',compact('fields','SID'));

    }
    public function edit($field)
    {
        $SID="70";
        $field=MosabegheMalekeZaman::find($field);
        $provinces = Provinces::all();
        $cities = Cities::all();
        $field->type=explode("&", $field->type);
        return view('admin.mosabeghe-maleke-zaman.edit',compact('field','provinces','cities','SID'));
    }
    public function update(Request $request,$fieldId)
    {
        $field=MosabegheMalekeZaman::find($fieldId);
        $request->phone=\App\Providers\MyProvider::convert_phone_number($request->phone);
        $request->validate([
            'name' => ['required', 'string', 'max:191'],
            'family' => ['required', 'string', 'max:191'],
            'f_name' => ['required', 'string', 'max:191'],
            'meli_number' => ['required', 'numeric', 'digits:10','unique:mosabeghe_maleke_zamen,meli_number,'.$fieldId],
            'phone' => ['required', 'numeric', 'digits:11'],
            'city' => ['required', 'string', 'max:191'],
            'province' => ['required', 'string', 'max:191'],
            'address' => ['required', 'string', 'max:191'],
            'type' => ['required', 'array', 'max:191'],
            'type.*' => ['required', 'string', 'max:191'],
        ]);

        $request->type=implode("&",$request->type);

        $field->update([
            'name' => $request->name,
            'family' => $request->family,
            'f_name' => $request->f_name,
            //'meli_number' => $request->meli_number,
            'phone' => \App\Providers\MyProvider::convert_phone_number($request->phone),
            'city' => $request->city,
            'province' => $request->province,
            'address' => $request->address,
            'type' =>$request->type,
        ]);

        alert()->success(__('admin/messages.success_save_form'), __('web/messages.success'));
        return redirect(route('mosabeghe.index',['SID' => '70']));
    }
}
