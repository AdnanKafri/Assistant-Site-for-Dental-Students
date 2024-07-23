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
//        Schema::create('subjects', function (Blueprint $table) {
//            $table->id('su_id');
//            $table->string('name');
//            $table->integer('subject_year');
//            $table->timestamps();
//        });
        Schema::create('subjects', function (Blueprint $table) {
            $table->id('su_id');
            $table->string('name')->nullable();
            $table->integer('subject_year')->nullable();
            $table->timestamps();
            $table->softDeletes(); // لإضافة ميزة Soft Delete

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
