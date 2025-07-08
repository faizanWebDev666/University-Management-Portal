<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('teacher_registrations', function (Blueprint $table) {
        $table->id();
        $table->string('full_name');
        $table->string('father_name');
        $table->string('cnic')->unique();
        $table->date('dob');
        $table->enum('gender', ['Male', 'Female', 'Other']);
        $table->string('email')->unique();
        $table->string('phone');
        $table->enum('salary_type', ['monthly', 'weekly', 'hourly']);
        $table->decimal('salary', 10, 2);

        $table->string('qualification');
        $table->string('specialization');

        $table->unsignedBigInteger('department_id')->nullable();
        $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');

        $table->string('designation');
        $table->date('joining_date');

        $table->string('username')->unique();
        $table->string('password');
        $table->string('role')->default('Professor');

        $table->string('resume')->nullable(); // Path to uploaded resume

        $table->string('address');
        $table->string('country');
        $table->string('city');
        $table->string('state');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('teacher_registrations');
    }
};
