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
            'otp' => 'required|digits:6',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid OTP'], 400);
        }

        if (Carbon::parse($user->otp_created_at)->addMinutes(10)->isPast()) {
            return response()->json(['message' => 'OTP expired'], 400);
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->otp_created_at = null;
        $user->save();

        return response()->json(['message' => 'Password reset successful']);
    }
}
