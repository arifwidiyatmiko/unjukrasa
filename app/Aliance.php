<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aliance extends Model
{
    protected $table = 'allience';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'allience_name'];

    // function demonstration()
    // {
    //     return $this->belongsTo('App\Demonstration', 'id_aliance', 'id');
    // }
}
