<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAction {


    public function create(Request $request) {

        $user = User::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "image" => $this->saveImage($request->file("image"))
        ]);

        return $user;

    }


    public function saveImage($image) {

        $path = $image->store("public");

        $path = str_replace("public", "/storage", $path);

        return $path;

    }


    public function checkValid($data)
    {
        $user = User::where("email", $data["email"])->first();

        if (Auth::attempt($data))
        {
            return [
                "success" => true,
                "user" => $user
            ];
        }

        if ($user) {

            return [
                "success" => false,
                "error" => "Incorrect Password"
            ];
        }

        return [
            "success" => false,
            "error" => "Invalid Email"
        ];
    }
}
