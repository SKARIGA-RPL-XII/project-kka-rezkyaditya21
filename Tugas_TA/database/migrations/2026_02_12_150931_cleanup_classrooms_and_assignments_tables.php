<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Drop many-to-many and dependent tables first
        Schema::dropIfExists('classroom_user');
        Schema::dropIfExists('submissions');
        Schema::dropIfExists('assignments');
        
        // 2. Remove foreign keys from other tables
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('classroom_id');
        });

        Schema::table('forum_topics', function (Blueprint $table) {
            $table->dropColumn('classroom_id');
        });

        // 3. Drop the main classrooms table
        Schema::dropIfExists('classrooms');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reversal is not supported for this destructive cleanup as per plan
    }
};
