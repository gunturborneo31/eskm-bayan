<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('survey_responses', function (Blueprint $table) {
            if (! Schema::hasColumn('survey_responses', 'no_wa')) {
                $table->string('no_wa', 32)->nullable()->after('nohp');
            }
        });

        // copy data from nohp to no_wa for existing records
        if (Schema::hasColumn('survey_responses', 'nohp')) {
            \DB::table('survey_responses')->whereNotNull('nohp')->chunkById(100, function($rows){
                foreach ($rows as $r) {
                    \DB::table('survey_responses')->where('id', $r->id)->update(['no_wa' => $r->nohp]);
                }
            });
        }
    }

    public function down(): void
    {
        Schema::table('survey_responses', function (Blueprint $table) {
            if (Schema::hasColumn('survey_responses', 'no_wa')) {
                $table->dropColumn('no_wa');
            }
        });
    }
};
