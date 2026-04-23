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
        Schema::dropIfExists('exam_answers');
        Schema::dropIfExists('exam_submissions');
        Schema::dropIfExists('question_options');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('exams');
        Schema::dropIfExists('submissions');
        Schema::dropIfExists('assignments');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse possible as we are deleting data "sampai akar"
    }
};
