<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        try{
            $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message' => '❌ Invalid credentials!'], 401);
        }
        $token = Str::random(60);
        $user->update(['remember_token' => $token]);
        return response()->json(['message' => '✅ Login successful!', 'token' => $token, 'user' => $user], 200);

        } catch(\Illuminate\Validation\ValidationException $e){
            return response()->json(['message' => '❌ Something wrong!', 'errors' => $e->errors()], 400);
        }
    }
    public function logout(Request $request){
        $token = str_replace('Bearer ', '', $request->header('Authorization'));
        $user = User::where('remember_token', $token)->first();
        if($user){
            $user->update(['remember_token' => null]);
    }
        return response()->json(['message' => '✅ Logout successful!'], 200);
    }
}
