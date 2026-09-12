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
        $payoutRequests = $user->walletTransactions()->where('type', 'Payout')->orderBy('created_at', 'desc')->get();

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
        $issueTypes = \App\Models\IssueType::where('status', 1)->orderBy('sort_order', 'asc')->get();

        return view('frontend.dashboard.index', compact(
            'user',
            'sites',
            'activeSite',
            'referrals',
            'totalReferred',
            'walletTransactions',
            'payoutRequests',
            'serviceRequests',
            'openServiceRequestsCount',
            'documents',
            'notifications',
            'estimatedSavings',
            'referralPointSettings',
            'issueTypes'
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
            'stage' => 'Pending',
            'reward_amount' => $amount,
            'reward_status' => 'Pending',
            'notes' => 'Submitted via customer portal with rule: ' . $setting->title,
        ]);

        CustomerNotification::create([
            'user_id' => $user->id,
            'title' => 'Referral Submitted: ' . $request->referee_name,
            'message' => 'Your referral for ' . $request->referee_name . ' has been submitted and is pending verification. Reward of ₹' . number_format($amount, 2) . ' will be credited once verified & installed.',
            'type' => 'referral',
        ]);

        // Send Email to Admin (using GeneralHelperFunctions::getSetting('email'))
        $adminEmail = \App\MyClasses\GeneralHelperFunctions::getSetting('email');
        if (!empty($adminEmail)) {
            \App\MyClasses\MailHelper::sendMail($adminEmail, 'New Referral Submitted: ' . $request->referee_name, 'emails.admin_new_referral', [
                'referral' => $referral,
                'user' => $user
            ]);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Referral for ' . $request->referee_name . ' submitted successfully! Status is Pending review by AES team.',
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
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
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
            'status' => 'Pending',
        ]);

        // Upload multiple images if provided
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                if ($imageFile->isValid()) {
                    $ticket->addMedia($imageFile)->toMediaCollection('service_images');
                }
            }
        }

        CustomerNotification::create([
            'user_id' => $user->id,
            'title' => 'Service Request ' . $ticket->ticket_no . ' Raised',
            'message' => 'Your request for "' . $request->issue_type . '" has been logged with status Pending.',
            'type' => 'service',
        ]);

        // Send Service Request Created Email to Customer
        if ($user->email) {
            \App\MyClasses\MailHelper::sendMail($user->email, 'Service Ticket ' . $ticket->ticket_no . ' Raised Successfully', 'emails.service_request_created', [
                'user' => $user,
                'ticket' => $ticket
            ]);
        }

        // Send Email to Admin (using GeneralHelperFunctions::getSetting('email'))
        $adminEmail = \App\MyClasses\GeneralHelperFunctions::getSetting('email');
        if (!empty($adminEmail)) {
            \App\MyClasses\MailHelper::sendMail($adminEmail, 'New Service Request Logged: ' . $ticket->ticket_no, 'emails.admin_service_request', [
                'ticket' => $ticket,
                'user' => $user
            ]);
        }

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
        $maxWithdrawable = max(0, $user->wallet_balance - 5000);

        // 1. Eligibility Check: User wallet balance must be at least ₹5,000 to submit withdrawal request
        if ($user->wallet_balance < 5000) {
            return response()->json([
                'success' => false,
                'message' => 'Withdrawal requests require a minimum wallet balance of ₹5,000. Your current balance is ₹' . number_format($user->wallet_balance, 2) . '.'
            ], 422);
        }

        if ($maxWithdrawable < 1000) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum withdrawal request is ₹1,000. You need a total wallet balance of at least ₹6,000 to withdraw while retaining the required ₹5,000 minimum balance.'
            ], 422);
        }

        $amount = floatval($request->amount ?? 0);

        // 2. Minimum Request Amount Check: Minimum withdrawal request amount is ₹1,000
        if ($amount < 1000) {
            return response()->json([
                'success' => false,
                'message' => 'Minimum withdrawal request amount is ₹1,000.'
            ], 422);
        }

        // 3. Maximum Withdrawable Amount Check (must retain ₹5,000 in wallet)
        if ($amount > $maxWithdrawable) {
            return response()->json([
                'success' => false,
                'message' => 'Requested withdrawal amount (₹' . number_format($amount, 2) . ') exceeds maximum withdrawable amount (₹' . number_format($maxWithdrawable, 2) . '). A minimum balance of ₹5,000 must remain in your wallet.'
            ], 422);
        }

        $payoutDetails = $request->payout_details ? ' (' . $request->payout_details . ')' : '';

        $tx = WalletTransaction::create([
            'user_id' => $user->id,
            'type' => 'Payout',
            'amount' => $amount,
            'title' => 'Payout Request Submitted',
            'description' => 'Withdrawal request for ₹' . number_format($amount, 2) . $payoutDetails,
            'reference_type' => 'Payout',
            'status' => 'Pending',
        ]);

        CustomerNotification::create([
            'user_id' => $user->id,
            'title' => 'Withdrawal Request Received',
            'message' => 'Your withdrawal request for ₹' . number_format($amount, 2) . ' has been received with Pending status.',
            'type' => 'wallet',
        ]);

        // Send Email to Admin (using GeneralHelperFunctions::getSetting('email'))
        $adminEmail = \App\MyClasses\GeneralHelperFunctions::getSetting('email');
        if (!empty($adminEmail)) {
            \App\MyClasses\MailHelper::sendMail($adminEmail, 'New Withdrawal Request: ₹' . number_format($amount) . ' from ' . $user->name, 'emails.admin_withdraw_request', [
                'tx' => $tx,
                'user' => $user,
                'amount' => $amount
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Withdrawal request for ₹' . number_format($amount, 2) . ' submitted successfully with Pending status.',
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
