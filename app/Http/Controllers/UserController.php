<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transformers\UserTransformer;
use Auth;

class UserController extends Controller
{
    public function index(User $user){
        $users=$user->all();
        
        return fractal()
        ->collection($users)
        ->transformWith(new UserTransformer())
        ->toArray();
    }

    public function profile(User $user){

        $user = $user->find(Auth::id());

        return fractal()
        ->item($user)
        ->transformWith(new UserTransformer)
        ->includePosts()
        ->toArray();
    }

    public function profileById(User $user,$id){

        $user = $user->find($id);

        return fractal()
        ->item($user)
        ->transformWith(new UserTransformer)
        ->includePosts()
        ->toArray();
    }
}
