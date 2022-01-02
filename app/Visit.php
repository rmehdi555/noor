<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visit extends Model
{

    public function getAllUser()
    {
        return static::all()->groupBy('ip')->count();
//        return DB::table('visits')
//            ->groupBy('ip')
//            ->count();
    }
    public function getAllPage()
    {
        return static::count();
    }
    public function getAllUserToday()
    {
        return static::whereDate('created_at', Carbon::today())->get()->groupBy('ip')->count();
    }
    public function getAllPageToday()
    {
        return static::whereDate('created_at', Carbon::today())->get()->count();
    }
}
