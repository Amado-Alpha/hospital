<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attandance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Nurse()
    {
        return $this->belongsTo(Nurse::class, 'nurse_id');
    }
}
