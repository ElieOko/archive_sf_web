<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function login(Request $request)
    {
        # code...
        $fields = $request->validate([
            'username' => 'required|string',
            'password'=>'required|string'
        ]);
        $user = User::where('username',$fields['username'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response(
                [
                    "message"=>"Error"
                ],401
            );
        }
       // $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            //'token' => $token
        ];  
        return response($response,201);
    }

    public function register(Request $request)
    {
        # code...
        $fields = $request->validate([
            'username' => 'required|string|unique:users,username',
            'password'=>'required|string|confirmed'
        ]);
        $user = User::create([
            'username' => $fields['username'],
            'password' => bcrypt($fields['password'])
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];  
        return response($response,201);
    }
}