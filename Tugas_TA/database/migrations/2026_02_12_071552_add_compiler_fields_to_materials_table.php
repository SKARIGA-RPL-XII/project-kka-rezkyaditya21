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
        Schema::table('materials', function (Blueprint $table) {
            if (!Schema::hasColumn('materials', 'has_compiler')) {
                $table->boolean('has_compiler')->default(false)->after('is_published');
            }
            if (!Schema::hasColumn('materials', 'language')) {
                $table->string('language')->default('html')->after('has_compiler');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn(['has_compiler', 'language']);
        });
    }
};
