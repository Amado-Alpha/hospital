<?php

namespace App\Http\Controllers;

use App\Models\Attandance;
use App\Models\Bed;
use App\Models\Nurse;
use App\Models\RequestService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class showDataController extends Controller
{
    //show dashboard
    public function dashboard()
    {
        $data = $this->attendNurseInfo();

        $today = Carbon::now()->format('l j'. ' , ' .'h:i A');
        $currentDate = date('Y-m-d');
        $dayRequest = RequestService::where('status', 1)->whereDate('created_at', $currentDate)->count();

        return view('dashboard', ([
            'nurseAttendance' => $data['nurseAttendance'],
            'nurseinfo' => $data['nurseinfo'],
            'todayTime' => $today,
            'dayRequest' => $dayRequest
        ]));
    }


    //function to retrive on site nurse
    public function attendNurseInfo()
    {
        $daystart = Carbon::now()->format('Y-m-d 00:00:00');
        $dayend = Carbon::now()->format('Y-m-d 23:59:59');

        $attendance = Attandance::whereBetween('created_at', [$daystart, $dayend])
        ->whereRaw('TIME(created_at) = TIME(updated_at)')
        ->latest()->get();

        $nurseinfo = Nurse::get();

        return ([
            'nurseAttendance' => $attendance,
            'nurseinfo' => $nurseinfo
        ]);

    }

    //show nurse
    public function showNurse()
    {
        $nurse = Nurse::orderByDesc('id')->get();
        $no = 1;
        return view('nurse')->with(['nurses' => $nurse, 'no' => $no]);
    }

    //show beds
    public function showBed()
    {
        $bed = Bed::get();
        return view('bed', ['bed' => $bed]);
    }

    //show attendance
    public function attendanceRecord()
    {
        $no = 1;
        $attendance = Attandance::orderByDesc('id')->get();
        $nurseinfo = Nurse::get();

        return view('attendance')->with(['nurseAttendance' => $attendance, 'no' => $no, 'nurseinfo' => $nurseinfo]);
    }

    //show request
    public function showRequest()
    {
        $request = RequestService::latest()->get();
        return view('requestService', ['requests' => $request]);
    }
}
