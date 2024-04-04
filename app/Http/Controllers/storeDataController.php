<?php

namespace App\Http\Controllers;

//require 'vendor/autoload.php';

use AfricasTalking\SDK\AfricasTalking;

use App\Http\Requests\AddNurseRequest;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\bedRequest;
use App\Models\Attandance;
use App\Models\Bed;
use App\Models\Nurse;
use App\Models\RequestService;
use App\Models\AttendedPatients;
use AfricasTalkingGateway;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\showDataController;
use App\Http\Services\smsWithTwilio;

class storeDataController extends Controller
{
    //add nurse
    public function addNurse(AddNurseRequest $request)
    {
        $request->validated($request->all());

        $firstNameInitials = substr($request->f_name, 0, 2);
        $lastNameInitials = substr($request->l_name, 0, 2);
        $randomNumber = mt_rand(1000, 9999);
        $nurse_number = strtoupper($firstNameInitials . $lastNameInitials . $randomNumber);
        //dd($nurse_number);
        Nurse::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'nurse_number' => $nurse_number,
        ]);

        return back()->with('success', 'Nurse is created successfully!');
    }

    //delete nurse
    public function deleteNurse(Request $request)
    {
        $delete = Nurse::find($request->nurse_id);
        $delete->Attandance()->delete();
        $delete->delete();
        return back()->with('success', 'Nurse is deleted successfully!');
    }

    //nurseOnDuty function
    public function nurseAttendance(AttendanceRequest $request)
    {
        $request->validated($request->all());
        $nurse = Nurse::where('nurse_number', $request->nurse_number)->first();

        if ($request->action == 'signin') {
            //perform sign in action
            if ($nurse) {
                $nurse_today = Attandance::where('nurse_id', $nurse->id)
                    ->whereDate('created_at', \today())
                    ->exists();
                if (!$nurse_today) {
                    Attandance::create([
                        'nurse_id' => $nurse->id,
                    ]);
                    return back()->with('success', 'Welcome! You are in, happy shift 🤗.');
                } else {
                    return back()->with('error', 'Sorry, Signed in already today .');
                }
            } else {
                return back()->with('error', 'Invalid Nurse ID!');
            }
        } else if ($request->action == 'signout') {
            //perform sign out action
            if ($nurse) {
                $nurse_today = Attandance::where('nurse_id', $nurse->id)
                    ->whereDate('created_at', \today())
                    ->first();
                if ($nurse_today) {
                    if ($nurse_today->created_at == $nurse_today->updated_at) {
                        $nurse_today->update([
                            'updated_at' => \now(),
                        ]);
                        return back()->with('success', 'See you on the next shift 🖐');
                    } else {
                        return back()->with('error', 'Sorry! Signed out already today');
                    }
                } else {
                    return back()->with('error', 'Please! login first 👇');
                }
            } else {
                return back()->with('error', 'Invalid Nurse ID! 😢');
            }
        }
    }

    //register bed
    public function addBed(bedRequest $request)
    {
        $request->validated($request->all());

        Bed::create(['bed_number' => $request->bed_number]);
        return back()->with('success', 'Bed is created successfully!');
    }

    //delete bed
    public function deleteBed(Request $request)
    {
        Bed::find($request->bed_id)->delete();
        return back()->with('success', 'Bed is deleted successfully!');
    }

    // sending request function
    public function sendingRequest($bed_number)
    {
        // Active Nurse information
        $attendNurseInfo = new showDataController();
        $data = $attendNurseInfo->attendNurseInfo();
        
        $nursesOnDuty = $data['nurseAttendance'];
        //dd($nursesOnDuty);

        // Returns all nurses
        $allNurses = $data['nurseinfo'];
        // dd($allNurses);

        if (!$nursesOnDuty || !$allNurses) {
            return response('Invalid nurse information');
        }

        $fullName = '';
        $phoneNumber = '';
        //end of nurse information
        
        $bed = Bed::where('bed_number', $bed_number)->first();
        if ($bed) {
            $bed_number = $bed->bed_number;
            $currentDate = date('Y-m-d');

            // Check if a bed has already requested service on a particular day
            $serviceRequestingBed = RequestService::where('bed_number', $bed_number)
                ->whereDate('created_at', $currentDate)
                ->first();

            if ($serviceRequestingBed) {

                if ($serviceRequestingBed->status == 0) {
                    $serviceRequestingBed->update([
                        'status' => 1,
                        'click_times' => $serviceRequestingBed->click_times + 1,
                    ]);

                    foreach ($nursesOnDuty as $nurseOnDuty) {
                        $nurse = $allNurses->where('id', $nurseOnDuty->nurse_id)->first();
                        if ($nurse) {
                            $fullName = $nurse->f_name;
                            $phoneNumber = $nurse->phone_number;
                            $smsWithTwilio = new smsWithTwilio();
                            $smsWithTwilio->sendSms($fullName, $bed_number, $phoneNumber);
                        }
                    }
                    return response('Requesting service again today.');

                } else {
                    foreach ($nursesOnDuty as $nurseOnDuty) {
                        $nurse = $allNurses->where('id', $nurseOnDuty->nurse_id)->first();
                        if ($nurse) {
                            $fullName = $nurse->f_name;
                            $phoneNumber = $nurse->phone_number;
                         
                            //Creating a new record on attended_patients table
                            AttendedPatients::create([
                                'bed_number' => $bed_number,
                                'nurse_id' => $nurse->nurse_number,
                            ]);

                        }
                    }

                    $serviceRequestingBed->update(['status' => 0]);
                    return response('Patient already attended ♥♥♥');
                }
            } else {

                // Create a new request for the current date
                RequestService::create([
                    'bed_number' => $bed_number,
                    'click_times' => 1,
                ]);

                foreach ($nursesOnDuty as $nurseOnDuty) {
                    $nurse = $allNurses->where('id', $nurseOnDuty->nurse_id)->first();
                    // dd($nurse);
                    if ($nurse) {
                        $fullName = $nurse->f_name;
                        $phoneNumber = $nurse->phone_number;
                        $smsWithTwilio = new smsWithTwilio();
                        $smsWithTwilio->sendSms($fullName, $bed_number, $phoneNumber);
                        // $this->sendSMSWithVonageAPI();
                        // $nurse->notify(new NotifyNurseOnSite());
                    }
                }
                return response('Requesting service for the first time today');
            }
        } else {
            return response('invalid');
        }
    }

    //function to send SMS
    // public function sendSms($fullName, $benNumber, $phoneNumber)
    public function sendSms()
    {
        // $api_key = '79093d2c66b12e48';
        $api_key = 'd337933f775bab53';
        // $secret_key = 'ZmNiZGE5YzhkYWRhZjA2OTgyMWUyMzg3ZTk5MGNjZmE2ZTIzZTUxYzg0NmIxNGY4YjVkOWVjNzQ5ZTExY2ZmMg==';
        $secret_key = 'NzIxYTM1YTRjZjZmM2ZlMjcxOTc2MTIwNzUxZDIxZDJhOGQ1MzFiNzgzYjYzYmRhMjFlMDIzZTdkZWU3YjQyOQ==';
        $postData = array(
            'source_addr' => 'INFO',
            'encoding' => 0,
            'schedule_time' => '',
            'message' => 'Emergency! A patient of bed number',
            'recipients' => [array('recipient_id' => '1', 'dest_addr' => '255718583861')]
        );

        $Url = 'https://apisms.beem.africa/v1/send';

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if ($response === FALSE) {
            $error = curl_error($ch);
            return response("Error: " . $error);
        } else {
            $decodedResponse = json_decode($response, true);

            if ($decodedResponse && isset($decodedResponse['status']) && $decodedResponse['status'] == '01') {
                return response("Message sent successfully.");
            } else {
                return response("Error sending message: " . $response);
            }
        }
    }

    public function sendSMSWithVonageAPI() {
        $basic  = new \Vonage\Client\Credentials\Basic("c63739cd", "tYfPK8aKNjdWX0bc");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("255718583861", 'Emergency responders', 'A text message sent using the Nexmo SMS API')
        );
        
        $message = $response->current();
        
        if ($message->getStatus() == 0) {
            echo "The message was sent successfully\n";
        } else {
            echo "The message failed with status: " . $message->getStatus() . "\n";
        }
    }

    //call Seed-event
    public function seedEvent()
    {
        Artisan::call('migrate:fresh --seed');
        return response()->json('Succcess');
    }

    //call Optimize Event
    public function optimizeEvent()
    {
        Artisan::call('optimize:clear');
        return response()->json('Succcess');
    }

    //cache clear
    public function cacheEvent()
    {
        Artisan::call('cache:clear');
        return response()->json('success');
    }
}
