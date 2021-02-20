<?php

namespace App;
/*
 * 0=>  sabt nam avalia
 * 1=>  azemone testi anjamshod
 * 2=>  azemon naghashi anjam
 * 3=>  har do azemon anjam shod
 * 4=>
 */
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MosabegheMalekeZaman extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'id','name', 'family', 'f_name','meli_number',
        'phone',  'city', 'province', 'address','status','type'];

    protected $dates = ['deleted_at'];

    public function Province()
    {
        return $this->hasOne(Provinces::class,'id','province');
    }
    public function City()
    {
        return $this->hasOne(Cities::class,'id','city');
    }

    public function javabs()
    {
        return $this->hasMany(MosabegheJavab::class,'user_mosabeghe_id','id');
    }
}
