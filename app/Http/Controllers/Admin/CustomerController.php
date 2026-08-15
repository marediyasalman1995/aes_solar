<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CustomerDataTable;
use App\Http\Controllers\AppBaseController;
use App\Models\CustomerDocument;
use App\Models\CustomerNotification;
use App\Models\CustomerSite;
use App\Models\Referral;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Response;

class CustomerController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('permission:customers.index')->only(['index']);
        $this->middleware('permission:customers.create')->only(['create', 'store', 'storeSite', 'storeDocument']);
        $this->middleware('permission:customers.edit')->only(['edit', 'update', 'adjustWallet', 'updateReferralStage', 'updateServiceRequest']);
        $this->middleware('permission:customers.view')->only(['show']);
        $this->middleware('permission:customers.delete')->only(['destroy']);
    }

    /**
     * Display a listing of Customers.
     */
    public function index(CustomerDataTable $customerDataTable)
    {
        return $customerDataTable->render('admin.customers.index');
    }

    /**
     * Show create customer form.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a new customer.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10|unique:users,mobile',
            'email' => 'nullable|email|unique:users,email',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pincode' => 'nullable|string',
            'wallet_balance' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email ?? 'customer_' . $request->mobile . '@aesenergy.in',
            'user_type' => 'customer',
            'password' => Hash::make(Str::random(16)),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state ?? 'Maharashtra',
            'pincode' => $request->pincode,
            'wallet_balance' => $request->wallet_balance ?? 1500.00,
            'status' => 1,
        ]);

        // Create default site if specified
        if ($request->filled('site_name')) {
            CustomerSite::create([
                'user_id' => $user->id,
                'site_name' => $request->site_name,
                'capacity_kw' => $request->capacity_kw ?? 5.00,
                'system_type' => $request->system_type ?? 'On-Grid',
                'installation_date' => $request->installation_date ?? now(),
                'inverter_details' => $request->inverter_details,
                'panel_details' => $request->panel_details,
                'address' => $request->address,
                'city' => $request->city,
                'status' => 1,
            ]);
        }

        DB::commit();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Customer ' . $user->name . ' created successfully!');

        if ($request->ajax()) {
            return Response::json([
                'message' => 'Customer created successfully.',
                'back_url' => route('admin.customers.index')
            ]);
        }

        return redirect()->route('admin.customers.index');
    }

    /**
     * Show detailed customer profile and all related data (Sites, Referrals, Wallet, Service Requests, Documents).
     */
    public function show(User $customer)
    {
        $customer->load([
            'sites' => function ($q) {
                $q->orderBy('created_at', 'desc');
            },
            'referrals' => function ($q) {
                $q->orderBy('created_at', 'desc');
            },
            'walletTransactions' => function ($q) {
                $q->orderBy('created_at', 'desc');
            },
            'serviceRequests' => function ($q) {
                $q->with('site')->orderBy('created_at', 'desc');
            },
            'documents' => function ($q) {
                $q->with('site')->orderBy('created_at', 'desc');
            },
            'customerNotifications' => function ($q) {
                $q->orderBy('created_at', 'desc')->take(10);
            }
        ]);

        $documentTypes = \App\Models\DocumentType::where('status', 1)->get();
        return view('admin.customers.show', compact('customer', 'documentTypes'));
    }

    /**
     * Show edit customer form.
     */
    public function edit(User $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update customer.
     */
    public function update(Request $request, User $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10|unique:users,mobile,' . $customer->id,
            'email' => 'nullable|email|unique:users,email,' . $customer->id,
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'pincode' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        $customer->update($request->only([
            'name', 'mobile', 'email', 'address', 'city', 'state', 'pincode', 'status'
        ]));

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Customer details updated successfully!');

        if ($request->ajax()) {
            return Response::json([
                'message' => 'Customer updated successfully.',
                'back_url' => route('admin.customers.show', $customer->uuid)
            ]);
        }

        return redirect()->route('admin.customers.show', $customer->uuid);
    }

    /**
     * Delete customer.
     */
    public function destroy(User $customer)
    {
        $customer->delete();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Customer deleted successfully!');

        return Response::json(['message' => 'Customer deleted successfully.']);
    }

    /**
     * Add a new Site to a Customer from Admin.
     */
    public function storeSite(Request $request, User $customer)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'capacity_kw' => 'required|numeric|min:0.1',
            'system_type' => 'required|string',
            'installation_date' => 'nullable|date',
            'inverter_details' => 'nullable|string',
            'panel_details' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'monthly_avg_kwh' => 'nullable|numeric',
            'co2_offset_ton' => 'nullable|numeric',
        ]);

        $site = CustomerSite::create([
            'user_id' => $customer->id,
            'site_name' => $request->site_name,
            'capacity_kw' => $request->capacity_kw,
            'system_type' => $request->system_type,
            'installation_date' => $request->installation_date ?? now(),
            'inverter_details' => $request->inverter_details,
            'panel_details' => $request->panel_details,
            'address' => $request->address ?? $customer->address,
            'city' => $request->city ?? $customer->city,
            'monthly_avg_kwh' => $request->monthly_avg_kwh ?? ($request->capacity_kw * 120),
            'co2_offset_ton' => $request->co2_offset_ton ?? round($request->capacity_kw * 0.5, 2),
            'status' => 1,
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Site added successfully for ' . $customer->name);

        return redirect()->back();
    }

    /**
     * Manually Credit or Debit Customer Reward Wallet.
     */
    public function adjustWallet(Request $request, User $customer)
    {
        $request->validate([
            'type' => 'required|in:Credit,Debit',
            'amount' => 'required|numeric|min:1',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        $amount = floatval($request->amount);
        if ($request->type == 'Credit') {
            $customer->wallet_balance += $amount;
        } else {
            $customer->wallet_balance = max(0, $customer->wallet_balance - $amount);
        }
        $customer->save();

        WalletTransaction::create([
            'user_id' => $customer->id,
            'type' => $request->type,
            'amount' => $amount,
            'title' => $request->title,
            'description' => $request->description ?? 'Admin adjustment',
            'reference_type' => 'Manual',
            'status' => 'Credited',
        ]);

        CustomerNotification::create([
            'user_id' => $customer->id,
            'title' => 'Wallet ' . $request->type . ': ₹' . number_format($amount, 2),
            'message' => $request->title . ($request->description ? ' (' . $request->description . ')' : ''),
            'type' => 'wallet',
        ]);

        DB::commit();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Wallet updated successfully for ' . $customer->name);

        return redirect()->back();
    }

    /**
     * Update Referral Stage and optionally auto-credit reward to customer's wallet.
     */
    public function updateReferralStage(Request $request, Referral $referral)
    {
        $request->validate([
            'stage' => 'required|in:Contacted,Site Survey Done,Quotation Shared,Installed,Rejected',
            'reward_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();

        $oldStage = $referral->stage;
        $referral->stage = $request->stage;
        if ($request->filled('reward_amount')) {
            $referral->reward_amount = $request->reward_amount;
        }
        if ($request->filled('notes')) {
            $referral->notes = $request->notes;
        }

        // If newly installed and not credited yet, credit wallet!
        if ($request->stage == 'Installed' && $referral->reward_status != 'Credited') {
            $settingPoints = 0;
            if ($referral->referral_point_setting_id) {
                $rule = \App\Models\ReferralPointSetting::find($referral->referral_point_setting_id);
                if ($rule) {
                    $settingPoints = (float)$rule->points;
                }
            }

            $rewardAmount = $settingPoints > 0 ? $settingPoints : (float)$referral->reward_amount;
            $referral->reward_amount = $rewardAmount;

            if ($rewardAmount > 0) {
                $referral->reward_status = 'Credited';
                $referrer = $referral->referrer;

                if ($referrer) {
                    $referrer->wallet_balance += $rewardAmount;
                    $referrer->save();

                    WalletTransaction::create([
                        'user_id' => $referrer->id,
                        'type' => 'Credit',
                        'amount' => $rewardAmount,
                        'title' => 'Referral Bonus — ' . $referral->referee_name . ' Installed',
                        'description' => 'Referral installation completed successfully for ' . $referral->referee_name . ($referral->referralPointSetting ? ' (Rule: ' . $referral->referralPointSetting->title . ')' : ''),
                        'reference_type' => 'Referral',
                        'reference_id' => $referral->id,
                        'status' => 'Credited',
                    ]);

                    CustomerNotification::create([
                        'user_id' => $referrer->id,
                        'title' => 'Referral Reward Credited: ₹' . number_format($rewardAmount, 2),
                        'message' => 'Your referral ' . $referral->referee_name . ' has completed solar installation. ₹' . number_format($rewardAmount, 2) . ' credited to your wallet!',
                        'type' => 'referral',
                    ]);
                }
            }
        }

        $referral->save();
        DB::commit();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Referral stage updated to ' . $request->stage . '!');

        return redirect()->back();
    }

    /**
     * Update Service Request status & admin notes.
     */
    public function updateServiceRequest(Request $request, ServiceRequest $serviceRequest)
    {
        $request->validate([
            'status' => 'required|in:Pending,Scheduled,In Progress,Resolved,Cancelled',
            'admin_notes' => 'nullable|string',
        ]);

        $serviceRequest->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        CustomerNotification::create([
            'user_id' => $serviceRequest->user_id,
            'title' => 'Service Ticket ' . $serviceRequest->ticket_no . ' ' . $request->status,
            'message' => 'Status for your service request (' . $serviceRequest->issue_type . ') has been updated to ' . $request->status . '.',
            'type' => 'service',
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Service request status updated successfully!');

        return redirect()->back();
    }

    /**
     * Upload / Add Document for Customer.
     */
    public function storeDocument(Request $request, User $customer)
    {
        $request->validate([
            'doc_type' => 'required|string',
            'title' => 'required|string|max:255',
            'customer_site_id' => 'nullable|exists:customer_sites,id',
            'valid_until' => 'nullable|date',
            'notes' => 'nullable|string',
            'document_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:20480',
        ]);

        $data = [
            'user_id' => $customer->id,
            'customer_site_id' => $request->customer_site_id,
            'doc_type' => $request->doc_type,
            'title' => $request->title,
            'valid_until' => $request->valid_until,
            'notes' => $request->notes,
        ];

        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $fileName = 'doc_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/customer_documents');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $fileName);
            $data['file_path'] = 'uploads/customer_documents/' . $fileName;
        }

        CustomerDocument::create($data);

        CustomerNotification::create([
            'user_id' => $customer->id,
            'title' => 'New Document Available: ' . $request->title,
            'message' => 'A new warranty or installation document has been uploaded for your rooftop plant.',
            'type' => 'warranty',
        ]);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Document added successfully!');

        return redirect()->back();
    }
}
