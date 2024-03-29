<?php

namespace App\Http\Controllers\Teacher;


use App\TeachersCardNumberBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardNumberBankController extends TeacherController
{
    public function create(Request $request)
    {
        $user=Auth::user();
        return view('teacher.pages.card-number-bank-create');
    }

    public function createSave(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'hesab_number' => ['required'],
        ]);
        $user=Auth::user();
        TeachersCardNumberBank::create([
            'user_id'=>$user->id,
            'teacher_id'=>$user->teacher->id,
            'name'=>$request->name,
            'hesab_number'=>$request->hesab_number,
            'card_number'=>$request->card_number,
            'sheba_number'=>$request->sheba_number,
            'bank_name'=>'ملی',
            'status'=>1,
        ]);
        alert()->success('اطلاعات کارت با موفقیت ثبت شد .', __('web/messages.success'));
        return redirect()->route('teacher.work.hours');
    }


}
