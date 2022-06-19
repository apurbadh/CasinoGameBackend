<?php

namespace App\Actions;

use App\Events\MessageEvent;
use App\Models\User;
use Illuminate\Http\Request;

class MessageAction {

    public function createAndNotify(Request $request)
    {
        $user = $request->user();
        $message = $request->message;

        $user->messages()->create(compact("message"));

        broadcast(MessageEvent::class);
    }
}
