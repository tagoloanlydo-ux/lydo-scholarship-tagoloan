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
        Schema::table('tbl_disburse', function (Blueprint $table) {
            $table->renameColumn('dirburse_amount', 'disburse_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_disburse', function (Blueprint $table) {
            $table->renameColumn('disburse_amount', 'dirburse_amount');
        });
    }
};
