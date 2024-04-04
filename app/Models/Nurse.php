<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Nurse extends Model
{
    use HasFactory;
    use Notifiable;
    protected $guarded = [];

    public function Attandance()
    {
        return $this->hasMany(Attandance::class, 'nurse_id');
    }

    public function routeNotificationForVonage($notification)
    {
        return $this->phone_number;
    }
}
