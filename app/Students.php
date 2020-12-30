<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use SoftDeletes;
    protected $fillable = ['flag_cookie','class_type', 'user_id','student_id', 'name', 'family', 'f_name', 'sh_number','meli_number', 'sh_sodor', 'tavalod_date', 'married',
        'phone_1', 'phone_2', 'phone_f', 'phone_m', 'tel', 'city', 'province',
        'address','post_number','education','job','email','number_of_children','sex','status'];
    protected $dates = ['deleted_at'];


    public function studentsFields()
    {
        return $this->hasMany(StudentsFields::class,'flag_cookie','flag_cookie');
    }
    public function studentsDocuments()
    {
        return $this->hasMany(StudentsDocuments::class,'student_id','id');
    }
    public function studentsProvince()
    {
        return $this->hasOne(Provinces::class,'id','province');
    }
    public function studentsCity()
    {
        return $this->hasOne(Cities::class,'id','city');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    public function documents()
    {
        return $this->hasMany(StudentsDocuments::class,'user_id','user_id');
    }
}
