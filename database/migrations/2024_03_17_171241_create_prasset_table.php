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
        Schema::create('prasset', function (Blueprint $table) {
            $table->id();
            $table->enum('district',['Bilaspur','Chamba','Hamirpur','Kangra','Kinnaur','Kullu','Lahul And Spiti','Mandi','Shimla','Sirmaur','Solan','Una']);
            $table->string('blocklist');
            $table->string('gp')->nullable();
            $table->string('muncipal_area')->nullable();
            $table->string('nameofproperty');
            $table->enum('owner',['Department of Panchayati Raj','Zila Parishad','Panchayat Samiti','Gram Panchayat']);
            $table->enum('type',['Official','Shops/Commercial','Project Related Building']);
            $table->enum('area_type',['Rural','Urban']);
            $table->enum('use_of_building',['Own Use','On Rent','Vacant','Legal Dispute','Other']);
            $table->string('otheruse')->nullable();
            $table->enum('along_highway',['Yes','No']);
            $table->decimal('area_land');
            $table->decimal('areaofbuilding');
            $table->string('gps');
            $table->decimal('current_income',12,2);
            $table->string('legal_dispute')->nullable();
            $table->string('jamabandi');
            $table->string('picture');
            $table->string('possibility_income');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prasset');
    }
};
