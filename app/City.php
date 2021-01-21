<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'regencies';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'province_id','name'];

    function province()
    {
        return $this->belongsTo('App\Province', 'province_id', 'id');
    }
}
