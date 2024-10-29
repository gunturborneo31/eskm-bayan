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

$Ttl_Nilai_Unsur = $tu1 + $tu2 + $tu3 + $tu4 + $tu5 + $tu6 + $tu7 + $tu8 + $tu9;

$n = DB::table('2024')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->count();

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
    $nrr1 = sprintf('%0.2f', $tu1 / $n);
    $nrr2 = sprintf('%0.2f', $tu2 / $n);
    $nrr3 = sprintf('%0.2f', $tu3 / $n);
    $nrr4 = sprintf('%0.2f', $tu4 / $n);
    $nrr5 = sprintf('%0.2f', $tu5 / $n);
    $nrr6 = sprintf('%0.2f', $tu6 / $n);
    $nrr7 = sprintf('%0.2f', $tu7 / $n);
    $nrr8 = sprintf('%0.2f', $tu8 / $n);
    $nrr9 = sprintf('%0.2f', $tu9 / $n);

    $nrr = $nrr1 + $nrr2 + $nrr3 + $nrr4 + $nrr5 + $nrr6 + $nrr7 + $nrr8 + $nrr9;
    $nrr = sprintf('%0.2f', $nrr);

    $nrrt1 = sprintf('%0.2f', $nrr1 * 0.111);
    $nrrt2 = sprintf('%0.2f', $nrr2 * 0.111);
    $nrrt3 = sprintf('%0.2f', $nrr3 * 0.111);
    $nrrt4 = sprintf('%0.2f', $nrr4 * 0.111);
    $nrrt5 = sprintf('%0.2f', $nrr5 * 0.111);
    $nrrt6 = sprintf('%0.2f', $nrr6 * 0.111);
    $nrrt7 = sprintf('%0.2f', $nrr7 * 0.111);
    $nrrt8 = sprintf('%0.2f', $nrr8 * 0.111);
    $nrrt9 = sprintf('%0.2f', $nrr9 * 0.111);

    $nrrT = $nrrt1 + $nrrt2 + $nrrt3 + $nrrt4 + $nrrt5 + $nrrt6 + $nrrt7 + $nrrt8 + $nrrt9;
    $nrrT = sprintf('%0.2f', $nrrT);

    $nilaiSKM = $nrrT * 25;
}

?>

@extends('layouts.index', ['title' => 'Dashboard'])

