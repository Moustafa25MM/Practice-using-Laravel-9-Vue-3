<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
class LoginController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
               ]);

               if (Auth::attempt($credentials))
               {
                  return response()->json([ 'status' => true ,
                                            'message' => "You Login Successfully",
                                            'userId' => Auth::id()
               ]);
               }
                   return response()->json(['status' => false ,
                                            'message' => "Invalid Email or Password",

               ]);
    }
    public function logout() {
        Auth::logout();
        return response()->json(['status' => true, 'message' => "You've been logged out"]);
      }

}
