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
         Schema::create('student_course_registrations', function (Blueprint $table) {
        $table->id();

        // Assuming users table is used for students
        $table->unsignedBigInteger('student_id');
        $table->unsignedBigInteger('offered_course_id');

        $table->timestamps();

        // Prevent duplicate registrations
        $table->unique(['student_id', 'offered_course_id']);

        // Foreign keys (optional but recommended)
        $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('offered_course_id')->references('id')->on('offer_courses')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_course_registrations');
    }
};
