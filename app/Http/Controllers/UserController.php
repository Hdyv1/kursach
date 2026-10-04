<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json(["token" => $user->createToken('api')->plainTextToken]);
    }
    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json(['token' => $user->createToken('api')->plainTextToken]);
        } else {
            return response()->json(['errors' => ["password" => ["Неверный логин или пароль"]]], 401);
        }
    }
}
