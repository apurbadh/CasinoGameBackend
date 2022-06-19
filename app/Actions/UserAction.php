<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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


    public function getUser(Request $request)
    {
        $email = $request->input("email");

        return User::where("email", $email)
                    ->first();
    }


    public function secretKey(){

        return Str::random(12);
    }


}
