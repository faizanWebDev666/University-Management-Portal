<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_quiz_submissions', function (Blueprint $table) {
            if (!Schema::hasColumn('student_quiz_submissions', 'written_answer')) {
                $table->longText('written_answer')->nullable()->after('mcq_answers');
            }

            if (!Schema::hasColumn('student_quiz_submissions', 'marks')) {
                $table->decimal('marks', 8, 2)->nullable()->after('written_answer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('student_quiz_submissions', function (Blueprint $table) {
            if (Schema::hasColumn('student_quiz_submissions', 'marks')) {
                $table->dropColumn('marks');
            }

            if (Schema::hasColumn('student_quiz_submissions', 'written_answer')) {
                $table->dropColumn('written_answer');
            }
        });
    }
};
