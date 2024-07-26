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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained(
                table: 'vehicles', indexName: 'fk3'
            );
            $table->foreignId('approvers_id')->constrained(
                table: 'request_approvers', indexName: 'fk4'
            );
            $table->string('driver_name');
            $table->double('fuel_estimation');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('request_status', ['pending', 'single approval', 'approved', 'declined'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
