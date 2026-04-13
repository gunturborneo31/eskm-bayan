<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BagianLayananSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        DB::table('bagian_layanan')->truncate();

        $pilars = [
            ['kode' => 'pendidikan', 'nama' => 'Pendidikan', 'is_active' => true],
            ['kode' => 'kesehatan', 'nama' => 'Kesehatan', 'is_active' => true],
            ['kode' => 'pendapatan', 'nama' => 'Tingkat Pendapatan Riil/Pekerjaan', 'is_active' => true],
            ['kode' => 'kemandirian', 'nama' => 'Kemandirian Ekonomi', 'is_active' => true],
            ['kode' => 'sosial', 'nama' => 'Sosial Budaya', 'is_active' => true],
            ['kode' => 'infrastruktur', 'nama' => 'Infrastruktur', 'is_active' => true],
            ['kode' => 'kelembagaan', 'nama' => 'Kelembagaan', 'is_active' => true],
            ['kode' => 'lingkungan', 'nama' => 'Lingkungan', 'is_active' => true],
        ];

        DB::table('bagian_layanan')->insert($pilars);
    }
}
