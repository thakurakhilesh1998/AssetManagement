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
        Schema::create('prmeeting', function (Blueprint $table) {
            $table->id();
            $table->string('month');
            $table->enum('meetingconvened',['Yes','No']);
            $table->string('subject');
            $table->string('proceedings');
            $table->string('date');
            $table->enum('isverified',['Yes','No'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prmeeting');
    }
};
