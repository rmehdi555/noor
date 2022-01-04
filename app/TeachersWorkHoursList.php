<?php

/* class
 * status=1 تازه ایجاد شده
 * status=5 لیست تایید شده / پرداخت شده
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachersWorkHoursList extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','teacher_id', 'name', 'description', 'price_hours','hours',
        'a_description','a_price','k_description','k_price','totalSum',
        'card_name','card_number','sheba_number','bank_name','status'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
