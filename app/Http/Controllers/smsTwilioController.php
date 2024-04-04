<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Twilio\Rest\Client; 


class smsTwilioController extends Controller
{
    public function sendSms()
    {
        $receiverNumber = '+255718583861';
        $message = 'Hello a patient of bed number requires immidiate help!';

        $sid = env('APP_NAME');
        $token = env('TWILIO_TOKEN');
        $fromNumber = env('TWILIO_FROM');
        dd($token);

        try {
            $client = new Client($sid, $token);
            $client->messages->create($receiverNumber, [
                'from' => $fromNumber,
                'body' => $message
            ]);

            return 'SMS Sent Successfully.';
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
