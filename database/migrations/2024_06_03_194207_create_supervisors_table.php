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
//        Schema::create('supervisors', function (Blueprint $table) {
//            $table->id('s_id');
//            $table->foreignId("u_id")->references('u_id')->
//            on('users')->cascadeOnDelete();
//            $table->string('FullName');
//            $table->string('email')->unique();
//            $table->string('password');
//            $table->string("phone");
//            $table->string("photo");
//            $table->integer("check_state");
//            $table->timestamps();
//        });
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id('s_id');
            $table->unsignedBigInteger('id');
            $table->string('photo')->nullable();
            $table->integer('check_state')->default(0);
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisors');
    }
};
