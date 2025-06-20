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
        Schema::create('supplies_requests', function (Blueprint $table) {
            $table->id();
            $table->enum('type' , ['device' , 'material' , 'equipment' , 'medicine']);
            $table->foreignId('change_status_by')->nullable()->constrained('store_keeper_employees')->nullOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->nullOnDelete();
            $table->foreignId('medical_supplies_id')->nullable()->constrained('medical_supplies')->nullOnDelete();
            $table->integer('quantity');
            $table->enum('status' , ['pending' , 'cancelled' , 'completed']);
            $table->string('reject_cause')->nullable();
            $table->dateTime('taken_date')->nullable();
            $table->dateTime('re_entry_date')->nullable();
            $table->boolean('is_return_in_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplies_requests');
    }
};
