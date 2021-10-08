<?php

namespace App\Http\Controllers\Teacher;

use Adlino\Locations\Facades\locations;
use App\Cities;
use App\Field;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Provinces;
use App\SiteDetails;
use App\Teachers;
use App\TeachersDocuments;
use App\TeachersFields;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use SoapClient;

/* class
 * status=1 تازه ایجاد شده
 * status=2 در حال برگذاری
 * status=4 آزمون
 * status=5 اتمام رسیده
 */
class ClassController extends TeacherController
{

    public function create()
    {
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('teacher.pages.class-create', compact('fields','provinces','cities'));
    }
}
