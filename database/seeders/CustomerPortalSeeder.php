<?php

namespace Database\Seeders;

use App\Models\CustomerDocument;
use App\Models\CustomerNotification;
use App\Models\CustomerSite;
use App\Models\Referral;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\WalletTransaction;
use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerPortalSeeder extends Seeder
{
    public function run()
    {
        // 1. Ensure Admin User exists
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'AES Administrator',
                'mobile' => '9876500001',
                'password' => Hash::make('12345678'),
                'user_type' => 'admin',
                'status' => 1,
            ]
        );

        // 2. Create Sample Customer 1: Rohan Sharma (Multi-site: 2 sites)
        $rohan = User::firstOrCreate(
            ['mobile' => '9876543210'],
            [
                'name' => 'Rohan Sharma',
                'email' => 'rohan.sharma@email.com',
                'password' => Hash::make('12345678'),
                'user_type' => 'customer',
                'referral_code' => 'AES-ROHAN482',
                'wallet_balance' => 1500.00,
                'address' => 'Baner Heights, Baner Road',
                'city' => 'Pune',
                'state' => 'Maharashtra',
                'pincode' => '411045',
                'status' => 1,
            ]
        );

        // Rohan Site 1: Baner Residence
        $site1 = CustomerSite::firstOrCreate(
            ['user_id' => $rohan->id, 'site_name' => 'Baner Residence'],
            [
                'site_code' => 'AES-S-101',
                'capacity_kw' => 6.40,
                'system_type' => 'On-Grid',
                'installation_date' => now()->subMonths(4),
                'inverter_details' => 'AES Smart Hybrid 6kW Inverter',
                'panel_details' => 'Mono PERC 540W Tier-1 (12 Modules)',
                'monthly_avg_kwh' => 612.00,
                'co2_offset_ton' => 3.10,
                'address' => 'Baner Heights, Baner Road',
                'city' => 'Pune',
                'state' => 'Maharashtra',
                'status' => 1,
            ]
        );

        // Rohan Site 2: Chakan Workshop (Multi-site demonstration)
        $site2 = CustomerSite::firstOrCreate(
            ['user_id' => $rohan->id, 'site_name' => 'Chakan Workshop'],
            [
                'site_code' => 'AES-S-102',
                'capacity_kw' => 12.00,
                'system_type' => 'Hybrid',
                'installation_date' => now()->subMonths(2),
                'inverter_details' => 'Growatt 12kW Commercial Hybrid Inverter',
                'panel_details' => 'Bi-facial 550W Tier-1 (22 Modules)',
                'monthly_avg_kwh' => 1420.00,
                'co2_offset_ton' => 7.20,
                'address' => 'Plot 48, MIDC Phase 2',
                'city' => 'Chakan',
                'state' => 'Maharashtra',
                'status' => 1,
            ]
        );

        // Referrals for Rohan
        Referral::firstOrCreate(
            ['referrer_id' => $rohan->id, 'referee_name' => 'Priya Nair'],
            [
                'referee_mobile' => '9822100101',
                'referee_city' => 'Pune',
                'stage' => 'Installed',
                'reward_amount' => 500.00,
                'reward_status' => 'Credited',
                'notes' => '5kW rooftop installation completed in Baner',
            ]
        );

        Referral::firstOrCreate(
            ['referrer_id' => $rohan->id, 'referee_name' => 'Amit Verma'],
            [
                'referee_mobile' => '9822100102',
                'referee_city' => 'Nashik',
                'stage' => 'Site Survey Done',
                'reward_amount' => 200.00,
                'reward_status' => 'Credited',
                'notes' => 'Survey completed, proposal shared',
            ]
        );

        Referral::firstOrCreate(
            ['referrer_id' => $rohan->id, 'referee_name' => 'Sneha Iyer'],
            [
                'referee_mobile' => '9822100103',
                'referee_city' => 'Mumbai',
                'stage' => 'Contacted',
                'reward_amount' => 500.00,
                'reward_status' => 'Pending',
                'notes' => 'Initial inquiry submitted',
            ]
        );

        // Wallet transactions for Rohan
        WalletTransaction::firstOrCreate(
            ['user_id' => $rohan->id, 'title' => 'Referral Reward — Priya Nair installed 3kW system'],
            [
                'type' => 'Credit',
                'amount' => 500.00,
                'description' => 'Referral bonus credited for Priya Nair installation',
                'reference_type' => 'Referral',
                'status' => 'Credited',
            ]
        );

        WalletTransaction::firstOrCreate(
            ['user_id' => $rohan->id, 'title' => 'Referral Milestone — Amit Verma site survey done'],
            [
                'type' => 'Credit',
                'amount' => 200.00,
                'description' => 'Milestone survey bonus credited',
                'reference_type' => 'Referral',
                'status' => 'Credited',
            ]
        );

        WalletTransaction::firstOrCreate(
            ['user_id' => $rohan->id, 'title' => 'Welcome Reward Bonus'],
            [
                'type' => 'Credit',
                'amount' => 800.00,
                'description' => 'AES One customer registration bonus',
                'reference_type' => 'Manual',
                'status' => 'Credited',
            ]
        );

        // Service requests for Rohan
        ServiceRequest::firstOrCreate(
            ['user_id' => $rohan->id, 'ticket_no' => '#SR-2291'],
            [
                'customer_site_id' => $site1->id,
                'issue_type' => 'Panel cleaning',
                'preferred_date' => now()->addDays(3),
                'description' => 'Scheduled quarterly solar module cleaning and health check.',
                'status' => 'Scheduled',
                'admin_notes' => 'Assigned to Senior Technician Vishal K.',
            ]
        );

        ServiceRequest::firstOrCreate(
            ['user_id' => $rohan->id, 'ticket_no' => '#SR-2140'],
            [
                'customer_site_id' => $site1->id,
                'issue_type' => 'Low generation check',
                'preferred_date' => now()->subMonths(1),
                'description' => 'Checking inverter error code E04 after heavy rain.',
                'status' => 'Resolved',
                'admin_notes' => 'DC connector tightened and system recalibrated. Generating normally.',
            ]
        );

        // Documents for Rohan
        CustomerDocument::firstOrCreate(
            ['user_id' => $rohan->id, 'title' => 'Panel Warranty Certificate (25-Year Linear)'],
            [
                'customer_site_id' => $site1->id,
                'doc_type' => 'Panel Warranty',
                'valid_until' => now()->addYears(25),
                'notes' => 'Tier-1 Mono PERC 25-year linear performance warranty',
            ]
        );

        CustomerDocument::firstOrCreate(
            ['user_id' => $rohan->id, 'title' => 'Inverter Warranty Card'],
            [
                'customer_site_id' => $site1->id,
                'doc_type' => 'Inverter Warranty',
                'valid_until' => now()->addYears(10),
                'notes' => 'Valid till 10 years with free on-site replacement',
            ]
        );

        CustomerDocument::firstOrCreate(
            ['user_id' => $rohan->id, 'title' => 'Installation Agreement & Handover Dossier'],
            [
                'customer_site_id' => $site1->id,
                'doc_type' => 'Installation Agreement',
                'valid_until' => now()->addYears(25),
                'notes' => 'Signed EPC agreement & safety compliance certificate',
            ]
        );

        CustomerDocument::firstOrCreate(
            ['user_id' => $rohan->id, 'title' => 'Net-Metering DISCOM Approval Certificate'],
            [
                'customer_site_id' => $site1->id,
                'doc_type' => 'Net-Metering Approval',
                'valid_until' => now()->addYears(25),
                'notes' => 'MSEDCL bidirectional meter installed and commissioned',
            ]
        );

        // Notifications for Rohan
        CustomerNotification::firstOrCreate(
            ['user_id' => $rohan->id, 'title' => 'Referral reward credited'],
            [
                'message' => '₹500 added to your wallet for Priya Nair\'s installation.',
                'type' => 'referral',
                'is_read' => false,
            ]
        );

        CustomerNotification::firstOrCreate(
            ['user_id' => $rohan->id, 'title' => 'AMC visit scheduled'],
            [
                'message' => 'Technician visit confirmed for quarterly cleaning on ' . now()->addDays(3)->format('d M') . '.',
                'type' => 'service',
                'is_read' => true,
            ]
        );
    }
}
