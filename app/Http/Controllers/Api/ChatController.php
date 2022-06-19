<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index() {

        return ChatResource::collection(
            Message::with("user")->take(50)->get()
        );
    }

}
