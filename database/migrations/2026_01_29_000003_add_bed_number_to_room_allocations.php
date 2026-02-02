<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('room_allocations', function (Blueprint $table) {
            if (!Schema::hasColumn('room_allocations', 'bed_number')) {
                $table->integer('bed_number')->default(1)->after('room_id');
            }
        });
    }

    public function down()
    {
        Schema::table('room_allocations', function (Blueprint $table) {
            if (Schema::hasColumn('room_allocations', 'bed_number')) {
                $table->dropColumn('bed_number');
            }
        });
    }
};

