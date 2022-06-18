<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function updatePassword(Request $request){
        $user = auth()->user();
        $validatedData = $request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',

        ]);
        if(!Hash::check($validatedData['current_password'],$user->password)){
            return response()->json(['message'=>'Your current password is incorrect'],401);
        }else{
            $user->password=bcrypt($validatedData['password']);
            if($user->save()) {
                return ['message' => 'Password was updated successfully'];
            }else{
                return response()->json(['message'=>'Some error happened!',500]);
            }
        }



    }

    public function updateProfile(Request $request){
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.auth()->user()->id,
        ]);

        if(auth()->user()->update($validatedData)){
            return ['message'=>'Profile was updated successfully'];
        }else{
            return response()->json(['message'=>'Some error happened!',500]);
        }
    }
}
