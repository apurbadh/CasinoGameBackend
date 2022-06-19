<?php

namespace App\Http\Controllers\Api;

use App\Actions\UserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
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
        $user = $action->create($request);

        return response()->json([
            "message" => "Registered Sucessfully",
            "user" => UserResource::make($user),
            "token" => $user->createToken($action->secretKey())->plainTextToken
        ], 201);
    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();
        return response()->status(205);

    }

    public function login(UserLoginRequest $request, UserAction $action)
    {
        $user = $action->getUser($request);

        return response()->json([
            "message" => "Sucessfully Logged in",
            "user" => UserResource::make($user),
            "token" => $user->createToken($action->secretKey())->plainTextToken
        ]);

    }
}
