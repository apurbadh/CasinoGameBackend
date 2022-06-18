<?php

namespace App\Http\Controllers\Api;

use App\Actions\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function user()
    {

        return response()->json([
            "user" => UserResource::make(auth()->user())
        ]);
    }

    public function store(UserRequest $request, UserAction $action)
    {
        return response()->json([
            "message" => "Registered Sucessfully",
            "user" => UserResource::make($action->create($request))
        ], 201);
    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();
        return response()->status(205);

    }

    public function login(Request $request, UserAction $action)
    {
        $data = $action->checkValid($request->only("email", "password"));

        if ($data["success"] == true) {
            return response()->json([
                "message" => "Sucessfully Logged in",
                "user" => UserResource::make($data["user"])
            ]);
        }

        return response()->json([
            "message" => "Invalid Credientials",
            "error" => $data["error"]
        ], 422);

    }
}
