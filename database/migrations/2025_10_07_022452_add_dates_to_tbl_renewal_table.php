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
        Schema::table('tbl_renewal', function (Blueprint $table) {
            $table->date('renewal_start_date')->nullable()->after('renewal_acad_year');
            $table->date('renewal_deadline')->nullable()->after('renewal_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_renewal', function (Blueprint $table) {
            $table->dropColumn(['renewal_start_date', 'renewal_deadline']);
        });
    }
};
