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
//        Schema::create('status_types', function (Blueprint $table) {
//            $table->id('t_id');
//            $table->string('name');
//            $table->string('Description');
//            $table->string('photo');
//            $table->timestamps();
//        });
        Schema::create('status_types', function (Blueprint $table) {
            $table->id('t_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_types');
    }
};
