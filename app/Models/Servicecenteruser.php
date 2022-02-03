<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicecenteruser extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicecenter_id',
        'user_id'
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function Servicecenter()
    {
        return $this->belongsTo('App\Models\Servicecenter');
    }
}
