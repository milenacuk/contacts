<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api',['except'=>['login']]);
    }

    public function login(Request $request){
        $credentials = $request->only(['email','password']);
        $token = auth()->attempt($credentials);
        //generisi mi request koji korisnik salje,vrati token

        if(!$token){
            return response()->json([
                'message'=>'You are not authorized!'
            ],401);
        }
        return response()->json([
            'token' => $token,
            'type' => 'bearer',
            //tip tokena koji smo kreirali
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
            //usera smo dodali jer ce nam neki od podataka trebati na backend-u
        ]);
    }
}
