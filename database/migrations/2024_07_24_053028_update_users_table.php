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
            $table->enum('new_role',['admin', 'po', 'dpo', 'bdo'])->after('role');

            $table->string('bdo')->nullable()->after('new_role');
        });
         // Copy data from old 'role' column to 'new_role' column
         DB::table('users')->update([
            'new_role' => DB::raw("CASE role WHEN 'PRTI' THEN 'bdo' ELSE role END")
        ]);

        Schema::table('users', function (Blueprint $table) {
            // Drop the old 'role' column
            $table->dropColumn('role');

            // Rename 'new_role' column to 'role'
            $table->renameColumn('new_role', 'role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
           // Drop the new 'role' column
           $table->dropColumn('role');

           // Rename 'old_role' column back to 'role'
           $table->renameColumn('old_role', 'role');
        });
    }
};
