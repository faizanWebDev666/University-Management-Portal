<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('professor_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('professor_id')->unique()->constrained('users')->onDelete('cascade');
            $table->boolean('can_edit_marked_attendance')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('professor_permissions');
    }
};
