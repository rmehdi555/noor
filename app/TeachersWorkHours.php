<?php

/* class
 * status=1 تازه ایجاد شده
 * status=2 لیست پرداخت برای آن ایجاد شده / درحال پرداخت هست
 * status=5 لیست تایید شده / پرداخت شده
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachersWorkHours extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','teacher_id', 'date', 'start_date', 'end_date','teachers_work_hours_list_id','status'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
