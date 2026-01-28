<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // This migration is deprecated - see 2026_01_26_090000_fix_uuid_in_courses_table.php
        // Leaving this here for migration history purposes
    }

    public function down(): void
    {
        // Nothing to rollback
    }
};
