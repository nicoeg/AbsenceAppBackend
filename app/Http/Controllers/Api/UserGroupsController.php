<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserGroupsController extends Controller
{
    public function index($id) {
        $user = User::find($id);
        if (auth()->user()->id !== $user->id) {
            return response()->json('forbidden', 403);
        }

        $groups = $user->groups->map(function($group) {
            $group->unaccepted = $group->users->filter(function($user) {
                return $user->Attendances()
                    ->whereDate('started_at', Carbon::now()->format('Y-m-d'))
                    ->where('accepted', 0)
                    ->exists();
            })->count();

            return $group;
        });

        return response()->json($groups);
    }
}
