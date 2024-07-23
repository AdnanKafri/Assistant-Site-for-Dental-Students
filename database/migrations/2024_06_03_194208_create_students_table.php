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
//        Schema::create('students', function (Blueprint $table) {
//            $table->id('st_id');
//
//            $table->foreignId("u_id")->references('u_id')->
//            on('users')->cascadeOnDelete();
//
//            $table->string('FullName');
//            $table->string('email')->unique();
//            $table->string('password');
//            $table->string("study_year");
//            $table->string("phone");
//            $table->string("gender");
//            $table->integer("rating");
//            $table->integer("sid");
//            $table->timestamps();
//        });
        Schema::create('students', function (Blueprint $table) {
            $table->id('st_id');
            $table->unsignedBigInteger('id');
            $table->string('study_year')->nullable();
            $table->string('card')->nullable();
            $table->integer('rating')->nullable();
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
