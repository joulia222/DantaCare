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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->references('id')->on('clinics');
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->date('day');
            $table->enum('status' , ['pending' , 'cancelled' , 'completed']);
            $table->foreignId('doctor_id')->references('id')->on('doctors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
