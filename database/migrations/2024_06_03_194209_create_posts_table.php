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
//        Schema::create('posts', function (Blueprint $table) {
//            $table->id('po_id');
//            $table->foreignId("p_id")->references('p_id')->
//            on('patients')->cascadeOnDelete();
//            $table->foreignId("s_id")->references('s_id')->
//            on('supervisors')->cascadeOnDelete();
//            $table->foreignId("st_id")->references('st_id')->
//            on('students')->cascadeOnDelete();
//            $table->foreignId("t_id")->references('t_id')->
//            on('status_types')->cascadeOnDelete();
//            $table->String('Description');
//            $table->integer('state');
//            $table->integer('patient_rate');
//            $table->timestamps();
//        });
        Schema::create('posts', function (Blueprint $table) {
            $table->id('po_id');
            $table->unsignedBigInteger("id");
            $table->unsignedBigInteger("t_id");
            $table->string('Description')->nullable();
            $table->longText('images')->nullable(); // Change this line to longText
            $table->integer('state')->nullable()->default('0');
            $table->integer('patient_rate')->nullable();
            $table->timestamps();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('t_id')->references('t_id')->on('status_types')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
