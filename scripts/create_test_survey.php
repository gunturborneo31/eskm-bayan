<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\NilaiUnsur;
use App\Models\SurveyCode;
use Illuminate\Support\Str;

$r = NilaiUnsur::create([
    'jenisPelayanan' => 'test',
    'tahun' => (int) date('Y'),
    'nama' => 'Test User',
    'alamat' => 'Alamat Test',
    'pekerjaan' => 'Tester',
    'jenkel' => 'Laki - Laki',
    'usia' => 30,
    'nohp' => '08123456789',
    'pendidikan' => 'S1',
    'nik' => '1234567890123456',
    'u1' => 4,'u2' => 4,'u3' => 4,'u4' => 4,'u5' => 4,'u6' => 4,'u7' => 4,'u8' => 4,'u9' => 4,
    'saran' => 'Testing QR codes',
]);

$group = Str::upper(Str::random(10));
$r->redeem_group = $group;
$r->save();

$codes = [];
for ($i = 0; $i < 6; $i++) {
    do {
        $code = strtoupper(Str::random(8));
    } while (SurveyCode::where('code', $code)->exists());
    $codes[] = $code;
    SurveyCode::create(['survey_response_id' => $r->id, 'code' => $code]);
}

echo "Created response id={$r->id} group={$group}\n";
echo "Codes:\n";
foreach ($codes as $c) echo " - $c\n";
