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
        // 1. Create referral_point_settings table
        if (!Schema::hasTable('referral_point_settings')) {
            Schema::create('referral_point_settings', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique()->nullable();
                $table->string('title');
                $table->string('type')->default('Credit'); // Credit, Debit
                $table->decimal('amount', 12, 2)->default(500.00);
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // 2. Create document_types table
        if (!Schema::hasTable('document_types')) {
            Schema::create('document_types', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique()->nullable();
                $table->string('title');
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // 3. Update inquiries table columns
        Schema::table('inquiries', function (Blueprint $table) {
            if (!Schema::hasColumn('inquiries', 'type')) {
                $table->string('type')->default('Customer')->after('email'); // Customer, Dealer
            }
            if (!Schema::hasColumn('inquiries', 'pincode')) {
                $table->string('pincode')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('inquiries', 'monthly_bill')) {
                $table->string('monthly_bill')->nullable()->after('pincode');
            }
        });

        // 4. Update websites table for Product Master enhancements
        Schema::table('websites', function (Blueprint $table) {
            if (!Schema::hasColumn('websites', 'slug')) {
                $table->string('slug')->nullable()->after('type');
            }
            if (!Schema::hasColumn('websites', 'specifications')) {
                $table->text('specifications')->nullable()->after('description'); // JSON or Text
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_types');
        Schema::dropIfExists('referral_point_settings');

        Schema::table('inquiries', function (Blueprint $table) {
            if (Schema::hasColumn('inquiries', 'type')) {
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('inquiries', 'pincode')) {
                $table->dropColumn('pincode');
            }
            if (Schema::hasColumn('inquiries', 'monthly_bill')) {
                $table->dropColumn('monthly_bill');
            }
        });

        Schema::table('websites', function (Blueprint $table) {
            if (Schema::hasColumn('websites', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('websites', 'specifications')) {
                $table->dropColumn('specifications');
            }
        });
    }
};
