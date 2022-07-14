<?php
/*
 *
 * status=1 پرداخت نکرده
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

    public function student()
    {
        return $this->hasOne(Students::class,'id','student_id');
    }

    private function code()
    {
        do {
            $code = rand(100001, 999999);
            $check_code = static::where('flag_cookie','=',$code)->get();
        } while (!$check_code->isEmpty());
        return $code;
    }

    public function fieldid()
    {
        return $this->hasOne(Field::class,'id','field_id');
    }
    public function fieldParentId()
    {
        return $this->hasOne(Field::class,'id','field_parent_id');
    }
}
