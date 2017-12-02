<?php

namespace App\Http\Controllers\Api;

use App\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller {
    public function Index() {
        return response()->json(Attendance::all());
    }

    public function Show($id) {
        return response()->json(Attendance::find($id));
    }
    public function Store() {
        $attendance = Attendance::create([
            "started_at" => request('started_at'),
            "latitude" => request('latitude') ? request('latitude') : null,
            "longitude" => request('longitude') ? request('longitude') : null,
            "user_id" => request('user_id')
        ]);

        return response()->json($attendance->id);
    }

    public function Update() {
        Attendance::where('id', request('attendance_id'))
                  ->where('user_id', request('user_id'))
                  ->update([
                      "ended_at" => request('ended_at'),
                  ]);

        return response('Attendance Updated');
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
