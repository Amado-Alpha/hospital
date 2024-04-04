<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use Twilio\Rest\Client; 


class smsWithTwilio
{

    public function sendSms($fullName, $bedNumber, $phoneNumber)
    {
        
        $message = '⚠️⚠️⚠️ EMERGENCY  Hello ' .$fullName. ' a patient of bed number ' .$bedNumber. 
                   ' from ward No. 14  requires immidiate help!';

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $fromNumber = env('TWILIO_FROM');
       
        try {
            $client = new Client($sid, $token);
            $client->messages->create('+'.$phoneNumber, [
                'from' => $fromNumber,
                'body' => $message
            ]);

            return 'SMS Sent Successfully.';
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
