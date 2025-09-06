<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;

class ForgotPasswordController extends Controller

{
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = rand(100000, 999999); // 6-digit OTP
        $user = User::where('email', $request->email)->first();
        $user->otp = $otp;
        $user->otp_created_at = Carbon::now();
        $user->save();

        Mail::raw("Your OTP code is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Password Reset OTP');
        });

        return response()->json(['message' => 'OTP sent to your email']);
    }
}
