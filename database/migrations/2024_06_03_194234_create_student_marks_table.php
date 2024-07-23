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
//        Schema::create('students_marks', function (Blueprint $table) {
//            $table->id('m_id');
//            $table->foreignId('st_id')->constrained('students')->onDelete('cascade');
//            $table->foreignId('su_id')->constrained('subjects')->onDelete('cascade');
//            $table->integer('mark');
//            $table->timestamps();
//        });
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id('m_id');
            $table->unsignedBigInteger("st_id");
            $table->unsignedBigInteger("su_id");
            $table->integer('mark')->nullable();
            $table->timestamps();
            $table->softDeletes(); // لإضافة ميزة Soft Delete

            $table->foreign('st_id')->references('st_id')->on('students')->onDelete('cascade');
            $table->foreign('su_id')->references('su_id')->on('subjects')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_marks');
    }
};
