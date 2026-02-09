<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->index('teacher_id');
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->index('classroom_id');
        });

        Schema::table('assignments', function (Blueprint $table) {
            $table->index('classroom_id');
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->index(['assignment_id', 'student_id']);
        });

        Schema::table('forum_topics', function (Blueprint $table) {
            $table->index(['classroom_id', 'user_id']);
        });

        Schema::table('classroom_user', function (Blueprint $table) {
            $table->index(['classroom_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropIndex(['teacher_id']);
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->dropIndex(['classroom_id']);
        });

        Schema::table('assignments', function (Blueprint $table) {
            $table->dropIndex(['classroom_id']);
        });

        Schema::table('submissions', function (Blueprint $table) {
            $table->dropIndex(['assignment_id', 'student_id']);
        });

        Schema::table('forum_topics', function (Blueprint $table) {
            $table->dropIndex(['classroom_id', 'user_id']);
        });

        Schema::table('classroom_user', function (Blueprint $table) {
            $table->dropIndex(['classroom_id', 'user_id']);
        });
    }
};