<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
{
    Schema::create('hostel_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('student_id'); // reference to students_registrations table
        $table->string('hostel_type'); 
        $table->string('room_type'); 
        $table->integer('duration'); 
        $table->string('semester'); 
        $table->string('emergency_name');
        $table->string('emergency_number');
        $table->text('medical_info')->nullable();
        $table->text('address');
        $table->text('reason');
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->timestamps();

        // Foreign key
        $table->foreign('student_id')->references('id')->on('students_registrations')->onDelete('cascade');
    });
}


    
    public function down(): void
    {
        Schema::dropIfExists('hostel_requests');
    }
};