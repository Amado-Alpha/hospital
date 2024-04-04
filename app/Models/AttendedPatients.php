<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendedPatients extends Model
{
    use HasFactory;
    protected $fillable = ['nurse_id', 'bed_number'];


    // public function RequestServiceByNurse()
    // {
    //     return $this->hasMany(RequestService::class, 'nurse_id');
    // }

    // public function requestServiceByBed()
    // {
    //     return $this->hasMany(RequestService::class, 'bed_number');
    // }

}
