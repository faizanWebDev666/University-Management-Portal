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
        // Drop old table to start clean (standard in these "optimize" requests unless data migration specified)
        Schema::dropIfExists('attendances');

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_course_id');
            $table->date('date');
            $table->string('time_slot');
            $table->json('attendance_data'); // Stores student_registration_id => status
            $table->timestamps();

            $table->foreign('offer_course_id')
                ->references('id')
                ->on('offer_courses')
                ->onDelete('cascade');

            // Unique session constraint to prevent double submission
            $table->unique(['offer_course_id', 'date', 'time_slot'], 'unique_attendance_session');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');

        // Restore original table structure
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_registration_id');
            $table->unsignedBigInteger('offer_course_id');
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
};
