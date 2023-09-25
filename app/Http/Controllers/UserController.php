<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tinvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            $fields = $request->validate([
                'UserName' => 'required|string',
                'UserPass'=>'required|string',
            ]);
            $user = User::where('UserName',$fields['UserName'])->first();
            if(!$user || !Hash::check($fields['UserPass'], $user->UserPass)){
                return response(
                    [
                        "message"=>"Utilisateur non trouvé"
                    ],200
                );
            }
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
               'user' => $user,
               'token'=> $token
            ];  
            return response($response,201);
        } catch (\Throwable $th) {
            $response = ['message' => $th->getMessage()]; 
            return  $response;
        }
    }
    public function register(Request $request)
    {
        $fields = $request->validate([
            'UserName' => 'required|string|unique:TUsers,UserName',
            'UserPass'=>'required_with:password_confirmation|same:password_confirmation',
            'BranchFId'=>'required|int',
            'Admin'=>'integer',
        ]);
        $user = User::create([
            'UserName' => $fields['UserName'],
            'UserPass' => bcrypt($fields['UserPass']),
            'BranchFId' => $fields['BranchFId'],
            'Admin'=>$fields['Admin'],
            "DbUser"=>$fields['UserName'],
            "DbPass"=>$fields['UserPass']
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];  
        return response($response,201);
    }
    public function filter(Request $request)
    {   
        $response = [];
        if(count(User::where("UserName",request('UserName'))->get())>=1){
            $query =Tinvoice::query()->when((User::where("UserName",request('UserName'))->get())[0]->UserId, function ($q) {
                return $q->where('UserFId', (User::where("UserName",request('UserName'))->get())[0]->UserId);
            })->with('user.branch', 'invoicekey', 'directory',"pictures");
            $data = ($query->paginate(5));
            $response =  $data;
        }
        return response($response,201);
    }


    public function getAllUser()
    {
        $user = User::all();
        return response($user,201);
    }
    
}
