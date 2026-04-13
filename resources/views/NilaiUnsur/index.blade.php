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

$tu1 = DB::table('survey_responses')->where('tahun', $_GET['Tahun'] ?? date('Y'))
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u1');

$tu2 = DB::table('survey_responses')->where('tahun', $_GET['Tahun'] ?? date('Y'))
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u2');

$tu3 = DB::table('survey_responses')->where('tahun', $_GET['Tahun'] ?? date('Y'))
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u3');

$tu4 = DB::table('survey_responses')->where('tahun', $_GET['Tahun'] ?? date('Y'))
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u4');

$tu5 = DB::table('survey_responses')->where('tahun', $_GET['Tahun'] ?? date('Y'))
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u5');

$tu6 = DB::table('survey_responses')->where('tahun', $_GET['Tahun'] ?? date('Y'))
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u6');

$tu7 = DB::table('survey_responses')->where('tahun', $_GET['Tahun'] ?? date('Y'))
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u7');

$tu8 = DB::table('survey_responses')->where('tahun', $_GET['Tahun'] ?? date('Y'))
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u8');

$tu9 = DB::table('survey_responses')->where('tahun', $_GET['Tahun'] ?? date('Y'))
    ->whereBetween('created_at', [$startDate, $endDate])
    ->get()
    ->sum('u9');

$Ttl_Nilai_Unsur = $tu1 + $tu2 + $tu3 + $tu4 + $tu5 + $tu6 + $tu7 + $tu8 + $tu9;

$n = DB::table('survey_responses')->where('tahun', $_GET['Tahun'] ?? date('Y'))
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
}

?>

@php
    // role/keterangan dari URL login, contoh: ?keterangan=asisten2
    $role = request('keterangan', 'admin');
    $bagianQuery = request('bagian', '');

    // Semua opsi yang tersedia untuk ditampilkan
    $allOptions = \App\Support\BagianOptions::codeNameMap();
    $visibleKeys = \App\Support\BagianOptions::codesForRole($role);
@endphp

@extends('layouts.index', ['title' => 'nilaiUnsur'])

