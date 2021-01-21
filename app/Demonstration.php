<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demonstration extends Model
{
    protected $table = 'demonstration';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'date','id_location','id_allience','rengiat','status','issue','basis_universitas','mass_amount'];

    function location()
    {
        return $this->hasOne('App\Location', 'id_location', 'id');
    }

    function allience()
    {
        return $this->hasOne('App\AlliencePic', 'id_allience', 'id');
    }
}
