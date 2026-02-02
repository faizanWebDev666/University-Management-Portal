<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // Modify uuid column to have default value
            $table->uuid('uuid')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        //
    }
};
