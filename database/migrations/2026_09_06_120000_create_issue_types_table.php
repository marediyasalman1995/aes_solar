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
        if (!Schema::hasTable('issue_types')) {
            Schema::create('issue_types', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->nullable()->unique();
                $table->string('title');
                $table->integer('sort_order')->default(0);
                $table->tinyInteger('status')->default(1);
                $table->timestamps();
                $table->softDeletes();
            });

            // Seed default issue types
            $defaults = [
                'Panel cleaning',
                'Inverter fault',
                'Low generation',
                'Net-metering query',
                'Annual Maintenance Visit',
                'Other'
            ];

            foreach ($defaults as $idx => $title) {
                \App\Models\IssueType::create([
                    'title' => $title,
                    'sort_order' => $idx + 1,
                    'status' => 1,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_types');
    }
};
