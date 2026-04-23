<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materials', function (Blueprint $box) {
            $box->string('language')->default('html')->after('content');
            $box->text('sample_code')->nullable()->after('language');
        });
    }

    public function down(): void
    {
        Schema::table('materials', function (Blueprint $box) {
            $box->dropColumn(['language', 'sample_code']);
        });
    }
};
