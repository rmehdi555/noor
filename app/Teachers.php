<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teachers extends Model
{
    use SoftDeletes;
    protected $fillable = ['flag_cookie', 'user_id','teacher_id', 'name', 'family', 'f_name', 'sh_number','meli_number', 'sh_sodor', 'tavalod_date', 'married',
        'phone_1', 'phone_2', 'phone_f', 'phone_m', 'tel', 'city', 'province',
        'address','post_number','education','job','email','number_of_children','sex','status'];
    protected $dates = ['deleted_at'];


    public function teachersFields()
    {
        return $this->hasMany(TeachersFields::class,'flag_cookie','flag_cookie');
    }
    public function teachersDocuments()
    {
        return $this->hasMany(TeachersDocuments::class,'teacher_id','id');
    }
    public function teachersProvince()
    {
        return $this->hasOne(Provinces::class,'id','province');
    }
    public function teachersCity()
    {
        return $this->hasOne(Cities::class,'id','city');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    public function documents()
    {
        return $this->hasMany(TeachersDocuments::class,'user_id','user_id');
    }
    public function teachersSpecialization()
    {
        return $this->hasMany(TeachersSpecialization::class,'teacher_id','id');
    }
}