@section('content')
    <div class="absolute top-0 left-[215px] h-screen w-10/12 p-2">
        <div class="bg-white h-full w-full rounded-xl p-3  mb-2">
            <div class="flex w-full justify-between items-center -mt-3">
                <p class="text-[25px] font-black text-[#01683d]">RESUME </p>
                <div class="flex justify-between items-center py-4 ">
                    <div>
                        <label class="text-white font-bold text-xl"> </label>
                    </div>
                    <?php

                    error_reporting(0);

                    ?>
                    <div class="flex flex-row items-center gap-3">

                        {{-- filter --}}
                        <div class="flex flex-row items-center gap-2">
                            <label for="countries" class=" font-bold text-[#01683d] text-sm ">
                                Filter</label>

                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                                class="flex items-center  bg-white border border-gray-300 text-[#005C3A] font-bold   text-sm rounded-full px-5 py-1"
                                type="button">Pilih <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdown"
                                class="z-10 hidden border bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <a href="/rekapTotal?jenkel={{ $_GET['jenkel'] == 0 ? 1 : 0 }}&usia={{ $_GET['usia'] }}&pekerjaan={{ $_GET['pekerjaan'] }}&pendidikan={{ $_GET['pendidikan'] }}&tahun={{ $_GET['tahun'] }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center gap-2">
                                            <p>Jenis kelamin</p>
                                            <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="4"
                                                stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 "
                                                {{ $_GET['jenkel'] == 0 ? 'hidden' : '' }}
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/rekapTotal?jenkel={{ $_GET['jenkel'] }}&usia={{ $_GET['usia'] == 0 ? 1 : 0 }}&pekerjaan={{ $_GET['pekerjaan'] }}&pendidikan={{ $_GET['pendidikan'] }}&tahun={{ $_GET['tahun'] }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center gap-2">
                                            <p>Usia</p>
                                            <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="4"
                                                stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 "
                                                {{ $_GET['usia'] == 0 ? 'hidden' : '' }}
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/rekapTotal?jenkel={{ $_GET['jenkel'] }}&usia={{ $_GET['usia'] }}&pekerjaan={{ $_GET['pekerjaan'] == 0 ? 1 : 0 }}&pendidikan={{ $_GET['pendidikan'] }}&tahun={{ $_GET['tahun'] }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center gap-2">
                                            <p>Pekerjaan</p>
                                            <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="4"
                                                stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 "
                                                {{ $_GET['pekerjaan'] == 0 ? 'hidden' : '' }}
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/rekapTotal?jenkel={{ $_GET['jenkel'] }}&usia={{ $_GET['usia'] }}&pekerjaan={{ $_GET['pekerjaan'] }}&pendidikan={{ $_GET['pendidikan'] == 0 ? 1 : 0 }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white flex items-center gap-2">
                                            <p>Pendidikan</p>
                                            <svg data-slot="icon" aria-hidden="true" fill="none" stroke-width="4"
                                                stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 "
                                                {{ $_GET['pendidikan'] == 0 ? 'hidden' : '' }}
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
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

                        {{-- tw --}}

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

            <div class="w-full ">
                <div class="-m-1.5  ">
                    <div class="p-1.5 ">
                        <div class="border border-[#02A859] rounded-lg overflow-hidden h-[460px] overflow-x-auto">
                            <table class="w-full divide-y divide-gray-200 h-full ">
                                <thead
                                    style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
                                    <tr>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            No.<br>RESPONDEN</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            NIK</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            NAMA</th>
                                        {{-- <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            JENIS<br>Pelayanan</th> --}}
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-white uppercase {{ $_GET['jenkel'] == 0 ? 'hidden' : '' }}">
                                            JENIS<br>KELAMIN</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-white uppercase {{ $_GET['usia'] == 0 ? 'hidden' : '' }}">
                                            USIA</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-white uppercase {{ $_GET['pekerjaan'] == 0 ? 'hidden' : '' }}">
                                            PEKERJAAN</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-white uppercase {{ $_GET['pendidikan'] == 0 ? 'hidden' : '' }}">
                                            PENDIDIKAN</th>
                                        <th scope="col" colspan="10"
                                            class=" px-6 px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase ">
                                            NILAI UNSUR PELAYANAN</th>
                                    </tr>
                                    <tr>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            U1</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            U2</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            U3</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            U4</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            U5</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            U6</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            U7</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            U8</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            U9</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            AKSI</th>
                                    </tr>
                                </thead>
                                <div class="h-200 overflow-y-auto">
                                    <tbody class="" style="overflow-y:auto;">
                                        <?php $row = 1; ?>
                                        @forelse($selects as $data)
                                            <tr class="{{ $row % 2 == 0 ? 'bg-[#E3E3E3]' : '' }}">

                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $row++ }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->nik }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->nama }}
                                                </td>
                                                {{-- <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->jenisPelayanan }}
                                                </td> --}}
                                                <td
                                                    class="text-center px-2 font-normal text-xs {{ $_GET['jenkel'] == 0 ? 'hidden' : '' }}">
                                                    {{ $data->jenkel }}
                                                </td>
                                                <td
                                                    class="text-center px-2 font-normal text-xs {{ $_GET['usia'] == 0 ? 'hidden' : '' }}">
                                                    {{ $data->usia }}
                                                </td>
                                                <td
                                                    class="text-center px-2 font-normal text-xs {{ $_GET['pekerjaan'] == 0 ? 'hidden' : '' }}">
                                                    {{ $data->pekerjaan }}
                                                </td>
                                                <td
                                                    class="text-center px-2 font-normal text-xs {{ $_GET['pendidikan'] == 0 ? 'hidden' : '' }}">
                                                    {{ $data->pendidikan }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->u1 }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->u2 }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->u3 }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->u4 }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->u5 }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->u6 }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->u7 }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->u8 }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->u9 }}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                        action="{{ route('rekapTotal.destroy', $data->id) }}"
                                                        method="POST">

                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-6 h-6 hover:text-red-700">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        <tr class="h-fit bg-white">

                                            <td class="text-center px-2 font-normal text-xs">
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="text-white"
                                        style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);
                                        overflow-y:auto;">
                                        <?php $row = 1; ?>
                                        <t>

                                            <td class="text-center px-2 font-normal text-xs">
                                                TOTAL
                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">

                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">

                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">

                                            </td>
                                            <td
                                                class="text-center px-2 font-normal text-xs {{ $_GET['jenkel'] == 0 ? 'hidden' : '' }}">

                                            </td>
                                            <td
                                                class="text-center px-2 font-normal text-xs {{ $_GET['usia'] == 0 ? 'hidden' : '' }}">

                                            </td>
                                            <td
                                                class="text-center px-2 font-normal text-xs {{ $_GET['pekerjaan'] == 0 ? 'hidden' : '' }}">

                                            </td>
                                            <td
                                                class="text-center px-2 font-normal text-xs {{ $_GET['pendidikan'] == 0 ? 'hidden' : '' }}">

                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">
                                                {{ $data->u1 }}
                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">
                                                {{ $data->u2 }}
                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">
                                                {{ $data->u3 }}
                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">
                                                {{ $data->u4 }}
                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">
                                                {{ $data->u5 }}
                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">
                                                {{ $data->u6 }}
                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">
                                                {{ $data->u7 }}
                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">
                                                {{ $data->u8 }}
                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">
                                                {{ $data->u9 }}
                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">

                                            </td>
                                            </tr>
                                    </tfoot>
                                </div>
                            </table>
                        </div>
                        <div class="mt-2">
                            {{ $selects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.12.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
