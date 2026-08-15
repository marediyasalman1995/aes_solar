<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerDocument;
use App\Models\CustomerNotification;
use App\Models\CustomerSite;
use App\Models\Referral;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Get authenticated customer
     */
    protected function getCustomer(): User
    {
        return Auth::guard('customer')->user();
    }

    /**
     * Main AES One Customer Dashboard View
     */
    public function index(Request $request)
    {
        $user = $this->getCustomer();

        // Ensure user has at least one site
        $sites = $user->sites()->where('status', 1)->get();
        if ($sites->isEmpty()) {
            $defaultSite = CustomerSite::create([
                'user_id' => $user->id,
                'site_name' => 'Primary Solar Plant',
                'capacity_kw' => 6.40,
                'system_type' => 'On-Grid',
                'installation_date' => now()->subMonths(3),
                'inverter_details' => 'AES Smart Hybrid 6kW',
                'panel_details' => 'Mono PERC 540W Tier-1 (12 Nos)',
                'monthly_avg_kwh' => 612.00,
                'co2_offset_ton' => 3.10,
                'address' => $user->address ?? 'Baner, Pune',
                'city' => $user->city ?? 'Pune',
                'state' => 'Maharashtra',
                'status' => 1,
            ]);
            $sites = collect([$defaultSite]);
        }

        // Active selected site
        $selectedSiteId = session('active_customer_site_id', $sites->first()->id);
        $activeSite = $sites->firstWhere('id', $selectedSiteId) ?? $sites->first();

        // Referrals
        $referrals = $user->referrals()->orderBy('created_at', 'desc')->get();
        $totalReferred = $referrals->count();

        // Wallet transactions
        $walletTransactions = $user->walletTransactions()->orderBy('created_at', 'desc')->get();

        // Service Requests
        $serviceRequests = $user->serviceRequests()->with('site')->orderBy('created_at', 'desc')->get();
        $openServiceRequestsCount = $serviceRequests->whereIn('status', ['Pending', 'Scheduled', 'In Progress'])->count();

        // Documents
        $documents = $user->documents()->with('site')->orderBy('created_at', 'desc')->get();
        if ($documents->isEmpty()) {
            // Seed default document placeholders for customer if none exist
            $defaultDocs = [
                ['doc_type' => 'Panel Warranty', 'title' => 'Panel Warranty Certificate (25-Year Linear)', 'notes' => '25-year performance warranty'],
                ['doc_type' => 'Inverter Warranty', 'title' => 'Inverter Warranty Card', 'notes' => 'Valid till 10 years from installation'],
                ['doc_type' => 'Installation Agreement', 'title' => 'Installation Agreement & Handover', 'notes' => 'Signed installation contract'],
                ['doc_type' => 'Net-Metering Approval', 'title' => 'Net-Metering Approval Certificate', 'notes' => 'DISCOM approved & commissioned'],
            ];
            foreach ($defaultDocs as $doc) {
                CustomerDocument::create([
                    'user_id' => $user->id,
                    'customer_site_id' => $activeSite->id,
                    'doc_type' => $doc['doc_type'],
                    'title' => $doc['title'],
                    'notes' => $doc['notes'],
                    'valid_until' => now()->addYears(10),
                ]);
            }
            $documents = $user->documents()->with('site')->orderBy('created_at', 'desc')->get();
        }

        // Notifications
        $notifications = $user->customerNotifications()->orderBy('created_at', 'desc')->take(10)->get();

        // Estimated bill savings calculation based on active site
        $estimatedSavings = round(($activeSite->monthly_avg_kwh ?? 600) * 7.5);

        $referralPointSettings = \App\Models\ReferralPointSetting::all();

        return view('frontend.dashboard.index', compact(
            'user',
            'sites',
            'activeSite',
            'referrals',
            'totalReferred',
            'walletTransactions',
            'serviceRequests',
            'openServiceRequestsCount',
            'documents',
            'notifications',
            'estimatedSavings',
            'referralPointSettings'
        ));
    }

    /**
     * Switch active customer site in session
     */
    public function switchSite(Request $request)
    {
        $user = $this->getCustomer();
        $siteId = $request->input('site_id');

        $site = $user->sites()->where('id', $siteId)->firstOrFail();
        session(['active_customer_site_id' => $site->id]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Switched to site: ' . $site->site_name,
                'site' => $site,
            ]);
        }

        return redirect()->route('customer.dashboard')->with([
            'alert-type' => 'success',
            'message' => 'Switched active plant to ' . $site->site_name
        ]);
    }

    /**
     * Submit Referral Manually
     */
    public function submitReferral(Request $request)
    {
        $request->validate([
            'referee_name' => 'required|string|max:255',
            'referee_mobile' => 'required|string|min:10|max:15',
            'referee_city' => 'nullable|string|max:100',
            'referral_point_setting_id' => 'required|exists:referral_point_settings,id',
        ]);

        $user = $this->getCustomer();

        $cleanMobile = preg_replace('/[^0-9]/', '', $request->referee_mobile);
        if (strlen($cleanMobile) > 10) {
            $cleanMobile = substr($cleanMobile, -10);
        }

        // Check if referral already exists
        $existing = Referral::where('referrer_id', $user->id)
            ->where('referee_mobile', $cleanMobile)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'You have already referred ' . $request->referee_name . ' (' . $cleanMobile . ').'
            ], 422);
        }

        // Fetch dynamic setting
        $setting = \App\Models\ReferralPointSetting::findOrFail($request->referral_point_setting_id);
        $amount = floatval($setting->amount);

        DB::beginTransaction();

        $referral = Referral::create([
            'referrer_id' => $user->id,
            'referral_point_setting_id' => $setting->id,
            'referee_name' => $request->referee_name,
            'referee_mobile' => $cleanMobile,
            'referee_city' => $request->referee_city ?? 'Pune',
            'stage' => 'Contacted',
            'reward_amount' => $amount,
            'reward_status' => 'Credited',
            'notes' => 'Submitted via customer portal with rule: ' . $setting->title,
        ]);

        // Adjust customer wallet immediately
        if ($setting->type == 'Credit') {
            $user->wallet_balance += $amount;
        } else {
            $user->wallet_balance = max(0, $user->wallet_balance - $amount);
        }
        $user->save();

        // Create transaction log
        WalletTransaction::create([
            'user_id' => $user->id,
            'type' => $setting->type,
            'amount' => $amount,
            'title' => $setting->title . ' — ' . $request->referee_name,
            'description' => 'Referral transaction applied for ' . $request->referee_name,
            'reference_type' => 'Referral',
            'reference_id' => $referral->id,
            'status' => 'Credited',
        ]);

        // Add customer notification
        CustomerNotification::create([
            'user_id' => $user->id,
            'title' => 'Referral Registered: ' . $setting->title,
            'message' => 'Your referral for ' . $request->referee_name . ' has been registered. Wallet adjusted by ₹' . number_format($amount, 2) . ' (' . $setting->type . ').',
            'type' => 'referral',
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Referral for ' . $request->referee_name . ' submitted successfully! Wallet adjusted based on rule: ' . $setting->title,
            'referral' => $referral,
        ]);
    }

    /**
     * Raise a Service Request
     */
    public function submitServiceRequest(Request $request)
    {
        $request->validate([
            'issue_type' => 'required|string',
            'customer_site_id' => 'nullable|exists:customer_sites,id',
            'preferred_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $user = $this->getCustomer();
        $siteId = $request->customer_site_id ?? session('active_customer_site_id') ?? optional($user->sites()->first())->id;

        $ticket = ServiceRequest::create([
            'ticket_no' => '#SR-' . rand(2000, 9999),
            'user_id' => $user->id,
            'customer_site_id' => $siteId,
            'issue_type' => $request->issue_type,
            'preferred_date' => $request->preferred_date ?? now()->addDays(2),
            'description' => $request->description,
            'status' => 'Scheduled',
        ]);

        CustomerNotification::create([
            'user_id' => $user->id,
            'title' => 'Service Request ' . $ticket->ticket_no . ' Raised',
            'message' => 'Your request for "' . $request->issue_type . '" has been logged. Our technician will visit soon.',
            'type' => 'service',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Service request ' . $ticket->ticket_no . ' submitted successfully! Our engineer will contact you.',
            'ticket' => $ticket,
        ]);
    }

    /**
     * Request Reward Wallet Payout
     */
    public function requestPayout(Request $request)
    {
        $user = $this->getCustomer();
        $amount = floatval($request->amount ?? $user->wallet_balance);

        if ($user->wallet_balance <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have sufficient reward balance for a payout request.'
            ], 422);
        }

        if ($amount > $user->wallet_balance) {
            return response()->json([
                'success' => false,
                'message' => 'Requested payout amount exceeds available balance (₹' . number_format($user->wallet_balance, 2) . ').'
            ], 422);
        }

        $tx = WalletTransaction::create([
            'user_id' => $user->id,
            'type' => 'Payout',
            'amount' => $amount,
            'title' => 'Payout Request Submitted',
            'description' => 'Payout request submitted for ₹' . number_format($amount, 2) . ' to registered bank account/UPI.',
            'reference_type' => 'Payout',
            'status' => 'Pending',
        ]);

        CustomerNotification::create([
            'user_id' => $user->id,
            'title' => 'Payout Request Received',
            'message' => 'Your payout request for ₹' . number_format($amount, 2) . ' has been received and will be processed within 48 hours.',
            'type' => 'wallet',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payout request for ₹' . number_format($amount, 2) . ' submitted successfully!',
        ]);
    }

    /**
     * Update Customer Profile
     */
    public function updateProfile(Request $request)
    {
        $user = $this->getCustomer();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pincode' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email ?? $user->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profile details updated successfully!',
            'user' => $user,
        ]);
    }

    /**
     * Mark customer notification as read
     */
    public function markNotificationRead(Request $request, $id)
    {
        $user = $this->getCustomer();
        $notification = $user->customerNotifications()->where('id', $id)->first();
        if ($notification) {
            $notification->update(['is_read' => true]);
        }

        return response()->json(['success' => true]);
    }
}
