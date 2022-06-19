<?php

namespace App\Http\Controllers\Api;

use App\Actions\MessageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessegeRequest;
use App\Http\Resources\ChatResource;
use App\Models\Message;

class ChatController extends Controller
{

    public function index()
    {
        return ChatResource::collection(
            Message::with("user")->take(50)->get()
        );
    }

    public function store(MessegeRequest $request, MessageAction $action)
    {
        $action->createAndNotify($request);

        return response()->json([
            "message" => "Message Sent Sucessfully",
            "success" => true
        ], 201);
    }


}
