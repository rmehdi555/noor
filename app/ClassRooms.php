<?php

/* class
 * status=1 تازه ایجاد شده
 * status=2 در حال برگذاری
 * status=4 آزمون
 * status=5 اتمام رسیده
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRooms extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','field_id', 'field_parent_id', 'name','description','number_students','old','city','province','address','status',
    ];

    protected $dates = ['deleted_at'];


    public function fieldid()
    {
        return $this->hasOne(Field::class,'id','field_id');
    }
    public function fieldParentId()
    {
        return $this->hasOne(Field::class,'id','field_parent_id');
    }
}
