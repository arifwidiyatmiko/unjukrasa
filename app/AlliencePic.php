<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlliencePic extends Model
{
    protected $table = 'allience_pic';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'id_pic','id_allience'];

    function demonstration()
    {
        return $this->belongsTo('App\Demonstration', 'id_allience', 'id');
    }

    public function allience()
    {
        return $this->belongsTo('App\Aliance', 'id_allience', 'id');
    }
}