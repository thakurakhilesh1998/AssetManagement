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
        Schema::table('rdassets', function (Blueprint $table) {
            $table->decimal('rent_income',12,2)->nullable();
            $table->string('rent_deposited')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rdassets', function (Blueprint $table) {
            $table->dropColumn('rent_income');
            $table->dropColumn('rent_deposited');

        });
    }
};
