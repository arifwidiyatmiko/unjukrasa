<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'name'];

    function location()
    {
        return $this->hasMany('App\Location', 'id_branch', 'id');
    }
}
