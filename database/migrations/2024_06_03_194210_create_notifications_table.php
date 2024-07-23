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
//        Schema::create('notifications', function (Blueprint $table) {
//            $table->id('n_id');
//            $table->foreignId('p_id')->constrained('patients')->onDelete('cascade');
//            $table->foreignId('st_id')->constrained('students')->onDelete('cascade');
//            $table->foreignId('s_id')->constrained('supervisors')->onDelete('cascade');
//            $table->foreignId('po_id')->constrained('posts')->onDelete('cascade');
//            $table->string('Description');
//            $table->integer("type");
//            $table->timestamps();
//        });
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('n_id');
            $table->unsignedBigInteger("p_id");
            $table->unsignedBigInteger("s_id");
            $table->unsignedBigInteger("st_id");
            $table->unsignedBigInteger("po_id");
            $table->string('Description')->nullable();
            $table->integer('type')->nullable();
            $table->timestamps();

            $table->foreign('p_id')->references('p_id')->on('patients')->onDelete('cascade');
            $table->foreign('s_id')->references('s_id')->on('supervisors')->onDelete('cascade');
            $table->foreign('st_id')->references('st_id')->on('students')->onDelete('cascade');
            $table->foreign('po_id')->references('po_id')->on('posts')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
