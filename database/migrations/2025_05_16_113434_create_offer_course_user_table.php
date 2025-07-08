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
        Schema::create('offer_course_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // student ID
            $table->unsignedBigInteger('offer_courses_id'); // ✅ fixed column name
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('offer_courses_id')->references('id')->on('offer_courses')->onDelete('cascade');

            $table->unique(['user_id', 'offer_courses_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_course_user');
    }
};
