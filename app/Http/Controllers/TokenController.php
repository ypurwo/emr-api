<?php

namespace App\Http\Controllers;
use \App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    //
    public function GetToken(Request $request)
    {
        // $request->validate([
        //     'NoPIN' => 'required',
        //     'password' => 'required',
        // ]);
    
        $user = User::where('NoPIN', $request->NoPIN)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
           return ["code"=>"error","message"=>'NoPIN / Password Salah !'];
        }
    
        return ["code"=>"ok","token"=>$user->createToken('SIMRS_API')->plainTextToken];
    }
    public function GetUser(Request $request)
    {
          return $request->user();
       
    }

    public function logout(Request $request) {
    $request->user()->token()->revoke();

    return response()->json([
       'message' => 'Successfully logged out'
    ]);
  }
}
