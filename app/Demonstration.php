<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demonstration extends Model
{
    protected $table = 'demonstration';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'date','id_location','id_pic','id_allience','rengiat','status','issue','basis_universitas','mass_amount'];

    function location()
    {
        return $this->hasOne('App\Location', 'id', 'id_location');
    }

    function alliencePic()
    {
        return $this->hasOne('App\AlliencePic', 'id', 'id_pic');
    }
    function allience()
    {
        return $this->hasOne('App\AlliencePic', 'id', 'id_allience');
    }
}
