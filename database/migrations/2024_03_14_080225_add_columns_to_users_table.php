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
            $table->string('username')->unique();
            $table->enum('role',['admin','po','dpo']);
            $table->enum('district',['Bilaspur','Chamba','Hamirpur','Kangra','Kinnaur','Kullu','Lahul And Spiti','Mandi','Shimla','Sirmaur','Solan','Una']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('role');
            $table->dropColumn('district');
        });
    }
};
