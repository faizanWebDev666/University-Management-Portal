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
        Schema::create('leave_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('faculty_id');
        $table->string('leave_type');
        $table->date('from_date');
        $table->date('to_date');
        $table->text('reason');
        $table->string('status')->default('Pending'); // Pending, Approved, Rejected
        $table->timestamps();

        // Foreign key constraint (optional)
        $table->foreign('faculty_id')->references('id')->on('users')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
