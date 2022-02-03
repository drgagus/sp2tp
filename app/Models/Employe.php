<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->hasOne('App\Models\User');
    }

    public function Records()
    {
        return $this->hasMany('App\Models\Record');
    }

    public function Servicesubunitusers()
    {
        return $this->hasMany('App\Models\Servicesubunituser');
    }
}
