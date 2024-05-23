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

$jenkel_l = DB::table('2024')
    ->where('jenkel', '=', 'Laki - Laki')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$jenkel_p = DB::table('2024')
    ->where('jenkel', '=', 'Perempuan')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$umur_1 = DB::table('2024')
    ->whereBetween('usia', [0, 29])
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$umur_2 = DB::table('2024')
    ->whereBetween('usia', [30, 40])
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$umur_3 = DB::table('2024')
    ->whereBetween('usia', [41, 50])
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$umur_4 = DB::table('2024')
    ->whereBetween('usia', [51, 100])
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pendidikan_1 = DB::table('2024')
    ->where('pendidikan', '=', 'SD')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pendidikan_2 = DB::table('2024')
    ->where('pendidikan', '=', 'SMP')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pendidikan_3 = DB::table('2024')
    ->where('pendidikan', '=', 'SMA / SMK')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pendidikan_4 = DB::table('2024')
    ->where('pendidikan', '=', 'D-I / D-III')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pendidikan_5 = DB::table('2024')
    ->where('pendidikan', '=', 'S1 / Setara')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pendidikan_6 = DB::table('2024')
    ->where('pendidikan', '=', 'S2 / S3')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pekerjaan_1 = DB::table('2024')
    ->where('pekerjaan', '=', 'ASN')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pekerjaan_2 = DB::table('2024')
    ->where('pekerjaan', '=', 'TNI / POLRI')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pekerjaan_3 = DB::table('2024')
    ->where('pekerjaan', '=', 'Swasta')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pekerjaan_4 = DB::table('2024')
    ->where('pekerjaan', '=', 'Pengusaha')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pekerjaan_5 = DB::table('2024')
    ->where('pekerjaan', '=', 'Pelajar')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

$pekerjaan_6 = DB::table('2024')
    ->where('pekerjaan', '=', 'Lainnya')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

?>

