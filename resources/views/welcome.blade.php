<?php

error_reporting(0);

$startDate = '2024-01-01';

$endDate = '2024-10-03';

if ($_GET['tw'] == null) {
    $today = date('Y-m-d', strtotime('+1 days'));
    $endDate = $today;
} elseif ($_GET['tw'] == 1) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-03-31';
} elseif ($_GET['tw'] == 2) {
    $startDate = $_GET['Tahun'] . '-04-01';
    $endDate = $_GET['Tahun'] . '-06-31';
} elseif ($_GET['tw'] == 3) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-06-31';
} elseif ($_GET['tw'] == 4) {
    $startDate = $_GET['Tahun'] . '-07-01';
    $endDate = $_GET['Tahun'] . '-09-31';
} elseif ($_GET['tw'] == 5) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-09-31';
} elseif ($_GET['tw'] == 6) {
    $startDate = $_GET['Tahun'] . '-10-01';
    $endDate = $_GET['Tahun'] . '-12-31';
} elseif ($_GET['tw'] == 7) {
    $startDate = $_GET['Tahun'] . '-01-01';
    $endDate = $_GET['Tahun'] . '-12-31';
}

$indexTu = ['u1', 'u2', 'u3', 'u4', 'u5', 'u6', 'u7', 'u8', 'u9'];
$lastDate = ['2024-01-31', '2024-02-31', '2024-03-31', '2024-04-31', '2024-05-31', '2024-06-31', '2024-07-31', '2024-08-31', '2024-09-31', '2024-10-31', '2024-11-31', '2024-12-31'];
// dd($indexTu);

$tu = [[]];
$x = [];
$nn = [];
$nrr = [[]];
$nrrT = [[]];
$nrrTT = [];
$nilaiSkm = [];

array_push($nn, '');

for ($i = 1; $i <= 12; $i++) {
    $abc = $lastDate[$i - 1];
    for ($j = 1; $j <= 9; $j++) {
        $xyz = $indexTu[$j - 1];
        // echo $xyz;
        $nilaiTu = DB::table('2024')
            ->whereBetween('created_at', [$startDate, $abc])
            ->get()
            ->sum($xyz);
        array_push($x, $nilaiTu);
    }

    $nnn = DB::table('2024')
        ->whereBetween('created_at', [$startDate, $abc])
        ->get()
        ->count();

    array_push($tu, $x);
    array_push($nn, $nnn);
    $x = [];
}

for ($i = 1; $i <= 12; $i++) {
    $x;
    for ($j = 1; $j <= 9; $j++) {
        if ($nn[$i] == 0) {
            array_push($x, 0);
        } else {
            $nrrx = $tu[$i][$j - 1] / $nn[$i];
            array_push($x, round($nrrx, 2));
        }
    }
    // print_r($x);
    // echo '<br>';
    array_push($nrr, $x);
    $x = [];
}

array_push($nrrTT, '');
for ($i = 1; $i <= 12; $i++) {
    $x;
    $y;
    for ($j = 1; $j <= 9; $j++) {
        $nrrTx = $nrr[$i][$j - 1] * 0.111;
        array_push($x, round($nrrTx, 2));
        $y = $y + $nrrTx;
    }
    array_push($nrrT, $x);
    array_push($nrrTT, round($y, 2));
    $x = [];
    $y = 0;
}

for ($i = 0; $i <= 11; $i++) {
    if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
        array_push($nilaiSkm, 0);
    } else {
        array_push($nilaiSkm, $nrrTT[$i + 1] * 25);
    }
}

// dd($nilaiSkm);

$tu1 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u1');

$tu2 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u2');

$tu3 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u3');

$tu4 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u4');

$tu5 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u5');

$tu6 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u6');

$tu7 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u7');

$tu8 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u8');

$tu9 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u9');

$n = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$tu9 = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u9');

// unset($nilaiSkm[0]);

$nilaiSkm = json_encode($nilaiSkm);

// dd($responden);
// dd($nilaiSkm);