@section('content')
    <div class="admin-main">
        <div class="bg-white h-full w-full rounded-xl p-3  mb-2">
            <div class="admin-toolbar flex w-full justify-between items-start lg:items-center gap-3 flex-wrap lg:flex-nowrap">
                <p class="text-[25px] font-black text-gray-800">RESUME / PENDIDIKAN</p>
                <div class="flex justify-between items-center py-4 ">
                    <div>
                        <label class="text-gray-900 font-bold text-xl"> </label>
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
                        <div class="flex flex-row items-center gap-3">
                            <label for="tahun"
                                class=" font-bold text-gray-900 text-4xl lg:text-base drop-shadow-[0_3px_3px_rgba(0,0,0,0.3)]">
                                Tahun</label>
                            <select id="tahun"  
                                onChange="document.location.href='/nilaiUnsur?tw=' + {{ $_GET['tw'] }} + '&Tahun=' + this.value + '&bagian={{ $_GET['bagian'] }}'"
                                class="bg-white border border-gray-400 text-gray-900 font-bold text-4xl w-[200px] text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">
                    
                                <option value="2023" <?php if($_GET['Tahun']=='2023') echo 'selected'; ?>>2023</option>
                                <option value="2024" <?php if($_GET['Tahun']=='2024') echo 'selected'; ?>>2024</option>
                                <option value="2025" <?php if($_GET['Tahun']=='2024') echo 'selected'; ?>>2025</option>
                                <option value="2026" <?php if($_GET['Tahun']=='2026' || $_GET['Tahun']=='') echo 'selected'; ?>>2026</option>
                            </select>
                        </div>
                    
                        {{-- triwulan --}}
                        <div class="flex flex-row items-center gap-3">
                            <label for="tw"
                                class=" font-bold text-gray-900 text-4xl lg:text-base drop-shadow-[0_3px_3px_rgba(0,0,0,0.3)]">
                                Triwulan</label>
                            <select id="tw"
                                onChange="document.location.href='/nilaiUnsur?tw=' + this.value + '&Tahun=' + {{ $_GET['Tahun'] }} + '&bagian={{ $_GET['bagian'] }}'"
                                class="bg-white border border-gray-400 text-gray-900 font-bold text-4xl w-[300px] text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">
                    
                                <option value="1" <?php if($_GET['tw']=='1') echo 'selected'; ?>>TW 1 (Jan, Feb, Mar)</option>
                                <option value="2" <?php if($_GET['tw']=='2') echo 'selected'; ?>>TW 2 (Apr, Mei, Jun)</option>
                                <option value="3" <?php if($_GET['tw']=='3') echo 'selected'; ?>>TW 2 (Jan s/d Jun)</option>
                                <option value="4" <?php if($_GET['tw']=='4') echo 'selected'; ?>>TW 3 (Jul, Agu, Sep)</option>
                                <option value="5" <?php if($_GET['tw']=='5') echo 'selected'; ?>>TW 3 (Jan s/d Sep)</option>
                                <option value="6" <?php if($_GET['tw']=='6') echo 'selected'; ?>>TW 4 (Okt, Nop, Des)</option>
                                <option value="7" <?php if($_GET['tw']=='7') echo 'selected'; ?>>TW 4 (Jan s/d Des)</option>
                            </select>
                        </div>
                    
                        {{-- bagian --}}
                        <div class="flex flex-row items-center gap-2">
                            <label for="countries" class="text-black font-bold text-sm ">
                                Bagian</label>

                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdownP"
                                class="flex items-center  bg-[#ffffff] border border-gray-400 font-bold   text-sm rounded-full px-3 py-1"
                                type="button">Pilih <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdownP"
                                class="z-10 hidden border bg-[#ffffff] divide-y divide-gray-100 rounded-lg shadow w-[250px] dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownDefaultButton">
                                    <ul class="space-y-2 px-4 py-1  ">
                                        @foreach($allOptions as $key => $label)
                @if(in_array($key, $visibleKeys))
                <li class="flex items-center gap-4 py-1">
                    <input id="{{ $key }}" type="checkbox" value="{{ $key }}"
                        {{ str_contains($bagianQuery, $key) ? 'checked' : '' }}
                        class="w-4 h-4 text-orange-600 border-orange-300 rounded focus:ring-orange-500">
                    <label for="{{ $key }}" class="text-sm text-gray-700 dark:text-gray-200">
                    {{ $label }}
                    </label>
                </li>
                @endif
            @endforeach
                                    </ul>
                                    
                                    <!-- Tombol Tampilkan -->
                                    <div class="mt-4 px-4 py-1">
                                        <button onclick="submitCheckboxes()" 
                                                class="w-full px-4 py-2 text-gray-900 rounded-lg bg-gradient-to-br from-[#EA580C] from-60% font-bold to-[#FDBA74] to-95%">
                                        Tampilkan
                                        </button>
                                    </div>
                                    
                                    <script>
                                    function submitCheckboxes() {
                                        const checked = Array.from(document.querySelectorAll('input[type="checkbox"]:checked'))
                                                        .map(cb => cb.value);
                                        if (checked.length === 0) {
                                        alert("Silakan pilih minimal satu bagian!");
                                        return;
                                        }
                                        // Redirect dengan parameter bagian=... (dipisah koma)
                                        const tw = "{{ $_GET['tw'] }}";
                                        const tahun = "{{ $_GET['Tahun'] }}";
                                        const bagian = checked.join(",");
                                        window.location.href = `/nilaiUnsur?tw=${tw}&Tahun=${tahun}&bagian=${bagian}`;
                                    }
                                    </script>
                                    
                                    
                                </ul>
                            </div>
                        </div>

                        {{-- download --}}
                        <a href="{{ route('exports.download', ['type' => 'resume', 'jenkel' => $_GET['jenkel'], 'usia' => $_GET['usia'], 'pekerjaan' => $_GET['pekerjaan'], 'pendidikan' => $_GET['pendidikan'], 'tahun' => $_GET['tahun'], 'Tahun' => $_GET['Tahun'] ?? $_GET['tahun'] ?? date('Y'), 'Bulan' => $_GET['Bulan'] ?? null]) }}"
                            class="py-1 text-center items-center  bg-gradient-to-br from-[#EA580C] from-60%  to-[#FDBA74] to-95% rounded-full font-bold text-sm px-3  w-full  text-gray-900"
                            style="font-family:'Roboto'">
                            <p>DOWNLOAD</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full ">
                <div class="-m-1.5  ">
                    <div class="p-1.5 ">
                        <div class="border border-[#EA580C] rounded-lg overflow-hidden h-[335px]">
                            <table class="w-full divide-y divide-gray-200 ">
                                <thead class="bg-gradient-to-br from-[#EA580C] from-60%  to-[#FDBA74] to-95%">
                                    <tr>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            No.<br>RESPONDEN</th>
                                        <th scope="col" colspan="10"
                                            class=" px-6 px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase ">
                                            NILAI UNSUR PELAYANAN</th>
                                    </tr>
                                    <tr>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            U1</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            U2</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            U3</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            U4</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            U5</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            U6</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            U7</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            U8</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            U9</th>
                                        <th scope="col"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            HASIL</th>
                                    </tr>
                                </thead>
                                <div class="h-200 overflow-y-auto">
                                    <tbody class="" style="overflow-y:auto;">
                                        <?php $row = 1; ?>
                                        @forelse($selects as $data)
                                            <tr class="{{ $row % 2 == 0 ? 'bg-[#E3E3E3]' : '' }}">

                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $row++ }}
                                                </td>
                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $data->u1 }}
                                                </td>
                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $data->u2 }}
                                                </td>
                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $data->u3 }}
                                                </td>
                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $data->u4 }}
                                                </td>
                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $data->u5 }}
                                                </td>
                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $data->u6 }}
                                                </td>
                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $data->u7 }}
                                                </td>
                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $data->u8 }}
                                                </td>
                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $data->u9 }}
                                                </td>
                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">

                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse

                                    </tbody>
                                </div>
                            </table>
                        </div>


                        <div class="rounded-lg overflow-hidden  mt-1">
                            <table class="w-full divide-y divide-gray-200 ">
                                <thead
                                    style="background-color: #EA580C;
    background-image: 
        radial-gradient(at -30% -30%, #EA580C, transparent 100%),
        radial-gradient(at 130% 150%, #EA580C, transparent 100%);">
                                    <tr class="border-b  text-gray-900 font-bold"
                                        style="background-color: #EA580C;
    background-image:
        radial-gradient(at -30% -30%, #EA580C, transparent 100%),
        radial-gradient(at 130% 150%, #EA580C, transparent 100%);">
                                        <td class="whitespace-nowrap  px-2 py-2 w-[150px] text-left font-medium">Total
                                            Nilai
                                            Unsur
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $tu1 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $tu2 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $tu3 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $tu4 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $tu5 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $tu6 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $tu7 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $tu8 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $tu9 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 w-[100px] text-center font-medium">
                                            {{ $Ttl_Nilai_Unsur }}
                                        </td>
                                    </tr>
                                    <tr class="border-b text-gray-900 font-bold"
                                        style="background-color: #EA580C;
    background-image:
        radial-gradient(at -30% -30%, #EA580C, transparent 100%),
        radial-gradient(at 130% 150%, #EA580C, transparent 100%);">
                                        <td class="whitespace-nowrap  px-2 py-2 w-[150px] text-left font-medium">
                                            NRR Per Unsur
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrr1 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrr2 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrr3 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrr4 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrr5 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrr6 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrr7 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrr8 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrr9 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 w-[100px] text-center font-medium">
                                            {{ $nrr }}
                                        </td>
                                    </tr>
                                    <tr class="border-b text-gray-900 font-bold"
                                        style="background-color: #EA580C;
    background-image:
        radial-gradient(at -30% -30%, #EA580C, transparent 100%),
        radial-gradient(at 130% 150%, #EA580C, transparent 100%);">
                                        <td class="whitespace-nowrap  px-2 py-2 w-[150px] text-left font-medium">
                                            NRR
                                            Tertimbang
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrrt1 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrrt2 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrrt3 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrrt4 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrrt5 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrrt6 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrrt7 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrrt8 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                            {{ $nrrt9 }}
                                        </td>
                                        <td class="whitespace-nowrap  px-2 py-2 w-[100px] text-center font-medium">
                                            {{ $nrrT }}
                                        </td>
                                    </tr>
                                    </tbody>
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






