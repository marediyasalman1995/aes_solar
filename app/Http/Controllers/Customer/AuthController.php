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
     * Handle Customer Mobile + OTP Login (Fixed OTP 1234).
     */
    public function loginWithOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string|min:10|max:15',
            'otp' => 'required|string',
        ]);

        // Clean mobile number (strip +91, spaces, dashes)
        $cleanMobile = preg_replace('/[^0-9]/', '', $request->mobile);
        if (strlen($cleanMobile) > 10) {
            $cleanMobile = substr($cleanMobile, -10);
        }

        // Fixed OTP validation
        if ($request->otp !== '1234') {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP. Please enter 1234.'
                ], 422);
            }
            return back()->withErrors(['otp' => 'Invalid OTP. Please enter 1234.'])->withInput();
        }

        // Find or create customer
        $user = User::where('mobile', $cleanMobile)->first();

        if (!$user) {
            // Check if user exists by email placeholder
            $user = User::create([
                'name' => 'Customer ' . substr($cleanMobile, -4),
                'mobile' => $cleanMobile,
                'email' => 'customer_' . $cleanMobile . '@aesenergy.in',
                'user_type' => 'customer',
                'password' => Hash::make(Str::random(16)),
                'wallet_balance' => 1500.00, // Initial welcome reward bonus
                'status' => 1,
            ]);

            // Create default site for new customer
            CustomerSite::create([
                'user_id' => $user->id,
                'site_name' => 'Primary Residence',
                'capacity_kw' => 5.00,
                'system_type' => 'On-Grid',
                'installation_date' => now()->subMonths(2),
                'inverter_details' => 'AES Smart Hybrid 5kW',
                'panel_details' => 'Mono PERC 540W Tier-1 (10 Nos)',
                'monthly_avg_kwh' => 612.00,
                'co2_offset_ton' => 3.10,
                'city' => 'Pune',
                'state' => 'Maharashtra',
                'status' => 1,
            ]);

            // Welcome wallet credit transaction
            WalletTransaction::create([
                'user_id' => $user->id,
                'type' => 'Credit',
                'amount' => 1500.00,
                'title' => 'Welcome Reward Bonus',
                'description' => 'Welcome reward balance credited to your AES One account',
                'reference_type' => 'Manual',
                'status' => 'Credited',
            ]);

            // Welcome notification
            CustomerNotification::create([
                'user_id' => $user->id,
                'title' => 'Welcome to AES One!',
                'message' => 'Your solar dashboard & reward wallet are now active. Start referring to earn cash rewards.',
                'type' => 'general',
            ]);
        }

        // Authenticate via customer guard
        Auth::guard('customer')->login($user, true);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Login successful! Welcome to AES One.',
                'redirect_url' => route('customer.dashboard'),
            ]);
        }

        return redirect()->route('customer.dashboard')->with([
            'alert-type' => 'success',
            'message' => 'Welcome back, ' . $user->name . '!'
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
