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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('assignment_title');
            $table->string('assignment_file'); // file path
            $table->date('deadline');

            $table->unsignedBigInteger('teacher_id'); // FK to users
            $table->unsignedBigInteger('course_id');  // FK to courses
            $table->unsignedBigInteger('class_id');   // FK to classes

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
