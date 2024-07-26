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
        Schema::create('request_approvers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approver1_id')->constrained(
                table: 'users', indexName: 'fk1'
            );
            $table->foreignId('approver2_id')->constrained(
                table: 'users', indexName: 'fk2'
            );
            $table->enum('approver1_status', ['pending', 'accepted', 'declined'])->default('pending');
            $table->enum('approver2_status', ['pending', 'accepted', 'declined'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_approvers');
    }
};
