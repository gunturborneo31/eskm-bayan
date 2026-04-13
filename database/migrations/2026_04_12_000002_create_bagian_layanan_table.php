<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('bagian_layanan')) {
            Schema::create('bagian_layanan', function (Blueprint $table) {
                $table->tinyIncrements('id');
                $table->string('nama', 150);
                $table->string('kode', 60)->unique();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (DB::table('bagian_layanan')->count() === 0) {
            $now = now();
            DB::table('bagian_layanan')->insert([
                ['id' => 1, 'nama' => 'Bagian Organisasi', 'kode' => 'organisasi', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['id' => 2, 'nama' => 'Bagian Umum', 'kode' => 'umum', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['id' => 3, 'nama' => 'Bagian Pemerintahan', 'kode' => 'pemerintahan', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['id' => 4, 'nama' => 'Bagian Administrasi Pembangunan', 'kode' => 'adbang', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['id' => 5, 'nama' => 'Bagian Protokol dan Komunikasi Pimpinan', 'kode' => 'prokopim', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['id' => 6, 'nama' => 'Bagian Kesejahteraan Rakyat', 'kode' => 'kesra', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['id' => 7, 'nama' => 'Bagian Pengadaan Barang dan Jasa', 'kode' => 'pbj', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['id' => 8, 'nama' => 'Bagian Perekonomian dan Sumber Daya Alam', 'kode' => 'ekosda', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
                ['id' => 9, 'nama' => 'Bagian Hukum', 'kode' => 'hukum', 'is_active' => 1, 'created_at' => $now, 'updated_at' => $now],
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('bagian_layanan');
    }
};
