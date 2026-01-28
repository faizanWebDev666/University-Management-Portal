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
            $table->unsignedBigInteger('student_id'); // reference to students table
            $table->string('hostel_type'); // Boys / Girls
            $table->string('room_type'); // Single / Shared
            $table->integer('duration'); // 1 or 2 semesters
            $table->string('semester'); // e.g. Fall 2026 / Fall 2026 + Spring 2027
            $table->string('emergency_name');
            $table->string('emergency_number');
            $table->text('medical_info')->nullable();
            $table->text('address');
            $table->text('reason');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hostel_requests');
    }
};
