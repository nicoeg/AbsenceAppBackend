<?php

namespace App\Http\Controllers\Api;

use App\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

    public function ByUser($id) {
        return response()->json(Attendance::where('user_id', $id)->get());
    }

    public function ByUserWeekly($id, $year = null, $week = null) {
        if ($year == null || $week == null) {
            $start = Carbon::now()->startOfWeek()->format('Y-m-d');
            $end   = Carbon::now()->endOfWeek()->format('Y-m-d');
        } else {
            $date  = Carbon::now()->setISODate($year, $week);
            $start = $date->startOfWeek()->format('Y-m-d');
            $end   = $date->endOfWeek()->format('Y-m-d');
        }
        DB::enableQueryLog();
        $attendances = Attendance::where('user_id', $id)
                                 ->where('started_at', '>', $start)
                                 ->where('started_at', '<', $end)
                                 ->get();
        dd(DB::getQueryLog());

        return response()->json($attendances);
    }

    public function ByUserMonthly($id, $year = null, $month = null) {
        if ($year == null || $month == null) {
            $start = Carbon::now()->startOfMonth()->format('Y-m-d');
            $end   = Carbon::now()->endOfMonth()->format('Y-m-d');
        } else {
            $date  = Carbon::now()->setISODate($year, $month);
            $start = $date->startOfMonth()->format('Y-m-d');
            $end   = $date->endOfMonth()->format('Y-m-d');
        }
        $attendances = Attendance::where('user_id', $id)
                                 ->where('started_at', '<', $start)
                                 ->where('started_at', '>', $end)
                                 ->get();

        return response()->json($attendances);
    }
}
