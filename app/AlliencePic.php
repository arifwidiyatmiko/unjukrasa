<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlliencePic extends Model
{
    protected $table = 'allience_pic';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'name', 'phone','id_allience'];

    function demonstration()
    {
        return $this->belongsTo('App\Demonstration', 'id_allience', 'id');
    }

    public function allience(Type $var = null)
    {
        return $this->belongsTo('App\Aliance', 'id_allience', 'id');
    }
}