<!doctype html>
<html class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" conteitial-scale="1.0">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="items-center bg-fixed w-full grid grid-cols-1"
    style="
    background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
    <div class="h-screen lg:px-20 px-3 flex flex-col ">
        <div class="flex justify-between py-[20px] lg:py-1 items-center">
            <div class="flex items-center gap-3 justify-between w-full lg:justify-normal">
                <img src="/assets/bapendasmd.png" class="h-[100px] lg:h-[48px] p-0.5 rounded-xl bg-white"
                    alt="">
                <div
                    class="rounded-full lg:whitespace-nowrap text-4xl lg:text-2xl font-bold text-white lg:text-left text-right drop-shadow-[0_3px_3px_rgba(0,0,0,0.3)]">
                    E-SKM <br class="lg:hidden"> UPTD PPRD SAMARINDA
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
                            class="bg-white border border-gray-300 text-[#02A859] font-bold text-4xl w-full text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">

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
                            class="bg-white border border-gray-300 text-[#02A859] font-bold text-4xl w-[300px] text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">

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
        </div>

        <div class="flex grid grid-cols-1 lg:grid-cols-2  gap-2  mb-5 h-full text-5xl lg:text-sm">
            <div class="bg-white rounded-xl">
                <p class="absolute p-3 font-bold text-[#1e6653]">Jenis Kelamin</p>
                <div id="jenkel" class="mt-12 lg:mt-2 mx-auto p-2 w-2/3"></div>
            </div>
            <div class="bg-white rounded-xl p-3 flex flex-col justify-between">
                <p class=" font-bold text-[#1e6653] mb-3">Jenis Kelamin</p>
                <table class="w-full rounded-xl h-full">
                    <thead
                        class="h-fit bg-gradient-to-br from-[#02A859]   to-[#008952] font-normal border text-sm text-white">
                        <tr class="">
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1">No</th>
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1">Jenis Kelamin</th>
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1 whitespace-nowrap">Jumlah
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border ">
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                1
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                Laki - Laki
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $jenkel_l }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                2
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                Perempuan
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $jenkel_p }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white rounded-xl ">
                <p class="absolute p-3 font-bold text-[#1e6653]">Rentang Umur</p>
                <div id="umur" class="mt-12 lg:mt-2 mx-auto p-2 w-2/3"></div>
            </div>
            <div class="bg-white rounded-xl p-3 flex flex-col justify-between">
                <p class=" font-bold text-[#1e6653] mb-3">Rentang Umur</p>
                <table class="w-full rounded-xl h-full">
                    <thead
                        class="h-fit bg-gradient-to-br from-[#02A859]   to-[#008952] font-normal border text-sm text-white">
                        <tr class="">
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1">No</th>
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1">Rentang Umur</th>
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1 whitespace-nowrap">Jumlah
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border ">
                        <tr class="border-b dark:border-neutral-500 bg-white  bg-">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                1
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                Kurang dari 30 Tahun
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $umur_1 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                2
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                30 s/d 40 Tahun
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $umur_2 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                3
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                41 s/d 50 Tahun
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $umur_3 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                4
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                Lebih dari 50 Tahun
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $umur_4 }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white rounded-xl ">
                <p class="absolute p-3 font-bold text-[#1e6653]">Tingkat Pendidikan</p>
                <div id="pendidikan" class="mt-12 lg:mt-2 mx-auto p-2 w-2/3"></div>
            </div>
            <div class="bg-white rounded-xl p-3 flex flex-col justify-between">
                <p class=" font-bold text-[#1e6653] mb-3">Tingkat Pendidikan</p>
                <table class="w-full rounded-xl h-full">
                    <thead
                        class="h-fit bg-gradient-to-br from-[#02A859]   to-[#008952] font-normal border text-sm text-white">
                        <tr class="">
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1">No</th>
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1">Tingkat Pendidikan</th>
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1 whitespace-nowrap">Jumlah
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border ">
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                1
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                SD
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pendidikan_1 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                2
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                SMP
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pendidikan_2 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                3
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                SMA / SMK
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pendidikan_3 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                4
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                D-I / D-III
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pendidikan_4 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                5
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                S1 / Setara
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pendidikan_5 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                6
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                S2 / S3
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pendidikan_6 }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white rounded-xl ">
                <p class="absolute p-3 font-bold text-[#1e6653]">Jenis Pekerjaan</p>
                <div id="pekerjaan" class="mt-12 lg:mt-2 mx-auto p-2 w-2/3"></div>
            </div>
            <div class="bg-white rounded-xl p-3 flex flex-col justify-between">
                <p class=" font-bold text-[#1e6653] mb-3">Jenis Pekerjaan</p>
                <table class="w-full rounded-xl h-full">
                    <thead
                        class="h-fit bg-gradient-to-br from-[#02A859]   to-[#008952] font-normal border text-sm text-white">
                        <tr class="">
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1">No</th>
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1">Jenis Pekerjaan</th>
                            <th scope="col" class="text-5xl lg:text-sm  px-4 py-5 lg:py-1 whitespace-nowrap">Jumlah
                            </th>
                        </tr>
                    </thead>
                    <tbody class="border ">
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                1
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                ASN
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pekerjaan_1 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                2
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                TNI / POLRI
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pekerjaan_2 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                3
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                Swasta
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pekerjaan_3 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                4
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                Pengusaha
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pekerjaan_4 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                5
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                Pelajar
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pekerjaan_5 }}
                            </td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500 bg-white  ">
                            <td class="whitespace-nowrap text-center px-4 py-5 lg:py-1 font-normal ">
                                6
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                Lainnya
                            </td>
                            <td class="whitespace-nowrap  px-4 font-normal text-center ">
                                {{ $pekerjaan_6 }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="lg:col-span-2">
                <a href="/">
                    <button type="button"
                        class="bg-white w-full b-0 p-3 mb-10 shadow-2xl text-5xl lg:text-xl font-semibold  rounded-2xl  text-[#1e6653] ">
                        KEMBALI KE DASHBOARD</button>
                </a>
            </div>

        </div>
    </div>

    <script>
        // ApexCharts options and config
        window.addEventListener("load", function() {
            const getChartOptions = () => {
                return {
                    series: [{{ $jenkel_l }}, {{ $jenkel_p }}],
                    colors: ["#1e6653", "#16BDCA", "#e26666"],
                    chart: {
                        height: "auto",
                        width: "100%",
                        type: "pie",
                    },
                    stroke: {
                        colors: ["white"],
                        lineCap: "",
                    },
                    plotOptions: {
                        pie: {
                            labels: {
                                show: true,
                            },
                            size: "100%",
                            dataLabels: {
                                offset: -20
                            }
                        },
                    },
                    labels: ["Laki - Laki", "Perempuan"],
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                        formatter: function(value) {
                            return value.toFixed(2) + ' %'
                        }
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                        fontSize: "20%"
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function(value) {
                                return value
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                }
            }
            if (document.getElementById("jenkel") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("jenkel"), getChartOptions());
                chart.render();
            }

            const getUmur = () => {
                return {
                    series: [{{ $umur_1 }}, {{ $umur_2 }},
                        {{ $umur_3 }}, {{ $umur_4 }}
                    ],
                    colors: ["#1e6653", "#16BDCA", "#e26666", "#383838"],
                    chart: {
                        height: "auto",
                        width: "100%",
                        type: "pie",
                    },
                    stroke: {
                        colors: ["white"],
                        lineCap: "",
                    },
                    plotOptions: {
                        pie: {
                            labels: {
                                show: true,
                            },
                            size: "100%",
                            dataLabels: {
                                offset: -20
                            }
                        },
                    },
                    labels: ["Kurang dari 30 Tahun", "30 s/d 40 Tahun", "41 s/d 50 Tahun",
                        "Lebih dari 50 Tahun"
                    ],
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                        formatter: function(value) {
                            return value.toFixed(2) + ' %'
                        }
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                        fontSize: "20%"
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function(value) {
                                return value
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                }
            }
            if (document.getElementById("umur") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("umur"), getUmur());
                chart.render();
            }

            const getPendidikan = () => {
                return {
                    series: [{{ $pendidikan_1 }}, {{ $pendidikan_2 }},
                        {{ $pendidikan_3 }}, {{ $pendidikan_4 }}, {{ $pendidikan_5 }},
                        {{ $pendidikan_6 }}
                    ],
                    colors: ["#1e6653", "#16BDCA", "#e26666", "#383838", "#ddf71d", "#521bd3"],
                    chart: {
                        height: "auto",
                        width: "100%",
                        type: "pie",
                    },
                    stroke: {
                        colors: ["white"],
                        lineCap: "",
                    },
                    plotOptions: {
                        pie: {
                            labels: {
                                show: true,
                            },
                            size: "100%",
                            dataLabels: {
                                offset: -20
                            }
                        },
                    },
                    labels: ["SD", "SMP", "SMA / SMK", "D-I / D-III", "S1 / Setara", "S2 / S3"],
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                        formatter: function(value) {
                            return value.toFixed(2) + ' %'
                        }
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                        fontSize: "20%"
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function(value) {
                                return value
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                }
            }
            if (document.getElementById("pendidikan") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("pendidikan"), getPendidikan());
                chart.render();
            }

            const getPekerjaan = () => {
                return {
                    series: [{{ $pekerjaan_1 }}, {{ $pekerjaan_2 }},
                        {{ $pekerjaan_3 }}, {{ $pekerjaan_4 }}, {{ $pekerjaan_5 }},
                        {{ $pekerjaan_6 }}
                    ],
                    colors: ["#1e6653", "#16BDCA", "#e26666", "#383838", "#ddf71d", "#521bd3"],
                    chart: {
                        height: "auto",
                        width: "100%",
                        type: "pie",
                    },
                    stroke: {
                        colors: ["white"],
                        lineCap: "",
                    },
                    plotOptions: {
                        pie: {
                            labels: {
                                show: true,
                            },
                            size: "100%",
                            dataLabels: {
                                offset: -20
                            }
                        },
                    },
                    labels: ["ASN", "TNI / POLRI", "Swasta", "Pengusaha", "Pelajar", "Lainnya"],
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                        formatter: function(value) {
                            return value.toFixed(2) + ' %'
                        }
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
                        fontSize: "20%"
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value
                            },
                        },
                    },
                    xaxis: {
                        labels: {
                            formatter: function(value) {
                                return value
                            },
                        },
                        axisTicks: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                    },
                }
            }
            if (document.getElementById("pekerjaan") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("pekerjaan"), getPekerjaan());
                chart.render();
            }
        });
    </script>

</body>

</html>
