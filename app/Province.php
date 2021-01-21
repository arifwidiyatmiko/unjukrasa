<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id','name'];

    function cities()
    {
        return $this->hasMany('App\City', 'province_id', 'id');
    }
}
