<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'tanggallahir',
        'jeniskelamin',
        'village_id',
        'norm',
        'kategoripasien',
        'nojkn',
        'catatan',
    ];

    public function Village()
    {
        return $this->belongsTo('App\Models\Village');
    }

    public function Records()
    {
        return $this->hasMany('App\Models\Record');
    }
}
