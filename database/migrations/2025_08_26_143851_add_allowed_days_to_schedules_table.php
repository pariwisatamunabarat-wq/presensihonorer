<?php
// database/migrations/xxxx_xx_xx_add_allowed_days_to_schedules_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->json('allowed_days')->nullable()->after('is_banned'); // 0=Minggu, 1=Senin, dst
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn('allowed_days');
        });
    }
};
