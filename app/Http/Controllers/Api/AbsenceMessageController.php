<?php

namespace App\Http\Controllers\Api;

use App\AbsenceMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbsenceMessageController extends Controller {

    public function Index() {
        return AbsenceMessage::all();
    }

    public function Store() {
        AbsenceMessage::create([
            "message" => request('message'),
            "started_at" => request('started_at'),
            "ended_at" => request('ended_at'),
            "user_id" => request('user_id')
        ]);
        return response('Message created');
    }

}
