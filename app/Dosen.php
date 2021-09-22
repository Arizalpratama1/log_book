<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    public function log(){
        return $this->hasMany('\App\Log');
    }

    public function dosen(){
        return $this->hasOne('App\User');
    }
}
