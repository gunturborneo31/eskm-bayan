<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('survey_responses', function (Blueprint $table) {
            if (!Schema::hasColumn('survey_responses', 'redeem_group')) {
                $table->string('redeem_group', 64)->nullable()->after('saran')->index();
            }
        });
    }

    public function down(): void
    {
        Schema::table('survey_responses', function (Blueprint $table) {
            if (Schema::hasColumn('survey_responses', 'redeem_group')) {
                $table->dropColumn('redeem_group');
            }
        });
    }
};
