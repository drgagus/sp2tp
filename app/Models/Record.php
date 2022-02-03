<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggalkunjungan',
        'patient_id',
        'umurtahun',
        'umurbulan',
        'umurhari',
        'pasien',
        'diag_id',
        'servicecenter_id',
        'servicesubunit_id',
        'employe_id',
        'catatan'
    ];

    public function Patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }
    
    public function Servicecenter()
    {
        return $this->belongsTo('App\Models\Servicecenter');
    }
    
    public function Servicesubunit()
    {
        return $this->belongsTo('App\Models\Servicesubunit');
    }
    
    public function Employe()
    {
        return $this->belongsTo('App\Models\Employe');
    }
    
    public function Diag()
    {
        return $this->belongsTo('App\Models\Diag');
    }
}
