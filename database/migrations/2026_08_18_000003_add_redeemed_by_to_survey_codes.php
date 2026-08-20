<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('survey_codes', function (Blueprint $table) {
            if (! Schema::hasColumn('survey_codes', 'redeemed_by')) {
                $table->string('redeemed_by', 80)->nullable()->after('redeemed_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('survey_codes', function (Blueprint $table) {
            $table->dropColumn('redeemed_by');
        });
    }
};
