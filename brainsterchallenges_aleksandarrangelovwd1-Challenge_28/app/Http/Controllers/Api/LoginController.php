<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            if (!auth()->user()->is_active) {
                return response()->json('You must verify your email first.', 401);
            }

            $token = auth()->user()->createToken('user-token')->plainTextToken;
            return response()->json(['access_token' => $token], 200);
        }

        return response()->json('Unauthorised access,', 401);
    }
    //
}