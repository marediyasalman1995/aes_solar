<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'dealer_id')) {
                $table->unsignedBigInteger('dealer_id')->nullable()->after('referred_by_id');
                $table->foreign('dealer_id')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'dealer_id')) {
                $table->dropForeign(['dealer_id']);
                $table->dropColumn('dealer_id');
            }
        });
    }
};
