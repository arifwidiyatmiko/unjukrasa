<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'building_name','id_city','address','branch_astra','id_branch'];

    function city()
    {
        return $this->belongsTo('App\City', 'id_city', 'id');
    }
    function branch()
    {
        return $this->belongsTo('App\Branch', 'id_branch', 'id');
    }
}
