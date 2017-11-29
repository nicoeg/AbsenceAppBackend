<?php

namespace App\Http\Controllers\Api;

use App\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller {
    public function Index() {
        return Attendance::all();
    }

    public function Store() {
        Attendance::create([
            "started_at" => request('started_at'),
            "user_id" => request('user_id')
        ]);

        return response('Attendance registered');
    }

    public function Update() {
        Attendance::where('id', request('attendance_id'))
                  ->where('user_id', request('user_id'))
                  ->update([
                      "ended_at" => request('ended_at'),
                  ]);

        return response('Attendance Updated');
    }

    public function AttendanceOutsideSchool() {
        Attendance::create([
            "started_at" => request('started_at'),
            "latitude" => request('latitude'),
            "longitude" => request('longitude'),
            "user_id" => request('user_id')
        ]);

        return response('Attendance registered');
    }

    public function AcceptAttendance() {
        Attendance::where('id', request('attendance_id'))
                  ->where('user_id', request('user_id'))
                  ->update([
                      "accepted" => true,
                  ]);
        return response('Attendance accepted');
    }

    public function DeclineAttendance() {
        Attendance::where('id', request('attendance_id'))
                  ->where('user_id', request('user_id'))
                  ->update([
                      "accepted" => false,
                  ]);
        return response('Attendance declined');
    }
}
