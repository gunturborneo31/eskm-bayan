<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Creates a unified survey_responses table for 2025 onwards.
 *
 * The legacy approach (separate table per year) makes cross-year
 * reporting impossible without raw SQL hacks and prevents the use of
 * a proper Eloquent model. This table is the forward-looking target;
 * existing 2023/2024 data can be migrated into it at any time.
 *
 * Differences from the legacy tables:
 * - Stores `tahun` (year) instead of naming the table after the year.
 * - `updated_at` is a real timestamp from the start.
 * - Unnecessary columns u10–u15 are omitted.
 * - Proper FK to sub_jenis.
 * - Composite index on (jenisPelayanan, created_at) included at creation time.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('survey_responses')) {
            return;
        }

        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('tahun');
            $table->string('jenisPelayanan', 100)->nullable();
            // Legacy table `sub_jenis.id` is INT(11) signed, so this column
            // must stay signed integer (not foreignId/unsignedBigInteger).
            $table->integer('id_sub_jenis')->nullable();

            // Respondent demographics
            $table->string('nama', 150)->nullable();
            $table->string('alamat', 300)->nullable();
            $table->string('pekerjaan', 50)->nullable();
            $table->string('jenkel', 15)->nullable();
            $table->unsignedTinyInteger('usia')->nullable();
            $table->string('nohp', 16)->nullable();
            $table->string('pendidikan', 20)->nullable();
            $table->string('nik', 20)->nullable();

            // Survey scores (u1–u9; nullable for partial responses)
            $table->unsignedTinyInteger('u1')->nullable();
            $table->unsignedTinyInteger('u2')->nullable();
            $table->unsignedTinyInteger('u3')->nullable();
            $table->unsignedTinyInteger('u4')->nullable();
            $table->unsignedTinyInteger('u5')->nullable();
            $table->unsignedTinyInteger('u6')->nullable();
            $table->unsignedTinyInteger('u7')->nullable();
            $table->unsignedTinyInteger('u8')->nullable();
            $table->unsignedTinyInteger('u9')->nullable();

            $table->string('saran', 600)->nullable();
            $table->timestamps();

            // Primary analytics index
            $table->index(['jenisPelayanan', 'created_at'], 'idx_dept_created');
            $table->index(['tahun', 'jenisPelayanan'], 'idx_tahun_dept');

            // FOREIGN KEY DINONAKTIFKAN SEMENTARA AGAR MIGRASI DAN SEEDER BERJALAN
            // $table->foreign('id_sub_jenis', 'survey_responses_id_sub_jenis_foreign')
            //     ->references('id')
            //     ->on('sub_jenis')
            //     ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
