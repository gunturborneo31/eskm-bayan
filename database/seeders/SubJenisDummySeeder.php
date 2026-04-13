<?php
// database/seeders/SubJenisDummySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SubJenisDummySeeder extends Seeder
{
    public function run()
    {
        if (!Schema::hasTable('sub_jenis')) return;
        $now = now();
        // Dummy: 1 program per bagian
        $programs = [
            1 => 'Program Pengembangan Organisasi',
            2 => 'Program Layanan Umum',
            3 => 'Program Pemerintahan Daerah',
            4 => 'Program Pembangunan Infrastruktur',
            5 => 'Program Komunikasi Publik',
            6 => 'Program Kesejahteraan Sosial',
            7 => 'Program Pengadaan Barang/Jasa',
            8 => 'Program Ekonomi & SDA',
            9 => 'Program Bantuan Hukum',
        ];
        $data = [];
        foreach ($programs as $bagian => $jenis) {
            $data[] = [
                'bagian' => $bagian,
                'bidang' => 'PROGRAM',
                'jenis' => $jenis,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('sub_jenis')->insert($data);
    }
}
