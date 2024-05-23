@extends('layouts.index', ['title' => 'Dashboard'])
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
@section('content')
    <div class="absolute top-0 left-[215px] h-screen w-10/12 p-2">
        <div class="bg-white h-full w-full rounded-xl p-3  mb-2">
            <div class="w-full ">
                <div class="flex w-full h-fit justify-between items-center -mt-2 ">
                    <p class="text-[25px] font-black text-[#01683d]">Dashboard</p>
                    <div class="flex justify-between items-center py-4 ">
                        <div>
                            <label class="text-white font-bold text-xl"> </label>
                        </div>
                        <?php

                        error_reporting(0);
                        if ($_GET['triwulan'] == '') {
                        } else {
                            $_SESSION['triwulan'] = $_GET['triwulan'];
                        }

                        if ($_GET['tw'] == '') {
                        } else {
                            $_SESSION['tw'] = $_GET['tw'];
                        }
                        ?>
                        <div class="flex flex-row items-center gap-3">

                            {{-- tahun --}}
                            <div class="flex flex-row items-center gap-3 mb-5 lg:mb-0">
                                <label for="countries" class=" font-bold text-[#01683d] text-5xl lg:text-base ">
                                    Tahun</label>

                                <?php if($_GET['Tahun'] == ''){ ?>
                                <select id="countries" id="language"
                                    onChange="document.location.href='?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw=' + {{ $_GET['tw'] == null ? '2024' : $_GET['tw'] }} + '&Tahun=' + this.value   "
                                    class="bg-white border border-gray-300 text-[#01683d] font-bold text-5xl w-[250px] text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">
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
                                    onChange="document.location.href='?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw=' + {{ $_GET['tw'] == null ? '2024' : $_GET['tw'] }} + '&Tahun=' + this.value   "
                                    class="bg-white border border-gray-300 text-[#01683d] font-bold text-5xl w-[250px] text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">
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

                            {{-- triwulan --}}

                            <div class="flex flex-row items-center gap-3 mb-5 lg:mb-0">
                                <label for="countries" class=" font-bold text-[#155748] text-5xl lg:text-base">
                                    Triwulan</label>
                                <?php if($_GET['tw'] == ''){ ?>
                                <select id="countries" id="language"
                                    onChange="document.location.href='?tw=' + this.value + '&Tahun=' + {{ $_GET['Tahun'] == null ? '2024' : $_GET['Tahun'] }} "
                                    class="bg-white border border-gray-300 text-[#155748] font-bold text-5xl w-full text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">

                                    <option value="1" <?php if (date('m') == 1) {
                                        echo 'selected';
                                    } else {
                                    } ?>>Triwulan 1 (Jan, Feb, Mar)</option>

                                    <option value="2" <?php if (date('m') == 2) {
                                        echo 'selected';
                                    } else {
                                    } ?>>Triwulan 2 (Apr, Mei, Jun)</option>

                                    <option value="3" <?php if (date('m') == 3) {
                                        echo 'selected';
                                    } else {
                                    } ?>>Triwulan 2 (Jan s/d Jun)</option>

                                    <option value="4" <?php if (date('m') == 4) {
                                        echo 'selected';
                                    } else {
                                    } ?>>Triwulan 3 (Jul, Agu, Sep)</option>

                                    <option value="5" <?php if (date('m') == 5) {
                                        echo 'selected';
                                    } else {
                                    } ?>>Triwulan 3 (Jan s/d Sep)</option>

                                    <option value="6" <?php if (date('m') == 6) {
                                        echo 'selected';
                                    } else {
                                    } ?>>Triwulan 4 (Okt, Nop, Des)</option>

                                    <option value="7" <?php if (date('m') == 7) {
                                        echo 'selected';
                                    } else {
                                    } ?>>Triwulan 4 (Jan s/d Des)</option>
                                </select>
                                <?php  } else {?>
                                <select id="countries" id="language"
                                    onChange="document.location.href='?tw=' + this.value + '&Tahun=' + {{ $_GET['Tahun'] == null ? '2024' : $_GET['Tahun'] }}"
                                    class="bg-white border border-gray-300 text-[#155748] font-bold text-5xl w-[300px] text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">

                                    <option value="1" <?php
                                    if ($_GET['tw'] == 1) {
                                        echo 'selected';
                                    } else {
                                    }
                                    ?>>Triwulan 1 (Jan, Feb, Mar)</option>

                                    <option value="2" <?php
                                    if ($_GET['tw'] == 2) {
                                        echo 'selected';
                                    } else {
                                    }
                                    ?>>Triwulan 2 (Apr, Mei, Jun)</option>

                                    <option value="3" <?php
                                    if ($_GET['tw'] == 3) {
                                        echo 'selected';
                                    } else {
                                    }
                                    ?>>Triwulan 2 (Jan s/d Jun)</option>

                                    <option value="4" <?php
                                    if ($_GET['tw'] == 4) {
                                        echo 'selected';
                                    } else {
                                    }
                                    ?>>Triwulan 3 (Jul, Agu, Sep)</option>

                                    <option value="5" <?php
                                    if ($_GET['tw'] == 5) {
                                        echo 'selected';
                                    } else {
                                    }
                                    ?>>Triwulan 3 (Jan s/d Sep)</option>

                                    <option value="6" <?php
                                    if ($_GET['tw'] == 6) {
                                        echo 'selected';
                                    } else {
                                    }
                                    ?>>Triwulan 4 (Okt, Nop, Des)</option>

                                    <option value="7" <?php
                                    if ($_GET['tw'] == 7) {
                                        echo 'selected';
                                    } else {
                                    }
                                    ?>>Triwulan 4 (Jan s/d Des)</option>
                                </select>
                                <?php
                    }?>

                            </div>
                            {{-- download --}}
                            <a href="/exportResume?jenkel={{ $_GET['jenkel'] }}&usia={{ $_GET['usia'] }}&pekerjaan={{ $_GET['pekerjaan'] }}&pendidikan={{ $_GET['pendidikan'] }}&tahun={{ $_GET['tahun'] }}"
                                class="py-1 text-center items-center  bg-[#155748] rounded-full font-bold text-sm px-3  w-full  text-white"
                                style="font-family:'Roboto'">
                                <p>DOWNLOAD</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="-m-1.5  ">
                    <div class="p-1.5 ">
                        <div class="border border-[#02A859] rounded-lg overflow-hidden h-[500px] overflow-y-auto">
                            <div class="flex grid grid-cols-2  mt-4 gap-2  mb-5 h-full">
                                <div class="bg-white rounded-xl ">
                                    <p class=" p-3 font-bold text-[#1e6653]">Jenis Kelamin</p>
                                    <div id="jenkel" class="mt-2  p-2"></div>
                                </div>
                                <div class="bg-white rounded-xl p-3 flex flex-col justify-between">
                                    <p class=" font-bold text-[#1e6653] mb-3">Jenis Kelamin</p>
                                    <table class="w-full rounded-xl h-full">
                                        <thead
                                            class="h-fit bg-gradient-to-br from-[#02A859]   to-[#008952] font-normal border text-sm text-white">
                                            <tr class="">
                                                <th scope="col" class=" px-4 py-1">No</th>
                                                <th scope="col" class=" px-4 py-1">Jenis Kelamin</th>
                                                <th scope="col" class=" px-4 py-1 whitespace-nowrap">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border ">
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    1
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    Laki - Laki
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $jenkel_l }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    2
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    Perempuan
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $jenkel_p }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="bg-white rounded-xl ">
                                    <p class=" p-3 font-bold text-[#1e6653]">Rentang Umur</p>
                                    <div id="umur" class="mt-2 p-2"></div>
                                </div>
                                <div class="bg-white rounded-xl p-3 flex flex-col justify-between">
                                    <p class=" font-bold text-[#1e6653] mb-3">Rentang Umur</p>
                                    <table class="w-full rounded-xl h-full">
                                        <thead
                                            class="h-fit bg-gradient-to-br from-[#02A859]   to-[#008952] font-normal border text-sm text-white">
                                            <tr class="">
                                                <th scope="col" class=" px-4 py-1">No</th>
                                                <th scope="col" class=" px-4 py-1">Rentang Umur</th>
                                                <th scope="col" class=" px-4 py-1 whitespace-nowrap">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border ">
                                            <tr class="border-b dark:border-neutral-500 bg-white  bg-text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    1
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    Kurang dari 30 Tahun
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $umur_1 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    2
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    30 s/d 40 Tahun
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $umur_2 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    3
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    41 s/d 50 Tahun
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $umur_3 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    4
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    Lebih dari 50 Tahun
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $umur_4 }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="bg-white rounded-xl ">
                                    <p class=" p-3 font-bold text-[#1e6653]">Tingkat Pendidikan</p>
                                    <div id="pendidikan" class="mt-2  p-2 "></div>
                                </div>
                                <div class="bg-white rounded-xl p-3 flex flex-col justify-between">
                                    <p class=" font-bold text-[#1e6653] mb-3">Tingkat Pendidikan</p>
                                    <table class="w-full rounded-xl h-full">
                                        <thead
                                            class="h-fit bg-gradient-to-br from-[#02A859]   to-[#008952] font-normal border text-sm text-white">
                                            <tr class="">
                                                <th scope="col" class=" px-4 py-1">No</th>
                                                <th scope="col" class=" px-4 py-1">Tingkat Pendidikan</th>
                                                <th scope="col" class=" px-4 py-1 whitespace-nowrap">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border ">
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    1
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    SD
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pendidikan_1 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    2
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    SMP
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pendidikan_2 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    3
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    SMA / SMK
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pendidikan_3 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    4
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    D-I / D-III
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pendidikan_4 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    5
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    S1 / Setara
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pendidikan_5 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    6
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    S2 / S3
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pendidikan_6 }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="bg-white rounded-xl ">
                                    <p class=" p-3 font-bold text-[#1e6653]">Jenis Pekerjaan</p>
                                    <div id="pekerjaan" class="mt-2 p-2"></div>
                                </div>
                                <div class="bg-white rounded-xl p-3 flex flex-col justify-between">
                                    <p class=" font-bold text-[#1e6653] mb-3">Jenis Pekerjaan</p>
                                    <table class="w-full rounded-xl h-full">
                                        <thead
                                            class="h-fit bg-gradient-to-br from-[#02A859]   to-[#008952] font-normal border text-sm text-white">
                                            <tr class="">
                                                <th scope="col" class=" px-4 py-1">No</th>
                                                <th scope="col" class=" px-4 py-1">Jenis Pekerjaan</th>
                                                <th scope="col" class=" px-4 py-1 whitespace-nowrap">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border ">
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    1
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    ASN
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pekerjaan_1 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    2
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    TNI / POLRI
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pekerjaan_2 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    3
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    Swasta
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pekerjaan_3 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    4
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    Pengusaha
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pekerjaan_4 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    5
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    Pelajar
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pekerjaan_5 }}
                                                </td>
                                            </tr>
                                            <tr class="border-b dark:border-neutral-500 bg-white  text-xs">
                                                <td class="whitespace-nowrap text-center px-4 py-1 font-normal text-xs">
                                                    6
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    Lainnya
                                                </td>
                                                <td class="whitespace-nowrap  px-4 font-normal text-center text-xs">
                                                    {{ $pekerjaan_6 }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        height: 220,
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
                            fontFamily: "Inter, sans-serif"
                        },
                        formatter: function(value) {
                            return value.toFixed(2) + ' %'
                        }
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
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
                        height: 220,
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
                            fontFamily: "Inter, sans-serif"
                        },
                        formatter: function(value) {
                            return value.toFixed(2) + ' %'
                        }
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
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
                        height: 220,
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
                            fontFamily: "Inter, sans-serif"
                        },
                        formatter: function(value) {
                            return value.toFixed(2) + ' %'
                        }
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
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
                        height: 220,
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
                            fontFamily: "Inter, sans-serif"
                        },
                        formatter: function(value) {
                            return value.toFixed(2) + ' %'
                        }
                    },
                    legend: {
                        position: "bottom",
                        fontFamily: "Inter, sans-serif",
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
@endsection
