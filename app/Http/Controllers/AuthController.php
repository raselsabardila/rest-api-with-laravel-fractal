<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transformers\UserTransformer;
use Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            "name" => "required|min:3",
            "email" => "required|email|unique:users",
            "password" => "required|min:3"
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "api_token" => bcrypt($request->email)
        ]);

        $response = fractal()
                ->item($user)
                ->transformWith(new UserTransformer)
                ->addMeta([
                    "token" => $user->api_token
                ])
                ->toArray();

        return response()->json($response,201);
    }

    public function login(Request $request,User $user){
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(["error" => "your credential was wrong"],401);
        }

        $user = $user->find(Auth::id());

        return fractal()
                ->item($user)
                ->transformWith(new UserTransformer)
                ->addMeta([
                    "token" => $user->api_token
                ])
                ->toArray();
    }
}
