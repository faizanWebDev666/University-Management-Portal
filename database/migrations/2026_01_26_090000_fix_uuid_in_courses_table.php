<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the existing uuid column if it exists
        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'uuid')) {
                $table->dropUnique('courses_uuid_unique');
                $table->dropColumn('uuid');
            }
        });

        // Add uuid column nullable
        Schema::table('courses', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id');
        });

        // Generate UUIDs for existing courses
        $courses = \DB::table('courses')->whereNull('uuid')->get();
        foreach ($courses as $course) {
            \DB::table('courses')
                ->where('id', $course->id)
                ->update(['uuid' => Str::uuid()]);
        }

        // Make uuid non-nullable and unique
        Schema::table('courses', function (Blueprint $table) {
            $table->uuid('uuid')->change();
        });

        // Add unique constraint
        \DB::statement('ALTER TABLE courses ADD UNIQUE (uuid)');
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropUnique('courses_uuid_unique');
            $table->dropColumn('uuid');
        });
    }
};
