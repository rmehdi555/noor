<?php

/* class
 * status=1 تازه ایجاد شده
 * status=2 در حال برگزاری
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
        'user_id','field_id', 'field_parent_id', 'name','mark_type','mark_type_id','exam_id','description','number_students','old','city','province','address','type','status',
    ];

    protected $dates = ['deleted_at'];

    public function exam()
    {
        return $this->hasOne(Exams::class,'id','exam_id');
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
