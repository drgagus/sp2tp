<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicecenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'tempatpelayanan'
    ];

    public function Records()
    {
        return $this->hasMany('App\Models\Record');
    }
    
    public function Servicecenterusers()
    {
        return $this->hasMany('App\Models\Servicecenteruser');
    }
}
