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
        Schema::create('prmeetings', function (Blueprint $table) {
            $table->id();
            $table->string('district');
            $table->string('meeting_month');
            $table->enum('meeting_convened',['Yes','No']);
            $table->date('meeting_date')->nullable();
            $table->string('subject')->nullable();
            $table->string('filename')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prmeetings');
    }
};
