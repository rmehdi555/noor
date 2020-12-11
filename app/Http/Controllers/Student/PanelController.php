<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
 * status=1ثبت نام اولیه
 * status=2ایجاد فاکتور و ارسال به درگاه پرداخت
 * status=3درخواست بررسی نهاد برای پرداخت نکردن
 * status=4تایید گرداخت نکردن
 * status=5بارگذاری مدارک
 * status=10 تایید نهایی
 */
class PanelController extends Controller
{
    public function index(Request $request)
    {
        return view('user.pages.panel');
    }
}
