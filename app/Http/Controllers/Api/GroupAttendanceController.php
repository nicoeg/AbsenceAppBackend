<?php

namespace App\Http\Controllers\Api;

use App\Attendance;
use App\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupAttendanceController extends Controller
{
    public function index($group_id) {
        $date = request('date', Carbon::now()->addDay(2)->format('Y-m-d'));

        return Attendance::with('user')->whereHas('user', function($query) use ($group_id) {
            $query->whereHas('groups', function($query) use ($group_id) {
                $query->where('group_id', $group_id);
            });
        })->whereDate('started_at', $date)->get();
    }
}
