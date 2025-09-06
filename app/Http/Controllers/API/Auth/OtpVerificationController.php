<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\User;

class OtpVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->is_verified) {
            return response()->json(['message' => 'User already verified'], 400);
        }

        // Check OTP expiry (optional: 10 minutes)
        if (Carbon::parse($user->otp_created_at)->addMinutes(10)->isPast()) {
            return response()->json(['message' => 'OTP expired'], 400);
        }

        if ($user->otp != $request->otp) {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }

        $user->is_verified = true;
        $user->otp = null; // clear OTP after verification
        $user->otp_created_at = null;
        $user->save();

        return response()->json(['message' => 'OTP verified successfully']);
    }
}
