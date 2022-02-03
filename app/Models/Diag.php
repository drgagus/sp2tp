<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diag extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode1',
        'kode2',
        'kode3',
        'diagnosa'
    ];
}
