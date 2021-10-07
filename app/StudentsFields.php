<?php
/*
 *
 * status=1 درخواست خرید
 * status=2 پرداخت شده
 * status=3 درحال تحصیل
 * status=5   اتمام کلاس
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentsFields extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','flag_cookie', 'field_id', 'field_parent_id', 'student_id','user_id','payment_id', 'price','status'];
    protected $dates = ['deleted_at'];

    public function scopeCreateCode()
    {
        return $this->code();
    }

    private function code()
    {
        do {
            $code = rand(100001, 999999);
            $check_code = static::where('flag_cookie','=',$code)->get();
        } while (!$check_code->isEmpty());
        return $code;
    }
}
