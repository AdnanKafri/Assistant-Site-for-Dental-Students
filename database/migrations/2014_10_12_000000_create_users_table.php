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
//        Schema::create('users', function (Blueprint $table) {
//            $table->id('u_id');
//            $table->string('FullName');
//            $table->string('email')->unique();
//            $table->timestamp('email_verified_at')->nullable();
//            $table->string('password');
//            $table->string("gender");
//            $table->string("phone");
////for student
//            $table->string("study_year");
//            $table->integer("rating");
//            $table->integer("sid");
//
////for patient
//            $table->string("Address");
//            $table->integer("age");
//
////for superviosr
//            $table->string("photo");
//            $table->integer("check_state");
//
//            $table->enum('role', ['patient', 'student', 'supervisor']);
//            $table->rememberToken();
//            $table->foreignId('current_team_id')->nullable();
//            $table->string('profile_photo_path', 2048)->nullable();
//            $table->timestamps();
//        });
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->enum('role', ['patient', 'student', 'supervisor', 'admin']);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
