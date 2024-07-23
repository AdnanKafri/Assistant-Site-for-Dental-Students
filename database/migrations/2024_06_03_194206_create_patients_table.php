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
//        Schema::create('patients', function (Blueprint $table) {
//            $table->id('p_id');
//            $table->foreignId("u_id")->references('u_id')->
//            on('users')->cascadeOnDelete();
//            $table->string('fullname');
//            $table->string('email')->unique();
//            $table->string('password');
//            $table->string("Address");
//            $table->string("phone");
//            $table->string("gender");
//            $table->integer("age");
//            $table->string("post_timer");
//            $table->timestamps();
//        });
        Schema::create('patients', function (Blueprint $table) {
            $table->id('p_id');
            $table->unsignedBigInteger('id');
            $table->string('Address')->nullable();
            $table->integer('age')->nullable();
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
