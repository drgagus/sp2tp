<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicesubunituser extends Model
{
    use HasFactory;

    protected $fillable = [
        'servicesubunit_id',
        'employe_id'
    ];

    public function Employe()
    {
        return $this->belongsTo('App\Models\Employe');
    }
    
    public function Servicesubunit()
    {
        return $this->belongsTo('App\Models\Servicesubunit');
    }
}
