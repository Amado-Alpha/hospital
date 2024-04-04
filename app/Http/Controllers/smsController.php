<?php

namespace App\Http\Controllers;
use Illuminate\Notifications\Facades\Vonage;
use Nexmo\Laravel\Facade\Nexmo;
use Illuminate\Http\Request;

class smsController extends Controller
{
    public function index(){
        Vonage::message()->send([
            'to' => '255718583861',
            'from' => '16105552344',
            'text' => 'Using the facade to send a message.'
        ]);
    }
}
