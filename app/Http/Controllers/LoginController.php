<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class LoginController extends Controller
{
    public function show(){
        if(Auth::check()){
            return redirect('/home');
        }
        return view("auth.login");
    }
    public function login(LoginRequest $request){
        $credentials = $request->getCredentials();
        if(!Auth::validate($credentials)){
            return redirect()->to('/login')->withErrors('Usuario y/o contraseña fallida');
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);
        return $this->authenticated($request, $user);
    }   
    
    public function authenticated(Request $request, $user){
        if(Auth()->user()->estado == 'Activo'){
            return redirect('/home');
        }else{
            Auth::logout(); 
            return redirect('/login')->withErrors('Su cuenta es restingida.');
        }
    }


}
