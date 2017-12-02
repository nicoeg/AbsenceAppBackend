<?php

namespace App\Http\Controllers\Api;

use App\AbsenceMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbsenceMessageController extends Controller {

    public function Index() {
        return response()->json(AbsenceMessage::all());
    }

    public function Show($id) {
        return response()->json(AbsenceMessage::find($id));
    }

    public function Store() {
        $absence_message = AbsenceMessage::create([
            "message" => request('message'),
            "started_at" => request('started_at'),
            "ended_at" => request('ended_at'),
            "user_id" => request('user_id')
        ]);
        return response()->json($absence_message->id);
    }

}
