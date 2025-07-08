<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('students_registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('students_registrations', 'class_id')) {
                $table->unsignedBigInteger('class_id')->nullable()->after('id'); // 👈 class_id after id
                $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('students_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('students_registrations', 'class_id')) {
                $table->dropForeign(['class_id']);
                $table->dropColumn('class_id');
            }
        });
    }
};