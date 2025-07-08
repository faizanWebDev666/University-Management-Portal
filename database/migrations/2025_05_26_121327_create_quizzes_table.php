<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('class_id');

            $table->string('quiz_title');

            // Quiz type enum
            $table->enum('quiz_type', ['file', 'mcq', 'written']);

            // Nullable file path for file upload quizzes
            $table->string('quiz_file')->nullable();

            // JSON for MCQ quizzes
            $table->json('quiz_data')->nullable();

            // Text for written questions
            $table->text('written_questions')->nullable();

            $table->date('deadline');
            $table->time('deadline_time');

            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
