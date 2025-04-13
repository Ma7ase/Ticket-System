<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Hash;

use Illuminate\Http\Request;

class Authentication extends Controller
{

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return $this->responseError($request, 'This email does not exist.');
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return $this->responseError($request, 'Incorrect password.');
        }
    
        // Generate OTP
        $otp = rand(100000, 999999);
        $request->session()->put('otp', $otp);
        $request->session()->put('otp_email', $user->email);

        \Log::info("Generated OTP: $otp for " . $user->email);
    
        try {
            Mail::raw("Your OTP is: $otp", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Login OTP Verification');
            });
    
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'OTP sent to your email.',
                    'redirect' => route('verify-otp.show')
                ]);
            } else {
                return redirect()->route('verify-otp.show')->with('success', 'OTP sent to your email.');
            }
    
        } catch (\Exception $e) {
            return $this->responseError($request, 'Failed to send OTP. Please check your internet connection and try again.');
        }
    }
    
    private function responseError(Request $request, $message)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message
            ], 422);
        }
    
        return back()->with('fail', $message);
    }

    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);
    
        $sessionOtp = $request->session()->get('otp');
        $sessionEmail = $request->session()->get('otp_email');
    
        if (!$sessionOtp || !$sessionEmail) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP session expired. Please login again.',
                    'redirect' => url('/')
                ], 401);
            }
    
            return redirect('/')->with('fail', 'OTP session expired. Please login again.');
        }
    
        if ($request->otp != $sessionOtp) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP. Please try again.'
                ], 422);
            }
    
            return back()->with('fail', 'Invalid OTP. Please try again.');
        }
    
        // OTP is valid
        $user = User::where('email', $sessionEmail)->first();
    
        if (!$user) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.',
                    'redirect' => url('/')
                ], 404);
            }
    
            return redirect('/')->with('fail', 'User not found.');
        }
    
        // Login the user
        $request->session()->put('loginId', $user->id);
        $request->session()->put('email', $user->email);
        $request->session()->put('user_type', $user->user_type);
    
        // Clear OTP session
        $request->session()->forget(['otp', 'otp_email']);
    
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully!',
                'redirect' => route('create_ticket.show'),
            ]);
        }
    
        return redirect()->route('create_ticket.show')->with('success', 'OTP verified successfully!');
    }    
    
}
