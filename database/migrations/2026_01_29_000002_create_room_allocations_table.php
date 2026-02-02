<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('room_allocations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hostel_request_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('student_id');
            $table->integer('bed_number')->default(1);
            $table->enum('status', ['allocated', 'vacated', 'pending'])->default('allocated');
            $table->dateTime('allocated_at')->nullable();
            $table->dateTime('vacated_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('hostel_request_id')->references('id')->on('hostel_requests')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            // Removed student_id foreign key constraint to allow flexibility with student IDs
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_allocations');
    }
};


