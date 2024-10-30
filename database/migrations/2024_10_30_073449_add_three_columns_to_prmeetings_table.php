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
        Schema::table('prmeetings', function (Blueprint $table) {
            $table->integer('otp')->nullable();
            $table->timestamp('otp_expiration_at')->nullable();
            $table->string('isVerified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prmeetings', function (Blueprint $table) {
            $table->dropColumn('otp');
            $table->dropColumn('otp_expiration_at');
            $table->dropColumn('isVerified');
        });
    }
};
