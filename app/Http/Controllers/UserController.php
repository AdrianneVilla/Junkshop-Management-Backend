<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createUser(Request $request){
      
       User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'middle_name' => $request->middle_name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
      ]);

       return response()->json([
        'success' => true,
        'message' => 'User created successfully'
       ]);
    }

    public function getAllUser(){
      $user = User::get();

      return response()->json([
        'success' => true,
        'message' => 'User created successfully',
        'user' => $user,
       ]);
    }
  
}
