<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SurveyResponsesSeeder extends Seeder
{
    public function run()
    {
        // Ambil kode pilar yang valid langsung dari App\Support\BagianOptions agar selalu sinkron
        $bagianOptions = \App\Support\BagianOptions::codes();
        $faker = \Faker\Factory::create('id_ID');
        $data = [];
        for ($i = 0; $i < 40; $i++) {
            $tahun = $faker->randomElement([2023, 2024, 2025, 2026]);
            $bulan = $faker->numberBetween(1, 12);
            $tanggal = $faker->numberBetween(1, 28);
            $createdAt = Carbon::create($tahun, $bulan, $tanggal, $faker->numberBetween(0,23), $faker->numberBetween(0,59), $faker->numberBetween(0,59));
            $jenisPelayanan = $faker->randomElement($bagianOptions);
            $row = [
                'tahun' => $tahun,
                'jenisPelayanan' => $jenisPelayanan,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
            // Tambahkan kolom u1-u9 dengan nilai acak 3 atau 4 saja
            for ($j = 1; $j <= 9; $j++) {
                $row['u'.$j] = $faker->randomElement([3, 4]);
            }
            $data[] = $row;
        }
        DB::table('survey_responses')->insert($data);
    }
}