if ($n == 0) {
    $nrr1 = 0;
    $nrr2 = 0;
    $nrr3 = 0;
    $nrr4 = 0;
    $nrr5 = 0;
    $nrr6 = 0;
    $nrr7 = 0;
    $nrr8 = 0;
    $nrr9 = 0;

    $nrr = 0;
    $nrr = 0;

    $nrrt1 = 0;
    $nrrt2 = 0;
    $nrrt3 = 0;
    $nrrt4 = 0;
    $nrrt5 = 0;
    $nrrt6 = 0;
    $nrrt7 = 0;
    $nrrt8 = 0;
    $nrrt9 = 0;

    $nrrT = 0;
    $nrrT = 0;

    $nilaiSKM = $nrrT * 25;
} else {
    $nrr1 = sprintf('%0.3f', $tu1 / $n);
    $nrr2 = sprintf('%0.3f', $tu2 / $n);
    $nrr3 = sprintf('%0.3f', $tu3 / $n);
    $nrr4 = sprintf('%0.3f', $tu4 / $n);
    $nrr5 = sprintf('%0.3f', $tu5 / $n);
    $nrr6 = sprintf('%0.3f', $tu6 / $n);
    $nrr7 = sprintf('%0.3f', $tu7 / $n);
    $nrr8 = sprintf('%0.3f', $tu8 / $n);
    $nrr9 = sprintf('%0.3f', $tu9 / $n);

    $nrr = $nrr1 + $nrr2 + $nrr3 + $nrr4 + $nrr5 + $nrr6 + $nrr7 + $nrr8 + $nrr9;
    $nrr = sprintf('%0.3f', $nrr);

    $nrrt1 = sprintf('%0.3f', $nrr1 * 0.111);
    $nrrt2 = sprintf('%0.3f', $nrr2 * 0.111);
    $nrrt3 = sprintf('%0.3f', $nrr3 * 0.111);
    $nrrt4 = sprintf('%0.3f', $nrr4 * 0.111);
    $nrrt5 = sprintf('%0.3f', $nrr5 * 0.111);
    $nrrt6 = sprintf('%0.3f', $nrr6 * 0.111);
    $nrrt7 = sprintf('%0.3f', $nrr7 * 0.111);
    $nrrt8 = sprintf('%0.3f', $nrr8 * 0.111);
    $nrrt9 = sprintf('%0.3f', $nrr9 * 0.111);

    $nrrT = $nrrt1 + $nrrt2 + $nrrt3 + $nrrt4 + $nrrt5 + $nrrt6 + $nrrt7 + $nrrt8 + $nrrt9;
    $nrrT = sprintf('%0.3f', $nrrT);

    $nilaiSKM = $nrrT * 25;

    // $responden = [];
    // $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nop', 'Des'];

    // if ($_GET['tw'] == '') {
    //     for ($x = 0; $x <= date('m'); $x++) {
    //         $responden[$x][0] = DB::table('2024')
    //             ->whereMonth('created_at', '=', $x + 1)
    //             ->get()
    //             ->count();
    //         $responden[$x][1] = $bulan[$x];
    //     }
    // } else {
    //     for ($x = 0; $x <= $_GET['tw']; $x++) {
    //         $responden[$x][0] = DB::table('2024')
    //             ->whereMonth('created_at', '=', $x + 1)
    //             ->get()
    //             ->count();
    //         $responden[$x][1] = $bulan[$x];
    //     }
    // }
    // dd($responden);

    if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025' or $_GET['Tahun'] == '2025') {
        $tu = [[]];
        $x = [];
        $nn = [];
        $nrr = [[]];
        $nrrT = [[]];
        $nrrTT = [];
        // $nilaiSkm = [];
    }
}
// echo $nrrTotal;
// echo $nrrTertimbang;
$jmlResponden = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" conteitial-scale="1.0">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="items-center bg-fixed w-full grid grid-cols-1"
    style="
    background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
    <div class="h-screen lg:px-20 px-3 flex flex-col w-full">
        <div class="flex justify-between py-[16px] lg:py-1 items-center">
            <div class="flex items-center gap-3 justify-between w-full lg:justify-normal">
                <img src="/assets/logo_kutai_timur.png" class="h-[100px] lg:h-[42px] p-0.5 rounded-xl bg-white"
                    alt="">
                <img src="/assets/disperindag.png" class="h-[100px] lg:h-[42px] p-0.5 rounded-xl bg-white"
                    alt="">
                <div
                    class="rounded-full lg:whitespace-nowrap text-4xl lg:text-2xl font-bold text-white lg:text-left text-right drop-shadow-[0_3px_3px_rgba(0,0,0,0.3)]">
                    E-SKM <br class="lg:hidden"> DISPERINDAG Kab. KUTAI TIMUR
                </div>
            </div>
            <div class="hidden lg:block">
                <a href="/login">
                    <div class="rounded-full whitespace-nowrap p-2 text-xs bg-white font-bold text-[#02A859] ">
                        Halaman Admin</div>
                </a>
            </div>
        </div>
        <hr class="mt-1 lg:border-1 border-3">
        <div class="lg:flex lg:flex-row  justify-between items-center   lg:flex-row-reverse my-2">
            <div class="lg:flex gap-4 lg:justify-normal items-center  justify-between">
                {{-- tahun --}}
                <div class="flex gap-4 lg:justify-normal items-center justify-between">
                    <div class="flex flex-row items-center gap-3 mb-5 lg:mb-0">
                        <label for="countries"
                            class=" font-bold text-white text-4xl lg:text-base drop-shadow-[0_3px_3px_rgba(0,0,0,0.3)]">
                            Tahun</label>

                        <?php if($_GET['Tahun'] == ''){ ?>
                        <select id="countries" id="language"
                            onChange="document.location.href='?tw=' + {{ $_GET['tw'] == null ? '2024' : $_GET['tw'] }} + '&Tahun=' + this.value "
                            class="bg-white border border-gray-300 text-[#02A859] font-bold text-4xl w-[250px] text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">
                            <option value="2023" <?php if (date('Y') == '2023') {
                                echo 'selected';
                            } else {
                            } ?>>2023</option>

                            <option value="2024" <?php if (date('Y') == '2024') {
                                echo 'selected';
                            } else {
                            } ?>>2024</option>

                            <option value="2025" <?php if (date('Y') == '2025') {
                                echo 'selected';
                            } else {
                            } ?>>2025</option>
                        </select>
                        <?php  } else {?>
                        <select id="countries" id="language"
                            onChange="document.location.href='?tw=' + {{ $_GET['tw'] == null ? '2024' : $_GET['tw'] }} + '&Tahun=' + this.value "
                            class="bg-white border border-gray-300 text-[#02A859] font-bold text-4xl w-[250px] text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">
                            <option value="2023" <?php
                            if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
                                echo 'selected';
                            } else {
                            }
                            ?>>2023</option>

                            <option value="2024" <?php
                            if ($_GET['Tahun'] == '2024') {
                                echo 'selected';
                            } else {
                            }
                            ?>>2024</option>

                            <option value="2025" <?php
                            if ($_GET['Tahun'] == '2025') {
                                echo 'selected';
                            } else {
                            }
                            ?>>2025</option>
                        </select>
                        <?php
                    }?>

                    </div>

                    {{-- bulan --}}
                    <div class="flex flex-row items-center gap-3 mb-5 lg:mb-0">
                        <label for="countries"
                            class=" font-bold text-white text-4xl lg:text-base drop-shadow-[0_3px_3px_rgba(0,0,0,0.3)]">
                            Triwulan</label>
                        <?php if($_GET['tw'] == ''){ ?>
                        <select id="countries" id="language"
                            onChange="document.location.href='?tw=' + this.value + '&Tahun=' + {{ $_GET['Tahun'] == null ? '2024' : $_GET['Tahun'] }} "
                            class="bg-white border border-gray-300 text-[#02A859] font-bold text-4xl w-full text-left lg:w-fit lg:text-sm rounded-full px-3 py-1">

                            <option value="1" <?php if (date('m') == 1) {
                                echo 'selected';
                            } else {
                            } ?>>TW 1 (Jan, Feb, Mar)</option>

                            <option value="2" <?php if (date('m') == 2) {
                                echo 'selected';
                            } else {
                            } ?>>TW 2 (Apr, Mei, Jun)</option>

                            <option value="3" <?php if (date('m') == 3) {
                                echo 'selected';
                            } else {
                            } ?>>TW 2 (Jan s/d Jun)</option>

                            <option value="4" <?php if (date('m') == 4) {
                                echo 'selected';
                            } else {
                            } ?>>TW 3 (Jul, Agu, Sep)</option>

                            <option value="5" <?php if (date('m') == 5) {
                                echo 'selected';
                            } else {
                            } ?>>TW 3 (Jan s/d Sep)</option>

                            <option value="6" <?php if (date('m') == 6) {
                                echo 'selected';
                            } else {
                            } ?>>TW 4 (Okt, Nop, Des)</option>

                            <option value="7" <?php if (date('m') == 7) {
                                echo 'selected';
                            } else {
                            } ?>>TW 4 (Jan s/d Des)</option>
                        </select>
                        <?php  } else {?>
                        <select id="countries" id="language"
                            onChange="document.location.href='?tw=' + this.value + '&Tahun=' + {{ $_GET['Tahun'] == null ? '2024' : $_GET['Tahun'] }}"
                            class="bg-white border border-gray-300 text-[#02A859] font-bold text-4xl w-[300px] text-left lg:w-fit lg:text-sm rounded-full px-3 py-1">

                            <option value="1" <?php
                            if ($_GET['tw'] == 1) {
                                echo 'selected';
                            } else {
                            }
                            ?>>TW 1 (Jan, Feb, Mar)</option>

                            <option value="2" <?php
                            if ($_GET['tw'] == 2) {
                                echo 'selected';
                            } else {
                            }
                            ?>>TW 2 (Apr, Mei, Jun)</option>

                            <option value="3" <?php
                            if ($_GET['tw'] == 3) {
                                echo 'selected';
                            } else {
                            }
                            ?>>TW 2 (Jan s/d Jun)</option>

                            <option value="4" <?php
                            if ($_GET['tw'] == 4) {
                                echo 'selected';
                            } else {
                            }
                            ?>>TW 3 (Jul, Agu, Sep)</option>

                            <option value="5" <?php
                            if ($_GET['tw'] == 5) {
                                echo 'selected';
                            } else {
                            }
                            ?>>TW 3 (Jan s/d Sep)</option>

                            <option value="6" <?php
                            if ($_GET['tw'] == 6) {
                                echo 'selected';
                            } else {
                            }
                            ?>>TW 4 (Okt, Nop, Des)</option>

                            <option value="7" <?php
                            if ($_GET['tw'] == 7) {
                                echo 'selected';
                            } else {
                            }
                            ?>>TW 4 (Jan s/d Des)</option>
                        </select>
                        <?php
                    }?>

                    </div>
                </div>
            </div>
            <div class="flex gap-5 justify-between">
                <label
                    class="whitespace-nowrap text-white font-bold text-5xl lg:text-xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.3)]">
                    Nilai SKM :
                </label>
            </div>
        </div>

        <div class="lg:flex lg:grid lg:grid-cols-5  lg:gap-3 flex flex-col h-full ">
            <div class=" justify-stretch col-span-2 gap-4 lg:gap-2 flex flex-col lg:h-full lg:justify-between">
                <div class="items-center justify-center flex">
                    <label class="w-full text-center  lg:py-10 rounded-3xl bg-white shadow-2xl ">
                        <h1
                            class="font-extrabold text-[200px] lg:text-9xl text-transparent bg-clip-text bg-gradient-to-tl from-[#02A859]  via-[#02A859] to-[#02A859] ">
                            {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? '00' : sprintf('%0.2f', $nilaiSKM) }}
                        </h1>
                    </label>
                </div>
                <div class="flex grid grid-cols-3 gap-4 lg:gap-2 lg:h-full lg:mb-0 mb-3">
                    <div
                        class="col-span-2 rounded-xl items-center flex flex-col w-1/2 overflow-hidden w-full h-full p-1 bg-white">
                        <table class="w-full rounded-xl h-fit ">
                            <thead
                                class="bg-gradient-to-br from-[#02A859]  to-[#008952] font-normal border text-sm text-white">
                                <tr class="">
                                    <th scope="col" class=" px-4 py-5 lg:py-1 lg:text-lg text-5xl">Kualitas
                                        Kinerja <br class="hidden lg:block">Pelayanan
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <h1
                            class="font-extrabold flex text-center justify-center h-full items-center  text-9xl text-transparent bg-clip-text bg-gradient-to-tl from-[#02A859]  via-[#02A859] to-[#02A859] ">
                            <label
                                class="ml-5 py-5 lg:py-1 font-black text-5xl lg:text-3xl text-[#02A859] drop-shadow-[0_3px_3px_rgba(0,0,0,0.3)]">
                                <?php
                                $nilai = '';
                                if ($nilaiSKM >= 0 and $nilaiSKM <= 24.99) {
                                    $nilai = 'SANGAT TIDAK MEMUASKAN';
                                } elseif ($nilaiSKM >= 25.0 and $nilaiSKM <= 64.99) {
                                    $nilai = 'TIDAK MEMUASKAN';
                                } elseif ($nilaiSKM >= 65.0 and $nilaiSKM <= 76.6) {
                                    $nilai = 'KURANG MEMUASKAN';
                                } elseif ($nilaiSKM >= 76.61 and $nilaiSKM <= 88.3) {
                                    $nilai = 'MEMUASKAN';
                                } elseif ($nilaiSKM >= 88.4) {
                                    $nilai = 'SANGAT MEMUASKAN';
                                } else {
                                    $nilai = 'SANGAT TIDAK MEMUASKAN';
                                }
                                ?>

                                {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? 'SANGAT TIDAK MEMUASKAN' : $nilai }}
                                {{-- {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? 'SANGAT TIDAK MEMUASKAN' : 'SANGAT MEMUASKAN' }} --}}
                            </label>
                        </h1>
                    </div>
                    <div
                        class="col-span-1 rounded-xl items-center flex flex-col w-1/2 w-full overflow-hidden h-full p-1 bg-white">
                        <table class="w-full rounded-xl h-fit ">
                            <thead
                                class="bg-gradient-to-br from-[#02A859]  to-[#008952] font-normal border text-sm text-white">
                                <tr class="">
                                    <th scope="col" class=" px-4 py-5 lg:py-1 lg:text-lg text-5xl"> Mutu Pelayanan
                                    </th>
                                </tr>
                                <tr>
                            </thead>
                        </table>
                        <h1
                            class="font-extrabold flex items-center h-full text-center  text-9xl text-transparent bg-clip-text bg-gradient-to-tl from-[#02A859]  via-[#02A859] to-[#02A859] ">
                            <label class="font-black text-6xl text-[#02A859] drop-shadow-[0_3px_3px_rgba(0,0,0,0.3)]">
                                <?php
                                $nilai = '';
                                if ($nilaiSKM >= 0 and $nilaiSKM <= 24.99) {
                                    $nilai = 'E';
                                } elseif ($nilaiSKM >= 25.0 and $nilaiSKM <= 64.99) {
                                    $nilai = 'D';
                                } elseif ($nilaiSKM >= 65.0 and $nilaiSKM <= 76.6) {
                                    $nilai = 'C';
                                } elseif ($nilaiSKM >= 76.61 and $nilaiSKM <= 88.3) {
                                    $nilai = 'B';
                                } elseif ($nilaiSKM >= 88.4) {
                                    $nilai = 'A';
                                } else {
                                    $nilai = 'E';
                                }
                                ?>

                                {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? 'E' : $nilai }} </label>
                        </h1>
                    </div>
                </div>
                <div class="flex flex-col gap-4 lg:gap-2 hidden lg:flex">
                    <div class="w-full bottom-0">
                        <a href="/dashboard?tw={{ date('m') }}&Tahun={{ date('Y') }}&Triwulan1=on">
                            <button type="button"
                                class="bg-white w-full b-0 p-4 shadow-2xl text-xl font-black  rounded-2xl  text-[#02A859] ">
                                INFO RESPONDEN</button>
                        </a>
                    </div>
                    <div class="w-full bottom-0">
                        <a href="/skm#pertama">
                            <button type="button"
                                class="bg-white w-full b-0 p-4 shadow-2xl text-xl font-black  rounded-2xl  text-[#02A859] ">
                                KLIK UNTUK
                                MEMULAI
                                SURVEI</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-col col-span-3 justify-stretch h-full gap-5">

                <div class="lg:grid lg:grid-cols-3 gap-3 h-full">
                    <div
                        class="col-span-2 rounded-xl overflow-hidden justify-stretch p-1 lg:h-full h-fit mb-3 lg:mb-0  bg-white ">
                        <div class="bg-white rounded-xl  w-full">
                            <canvas id="myChart" height="120" width="full" class="w-full m-2"></canvas>
                        </div>
                        <table class="w-full rounded-xl ">
                            <thead
                                class="bg-gradient-to-br from-[#02A859]  to-[#008952] font-normal border text-3xl lg:text-sm text-white">
                                <tr class="">
                                    <th scope="col" class=" px-4 py-1 ">No</th>
                                    <th scope="col" class=" px-4 py-1 ">Unsur Pelayanan</th>
                                    <th scope="col" class=" px-4 py-1 ">Nilai Unsur Pelayanan</th>
                                    <th scope="col" class=" px-4 py-1 ">Mutu Pelayanan</th>
                                </tr>
                            </thead>
                            <tbody class="border">
                                <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                    <td
                                        class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        1
                                    </td>
                                    <td
                                        class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        Persyaratan
                                    </td>
                                    <td
                                        class="whitespace-nowrap text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? '00' : sprintf('%0.3f', $nrr1) }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap  text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        <?php
                                        if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
                                            echo 'E';
                                        } elseif ($nrr1 >= 0.0 and $nrr1 <= 0.99) {
                                            echo 'E';
                                        } elseif ($nrr1 >= 1.0 and $nrr1 <= 2.599) {
                                            echo 'D';
                                        } elseif ($nrr1 >= 2.6 and $nrr1 <= 3.064) {
                                            echo 'C';
                                        } elseif ($nrr1 >= 3.064 and $nrr1 <= 3.532) {
                                            echo 'B';
                                        } else {
                                            echo 'A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                    <td
                                        class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        2
                                    </td>
                                    <td
                                        class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        Prosedur Pelayanan
                                    </td>
                                    <td
                                        class="whitespace-nowrap text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? '00' : sprintf('%0.3f', $nrr2) }}

                                    </td>
                                    <td
                                        class="whitespace-nowrap  text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        <?php
                                        if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
                                            echo 'E';
                                        } elseif ($nrr2 >= 0.0 and $nrr2 <= 0.99) {
                                            echo 'E';
                                        } elseif ($nrr2 >= 1.0 and $nrr2 <= 2.599) {
                                            echo 'D';
                                        } elseif ($nrr2 >= 2.6 and $nrr2 <= 3.064) {
                                            echo 'C';
                                        } elseif ($nrr2 >= 3.064 and $nrr2 <= 3.532) {
                                            echo 'B';
                                        } else {
                                            echo 'A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                    <td
                                        class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        3
                                    </td>
                                    <td
                                        class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        Waktu Pelaksana
                                    </td>
                                    <td
                                        class="whitespace-nowrap text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? '00' : sprintf('%0.3f', $nrr3) }}

                                    </td>
                                    <td
                                        class="whitespace-nowrap  text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        <?php
                                        if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
                                            echo 'E';
                                        } elseif ($nrr3 >= 0.0 and $nrr3 <= 0.99) {
                                            echo 'E';
                                        } elseif ($nrr3 >= 1.0 and $nrr3 <= 2.599) {
                                            echo 'D';
                                        } elseif ($nrr3 >= 2.6 and $nrr3 <= 3.064) {
                                            echo 'C';
                                        } elseif ($nrr3 >= 3.064 and $nrr3 <= 3.532) {
                                            echo 'B';
                                        } else {
                                            echo 'A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                    <td
                                        class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        4
                                    </td>
                                    <td
                                        class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        Biaya / Tarif
                                    </td>
                                    <td
                                        class="whitespace-nowrap text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? '00' : sprintf('%0.3f', $nrr4) }}

                                    </td>
                                    <td
                                        class="whitespace-nowrap  text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        <?php
                                        if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
                                            echo 'E';
                                        } elseif ($nrr4 >= 0.0 and $nrr4 <= 0.99) {
                                            echo 'E';
                                        } elseif ($nrr4 >= 1.0 and $nrr4 <= 2.599) {
                                            echo 'D';
                                        } elseif ($nrr4 >= 2.6 and $nrr4 <= 3.064) {
                                            echo 'C';
                                        } elseif ($nrr4 >= 3.064 and $nrr4 <= 3.532) {
                                            echo 'B';
                                        } else {
                                            echo 'A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                    <td
                                        class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        5
                                    </td>
                                    <td
                                        class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        Produk Layanan
                                    </td>
                                    <td
                                        class="whitespace-nowrap text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? '00' : sprintf('%0.3f', $nrr5) }}

                                    </td>
                                    <td
                                        class="whitespace-nowrap  text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        <?php
                                        if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
                                            echo 'E';
                                        } elseif ($nrr5 >= 0.0 and $nrr5 <= 0.99) {
                                            echo 'E';
                                        } elseif ($nrr5 >= 1.0 and $nrr5 <= 2.599) {
                                            echo 'D';
                                        } elseif ($nrr5 >= 2.6 and $nrr5 <= 3.064) {
                                            echo 'C';
                                        } elseif ($nrr5 >= 3.064 and $nrr5 <= 3.532) {
                                            echo 'B';
                                        } else {
                                            echo 'A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                    <td
                                        class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        6
                                    </td>
                                    <td
                                        class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        Kompetensi Pelaksana
                                    </td>
                                    <td
                                        class="whitespace-nowrap text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? '00' : sprintf('%0.3f', $nrr6) }}

                                    </td>
                                    <td
                                        class="whitespace-nowrap  text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        <?php
                                        if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
                                            echo 'E';
                                        } elseif ($nrr6 >= 0.0 and $nrr6 <= 0.99) {
                                            echo 'E';
                                        } elseif ($nrr6 >= 1.0 and $nrr6 <= 2.599) {
                                            echo 'D';
                                        } elseif ($nrr6 >= 2.6 and $nrr6 <= 3.064) {
                                            echo 'C';
                                        } elseif ($nrr6 >= 3.064 and $nrr6 <= 3.532) {
                                            echo 'B';
                                        } else {
                                            echo 'A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                    <td
                                        class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        7
                                    </td>
                                    <td
                                        class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        Perilaku Pelaksana
                                    </td>
                                    <td
                                        class="whitespace-nowrap text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? '00' : sprintf('%0.3f', $nrr7) }}

                                    </td>
                                    <td
                                        class="whitespace-nowrap  text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        <?php
                                        if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
                                            echo 'E';
                                        } elseif ($nrr7 >= 0.0 and $nrr7 <= 0.99) {
                                            echo 'E';
                                        } elseif ($nrr7 >= 1.0 and $nrr7 <= 2.599) {
                                            echo 'D';
                                        } elseif ($nrr7 >= 2.6 and $nrr7 <= 3.064) {
                                            echo 'C';
                                        } elseif ($nrr7 >= 3.064 and $nrr7 <= 3.532) {
                                            echo 'B';
                                        } else {
                                            echo 'A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                    <td
                                        class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        8
                                    </td>
                                    <td class="whitespace-wrap  px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        Sarana dan Prasarana
                                    </td>
                                    <td
                                        class="whitespace-nowrap text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? '00' : sprintf('%0.3f', $nrr8) }}

                                    </td>
                                    <td
                                        class="whitespace-nowrap  text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        <?php
                                        if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
                                            echo 'E';
                                        } elseif ($nrr8 >= 0.0 and $nrr8 <= 0.99) {
                                            echo 'E';
                                        } elseif ($nrr8 >= 1.0 and $nrr8 <= 2.599) {
                                            echo 'D';
                                        } elseif ($nrr8 >= 2.6 and $nrr8 <= 3.064) {
                                            echo 'C';
                                        } elseif ($nrr8 >= 3.064 and $nrr8 <= 3.532) {
                                            echo 'B';
                                        } else {
                                            echo 'A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                    <td
                                        class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        9
                                    </td>
                                    <td
                                        class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        Penanganan Pengaduan
                                    </td>
                                    <td
                                        class="whitespace-nowrap text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        {{ ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') ? '00' : sprintf('%0.3f', $nrr9) }}

                                    </td>
                                    <td
                                        class="whitespace-nowrap  text-center px-4 font-normal text-3xl py-2 lg:py-auto lg:text-xs">
                                        <?php
                                        if ($_GET['Tahun'] == '2023' or $_GET['Tahun'] == '2025') {
                                            echo 'E';
                                        } elseif ($nrr9 >= 0.0 and $nrr9 <= 0.99) {
                                            echo 'E';
                                        } elseif ($nrr9 >= 1.0 and $nrr9 <= 2.599) {
                                            echo 'D';
                                        } elseif ($nrr9 >= 2.6 and $nrr9 <= 3.064) {
                                            echo 'C';
                                        } elseif ($nrr9 >= 3.064 and $nrr9 <= 3.532) {
                                            echo 'B';
                                        } else {
                                            echo 'A';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col gap-3 justify-stretch">
                        <div class="rounded-xl overflow-hidden h-fit  lg:h-2/3 p-1 bg-white items-center">
                            <table class="w-full rounded-xl h-fit ">
                                <thead
                                    class="bg-gradient-to-br from-[#02A859]  to-[#008952] font-normal border text-5xl lg:text-sm text-white">
                                    <tr class="">
                                        <th scope="col" class=" px-4 py-1">TOTAL <br
                                                class="hidden lg:block">RESPONDEN </th>
                                    </tr>
                                </thead>
                            </table>
                            <div
                                class="font-extrabold   flex text-center lg:mt-5 justify-center py-5 lgp-0 text-9xl lg:text-7xl text-transparent bg-clip-text bg-gradient-to-tl from-[#02A859]  via-[#02A859] to-[#02A859] ">
                                {{ $jmlResponden }}
                            </div>
                        </div>
                        <div class="col-span-1 rounded-xl overflow-hidden lg:h-full p-1 h-fit lg:h-1/3  bg-white">
                            <table class="w-full rounded-xl h-full ">
                                <thead
                                    class="bg-gradient-to-br from-[#02A859]  to-[#008952] font-normal border text-5xl lg:text-sm text-white">
                                    <tr class="">
                                        <th scope="col" class=" px-4 py-1 lg:hidden">Nilai Interval </th>
                                        <th scope="col" class=" px-4 py-1 lg:hidden">Nilai Konversi </th>
                                        <th scope="col" class=" px-4 py-1">Mutu </th>
                                        <th scope="col" class=" px-4 py-1">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="border">
                                    <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                        <td
                                            class="whitespace-nowrap lg:hidden text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            3,532 - 4,000
                                        </td>
                                        <td
                                            class="whitespace-nowrap lg:hidden text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            88,31 - 100,00
                                        </td>
                                        <td
                                            class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            A
                                        </td>
                                        <td
                                            class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-0 lg:text-xs text-center  ">
                                            Sangat Memuaskan
                                            <label class="hidden justify-center w-full lg:flex"> 88,31 - 100,00
                                            </label>
                                        </td>
                                    </tr>
                                    <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                        <td
                                            class="whitespace-nowrap lg:hidden text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            3,064 - 3,532
                                        </td>
                                        <td
                                            class="whitespace-nowrap lg:hidden text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            76,61 - 88,30
                                        </td>
                                        <td
                                            class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            B
                                        </td>
                                        <td
                                            class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-0 lg:text-xs text-center  ">
                                            Memuaskan
                                            <label class="hidden justify-center w-full lg:flex"> 76,61 - 88,30
                                            </label>
                                        </td>
                                    </tr>
                                    <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                        <td
                                            class="whitespace-nowrap lg:hidden text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            2,600 - 3,064
                                        </td>
                                        <td
                                            class="whitespace-nowrap lg:hidden text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            65,00 - 76,60
                                        </td>
                                        <td
                                            class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            C
                                        </td>
                                        <td
                                            class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-0 lg:text-xs text-center  ">
                                            Kurang Memuaskan
                                            <label class="hidden justify-center w-full lg:flex"> 65,00 - 76,60
                                            </label>
                                        </td>
                                    </tr>
                                    <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                        <td
                                            class="whitespace-nowrap lg:hidden text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            1,000 - 2,599
                                        </td>
                                        <td
                                            class="whitespace-nowrap lg:hidden text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            25,00 - 64,99
                                        </td>
                                        <td
                                            class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            D
                                        </td>
                                        <td
                                            class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-0 lg:text-xs text-center  ">
                                            Tidak Memuaskan
                                            <label class="hidden justify-center w-full lg:flex"> 25,00 - 64,99
                                            </label>
                                        </td>
                                    </tr>
                                    <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                        <td
                                            class="whitespace-nowrap lg:hidden text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            0,000 - 0,999
                                        </td>
                                        <td
                                            class="whitespace-nowrap lg:hidden text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            0,00 - 24,99
                                        </td>
                                        <td
                                            class="whitespace-nowrap text-center px-4 py-1 font-normal text-3xl py-2 lg:py-0 lg:text-xs">
                                            E
                                        </td>
                                        <td
                                            class="whitespace-nowrap  px-4 font-normal text-3xl py-2 lg:py-0 lg:text-xs text-center  ">
                                            Sangat Tidak <br class="hidden lg:flex">Memuaskan
                                            <label class="hidden justify-center w-full lg:flex"> 0,00 - 24,99
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 mt-2 lg:gap-2  lg:hidden">
                        <div class="w-full bottom-0">
                            <a href="/dashboard">
                                <button type="button"
                                    class="bg-white w-full b-0 p-5  shadow-2xl text-4xl font-black  rounded-2xl  text-[#02A859] ">
                                    INFO RESPONDEN</button>
                            </a>
                        </div>
                        <div class="w-full lg:mb-0 mb-10 bottom-0">
                            <a href="/skm">
                                <button type="button"
                                    class="bg-white w-full b-0 p-5  shadow-2xl text-4xl font-black  rounded-2xl  text-[#02A859] ">
                                    KLIK UNTUK
                                    MEMULAI
                                    SURVEI</button>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>
</body>
<script>
    var data = {{ $nilaiSkm }};
    // var label = {{ $singkatan }};
    var bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nop', 'Des'];
    var bln = [];
    var jum = {{ $jml }};

    let str = '';

    for (let i = 0; i < jum; i++) {
        bln[i] = bulan[i];
    }

    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: bulan,
            datasets: [{
                label: 'Nilai SKM',
                data: data,
                borderWidth: 1,
                borderColor: '#02A859',
                backgroundColor: '#02A859',

            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }

    });
</script>

</body>

</html>
