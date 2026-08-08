<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'user_type')) {
                $table->string('user_type')->default('customer')->after('email'); // 'admin', 'customer', 'staff'
            }
            if (!Schema::hasColumn('users', 'referral_code')) {
                $table->string('referral_code')->nullable()->unique()->after('user_type');
            }
            if (!Schema::hasColumn('users', 'referred_by_id')) {
                $table->unsignedBigInteger('referred_by_id')->nullable()->after('referral_code');
            }
            if (!Schema::hasColumn('users', 'wallet_balance')) {
                $table->decimal('wallet_balance', 12, 2)->default(0.00)->after('referred_by_id');
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('wallet_balance');
            }
            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable()->after('address');
            }
            if (!Schema::hasColumn('users', 'state')) {
                $table->string('state')->nullable()->after('city');
            }
            if (!Schema::hasColumn('users', 'pincode')) {
                $table->string('pincode')->nullable()->after('state');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->tinyInteger('status')->default(1)->after('pincode');
            }
        });

        // 1. Customer Sites (Multi-site support for each customer)
        if (!Schema::hasTable('customer_sites')) {
            Schema::create('customer_sites', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->nullable()->unique();
                $table->unsignedBigInteger('user_id');
                $table->string('site_name'); // e.g. "Baner Residence", "Chakan Factory", "Farmhouse"
                $table->string('site_code')->nullable(); // e.g. "AES-S-101"
                $table->decimal('capacity_kw', 8, 2)->default(3.00); // 3kW, 5kW, 6.4kW, etc.
                $table->string('system_type')->default('On-Grid'); // On-Grid, Off-Grid, Hybrid
                $table->date('installation_date')->nullable();
                $table->string('inverter_details')->nullable(); // e.g. "Growatt 5kW Hybrid"
                $table->string('panel_details')->nullable(); // e.g. "Tier-1 Mono PERC 540W x 10"
                $table->decimal('monthly_avg_kwh', 10, 2)->default(450.00);
                $table->decimal('co2_offset_ton', 8, 2)->default(2.50);
                $table->text('address')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('pincode')->nullable();
                $table->string('consumer_number')->nullable(); // DISCOM electricity consumer no
                $table->string('discom_name')->nullable(); // MSEDCL, Tata Power, Adani, etc.
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        // 2. Referrals Table
        if (!Schema::hasTable('referrals')) {
            Schema::create('referrals', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->nullable()->unique();
                $table->unsignedBigInteger('referrer_id'); // User who referred
                $table->string('referee_name');
                $table->string('referee_mobile');
                $table->string('referee_city')->nullable();
                $table->string('stage')->default('Contacted'); // Contacted, Site Survey Done, Quotation Shared, Installed, Rejected
                $table->decimal('reward_amount', 10, 2)->default(0.00);
                $table->string('reward_status')->default('Pending'); // Pending, Credited, None
                $table->text('notes')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('referrer_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        // 3. Wallet Transactions Table
        if (!Schema::hasTable('wallet_transactions')) {
            Schema::create('wallet_transactions', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->nullable()->unique();
                $table->unsignedBigInteger('user_id');
                $table->string('type')->default('Credit'); // Credit, Debit, Payout
                $table->decimal('amount', 12, 2);
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('reference_type')->nullable(); // Referral, Manual, Payout
                $table->unsignedBigInteger('reference_id')->nullable();
                $table->string('status')->default('Credited'); // Credited, Pending, Approved, Rejected
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        // 4. Service Requests Table
        if (!Schema::hasTable('service_requests')) {
            Schema::create('service_requests', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->nullable()->unique();
                $table->string('ticket_no')->unique(); // e.g. "#SR-2291"
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('customer_site_id')->nullable();
                $table->string('issue_type'); // Panel cleaning, Inverter fault, Low generation, Net-metering query, Other
                $table->date('preferred_date')->nullable();
                $table->text('description')->nullable();
                $table->string('status')->default('Scheduled'); // Pending, Scheduled, In Progress, Resolved, Cancelled
                $table->text('admin_notes')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('customer_site_id')->references('id')->on('customer_sites')->onDelete('set null');
            });
        }

        // 5. Customer Documents & Warranties
        if (!Schema::hasTable('customer_documents')) {
            Schema::create('customer_documents', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->nullable()->unique();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('customer_site_id')->nullable();
                $table->string('doc_type'); // Panel Warranty, Inverter Warranty, Installation Agreement, Net-Metering Approval, Invoice, Other
                $table->string('title');
                $table->string('file_path')->nullable();
                $table->date('valid_until')->nullable();
                $table->text('notes')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('customer_site_id')->references('id')->on('customer_sites')->onDelete('set null');
            });
        }

        // 6. Customer Notifications
        if (!Schema::hasTable('customer_notifications')) {
            Schema::create('customer_notifications', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->nullable()->unique();
                $table->unsignedBigInteger('user_id');
                $table->string('title');
                $table->text('message');
                $table->string('type')->default('general'); // referral, wallet, service, warranty, general
                $table->boolean('is_read')->default(false);
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_notifications');
        Schema::dropIfExists('customer_documents');
        Schema::dropIfExists('service_requests');
        Schema::dropIfExists('wallet_transactions');
        Schema::dropIfExists('referrals');
        Schema::dropIfExists('customer_sites');
    }
};
