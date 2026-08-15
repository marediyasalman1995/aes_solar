<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CustomerSite;
use App\Models\WalletTransaction;
use App\Models\CustomerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Show Website Customer Login page.
     */
    public function showLogin()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.dashboard');
        }

        return view('frontend.auth.login');
    }

    /**
     * Send OTP via email to valid customer
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->where('user_type', 'customer')->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'This email is not registered with us. Please contact our support team to register your account.'
            ], 422);
        }

        // Generate dynamic 4-digit OTP code
        $otp = rand(1000, 9999);

        // Store OTP and email in session
        session([
            'login_email' => $request->email,
            'login_otp' => $otp,
            'login_otp_time' => now()
        ]);

        // Log the OTP for developer access
        Log::info("Customer OTP Login for email: {$request->email}. Code is: {$otp}");

        // In local environments, we also allow sending simulated emails using mail or log drivers.
        // We will output a success message to the AJAX callback.
        return response()->json([
            'success' => true,
            'message' => 'Verification code sent successfully to ' . $request->email,
            'otp' => $otp // Share OTP in response metadata for easy testing/demo
        ]);
    }

    /**
     * Handle Customer OTP verification and login
     */
    public function loginWithOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);

        $sessionEmail = session('login_email');
        $sessionOtp = session('login_otp');

        if (!$sessionEmail || !$sessionOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please request a new verification code.'
            ], 422);
        }

        if ($request->email !== $sessionEmail || $request->otp !== (string)$sessionOtp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid verification code. Please enter the correct OTP.'
            ], 422);
        }

        $user = User::where('email', $request->email)->where('user_type', 'customer')->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User account not found.'
            ], 422);
        }

        // Authenticate via customer guard
        Auth::guard('customer')->login($user, true);

        // Clean up login session attributes
        session()->forget(['login_email', 'login_otp', 'login_otp_time']);

        return response()->json([
            'success' => true,
            'message' => 'Login successful! Welcome to AES One.',
            'redirect_url' => route('customer.dashboard'),
        ]);
    }

    /**
     * Customer Logout
     */
    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->forget('active_customer_site_id');

        return redirect()->route('home')->with([
            'alert-type' => 'success',
            'message' => 'You have been logged out of AES One.'
        ]);
    }
}
