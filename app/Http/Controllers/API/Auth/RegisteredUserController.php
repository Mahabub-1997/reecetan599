<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Create user with OTP
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_created_at' => now(),
        ]);

        // Send OTP via email
        Mail::raw("Your registration OTP is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Registration OTP');
        });

        // Create API token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'otp' => $otp // optional, remove in production
        ]);
    }
}
