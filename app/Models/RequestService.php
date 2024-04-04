<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestService extends Model
{
    use HasFactory;
    protected $guarded =[];

    // public function attendedPatientByNurse()
    // {
    //     return $this->belongsTo(AttendedPatients::class, 'nurse_id');
    // }

    // public function attendedPatientByBed()
    // {
    //     return $this->belongsTo(AttendedPatients::class, 'bed_number');
    // }
}
