<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('students_registrations', function (Blueprint $table) {
        $table->id();

        // Removed ->after('id') because it's not valid here
        $table->unsignedBigInteger('department_id')->nullable();

        $table->string('full_name');
        $table->string('email')->unique();
        $table->string('phone_number');
        $table->string('cnic');
        $table->string('department');
        $table->string('roll_no', 3); // max length 3
        $table->string('degree_program');
        $table->string('password'); // Hashed password
        $table->text('address');
        $table->string('country');
        $table->string('city');
        $table->string('state_province');
        $table->timestamps();

        $table->foreign('department_id')
              ->references('id')
              ->on('departments')
              ->onDelete('set null');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('students_registrations');
    }
};