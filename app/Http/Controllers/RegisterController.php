<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Exception;

class RegisterController extends Controller
{

    public function create()
    {
        //
    }

    public function store(Request $request)
    {


        try {

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'password' => 'required|string|min:8|max:255',
            ]);
            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password'])
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Registration Success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function checkEmail($email)
{
    $existingUser = User::where('email', $email)->first();
    if ($existingUser) {
        return response()->json([
            'status' => false,
            'message' => 'Email already registered'
        ]);
    } else {
        return response()->json([
            'status' => true,
            'message' => 'Email is available'
        ]);
    }
}


}
