<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    protected $table = 'pic';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'name', 'phone'];

    // function demonstration()
    // {
    //     return $this->belongsTo('App\Demonstration', 'id_allience', 'id');
    // }

    public function allience()
    {
        return $this->belongsTo('App\Aliance', 'id_pic', 'id');
    }
}
