<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_registration_id'); // FK to students_registrations
            $table->unsignedBigInteger('offer_course_id');         // FK to offer_courses
            $table->enum('status', ['present', 'absent']);
            $table->date('date');
            $table->string('time_slot');
            $table->timestamps();

            $table->foreign('student_registration_id')
                ->references('id')
                ->on('students_registrations')
                ->onDelete('cascade');

            $table->foreign('offer_course_id')
                ->references('id')
                ->on('offer_courses')
                ->onDelete('cascade');
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};