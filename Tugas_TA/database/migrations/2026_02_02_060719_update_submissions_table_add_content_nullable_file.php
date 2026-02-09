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
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('file_path')->nullable()->change();
            $table->text('content')->nullable()->after('student_id');
            $table->timestamp('submitted_at')->nullable()->after('feedback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->string('file_path')->nullable(false)->change();
            $table->dropColumn('content');
            $table->dropColumn('submitted_at');
        });
    }
};
