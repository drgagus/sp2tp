<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicesubunit extends Model
{
    use HasFactory;

    protected $fillable = [
        'poli'
    ];

    public function Servicesubunitusers()
    {
        return $this->hasMany('App\Models\Servicesubunituser');
    }
}
