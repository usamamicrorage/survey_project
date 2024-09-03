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
        Schema::table('survey_responses', function (Blueprint $table) {
            //
            Schema::table('survey_responses', function (Blueprint $table) {
                $table->string('response_group_id')->nullable(); // Unique identifier for each respondent's submission
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey_responses', function (Blueprint $table) {
            //
            Schema::table('survey_responses', function (Blueprint $table) {
                $table->dropColumn('response_group_id');
            });
        });
    }
};
