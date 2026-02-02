<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       Schema::create('hostels', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // e.g. Boys Hostel A
    $table->enum('type', ['Boys', 'Girls']);
    $table->integer('capacity')->default(0); // can be total rooms or total persons
    $table->text('address')->nullable();
    $table->text('description')->nullable();
    $table->json('facilities')->nullable(); // store hostel-wide facilities as JSON
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('hostels');
    }
};
