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
        Schema::create('student_quiz_submissions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('student_id'); // This references users table where type = 'student'

            $table->string('answer_file')->nullable(); // For written/file uploads
            $table->json('mcq_answers')->nullable();   // For MCQ answers in JSON format

            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('student_quiz_submissions');
    }
};
