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
        Schema::table('prasset', function (Blueprint $table) {
            $table->text('possibility_income')->change();
            $table->text('nameofproperty')->change();
            $table->text('legal_dispute')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prasset', function (Blueprint $table) {
            $table->string('possibility_income')->change();
            $table->string('nameofproperty')->change();
            $table->string('legal_dispute')->change();
        });
    }
};
