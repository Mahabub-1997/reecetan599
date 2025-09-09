<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
//            'otp' => 'required|digits:6',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)
//            ->where('otp', $request->otp)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }

        // Check OTP expiry (10 min)
        if (Carbon::parse($user->otp_created_at)->addMinutes(10)->isPast()) {
            return response()->json(['message' => 'OTP expired'], 400);
        }

        // Update password
        $user->password = Hash::make($request->password);

        // Mark verified and clear OTP
        $user->is_verified = true;
//        $user->otp = null;
        $user->otp_created_at = null;
        $user->save();

        // ✅ Log in immediately and create token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Password reset successful and logged in.',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

}
