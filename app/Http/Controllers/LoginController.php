<?php

namespace App\Http\Controllers;

use App\Http\Resources\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response ;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth.once.basic');
    }
     
    public function login(){
        $token = auth()->user()->createToken('Api Token')->accessToken;
        return Response::json(['user'=>new User(auth()->user()), 'token'=> $token] , 200);
    }
}
