<?php

error_reporting(0);

$startDate = ($_GET['Tahun'] ?? date('Y')) . '-01-01';
$endDate = ($_GET['Tahun'] ?? date('Y')) . '-12-31';

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
@endphp

@extends('layouts.index', ['title' => 'nilaiUnsur'])

@section('content')
    <style>
        .nilai-unsur-page .nilai-unsur-scroll {
            width: 100%;
            max-height: 390px;
            overflow-x: auto;
            overflow-y: auto;
            border: 1px solid #cbd5e1;
            border-radius: 0.75rem;
            -webkit-overflow-scrolling: touch;
            scrollbar-gutter: stable both-edges;
        }

        .nilai-unsur-page table {
            border-collapse: collapse;
            min-width: 920px;
            table-layout: fixed;
        }

        .nilai-unsur-page .nilai-unsur-data-table col:nth-child(1),
        .nilai-unsur-page .nilai-unsur-summary col:nth-child(1) {
            width: 76px;
        }

        .nilai-unsur-page .nilai-unsur-data-table col:nth-child(2),
        .nilai-unsur-page .nilai-unsur-summary col:nth-child(2) {
            width: 240px;
        }

        .nilai-unsur-page .nilai-unsur-data-table col:nth-child(n + 3),
        .nilai-unsur-page .nilai-unsur-summary col:nth-child(n + 3) {
            width: 58px;
        }

        .nilai-unsur-page th,
        .nilai-unsur-page td {
            border: 1px solid #cbd5e1;
            white-space: nowrap;
        }

        .nilai-unsur-page thead th {
            background: #0f172a !important;
            color: #ffffff !important;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        .nilai-unsur-page tbody td {
            color: #1e293b !important;
            vertical-align: middle;
        }

        .nilai-unsur-page .nilai-unsur-name {
            width: 240px;
            max-width: 240px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .nilai-unsur-page .nilai-unsur-filter input,
        .nilai-unsur-page .nilai-unsur-filter select {
            height: 2.25rem;
            background: #ffffff !important;
            border: 1px solid #cbd5e1;
            color: #1e293b !important;
            font-size: 0.875rem !important;
        }

        .nilai-unsur-page tbody tr:nth-child(even) td {
            background: #f8fafc !important;
        }

        .nilai-unsur-page tbody tr:nth-child(odd) td {
            background: #ffffff !important;
        }

        .nilai-unsur-page .nilai-unsur-filter select {
            min-width: 7rem;
        }

        .nilai-unsur-summary {
            overflow-x: auto;
            border: 1px solid #fdba74;
            border-radius: 0.75rem;
            background: #fff7ed;
        }

        .nilai-unsur-summary table {
            min-width: 920px;
        }

        .nilai-unsur-summary td {
            padding: 0.55rem 0.75rem;
            border-right: 1px solid #fed7aa;
            color: #7c2d12;
            font-size: 0.75rem;
            font-weight: 800;
            text-align: center;
            white-space: nowrap;
        }

        .nilai-unsur-summary td:first-child {
            width: 190px;
            text-align: left;
        }

        @media (max-width: 640px) {
            .nilai-unsur-page .nilai-unsur-filter,
            .nilai-unsur-page .nilai-unsur-filter form {
                width: 100%;
            }

            .nilai-unsur-page .nilai-unsur-filter input {
                min-width: 0;
                flex: 1;
            }
        }
    </style>

    <div class="admin-main nilai-unsur-page">
        <div class="bg-white h-full w-full rounded-xl p-3  mb-2">
            <div class="admin-toolbar flex w-full justify-between items-start lg:items-center gap-3 flex-wrap lg:flex-nowrap">
                <p class="text-[25px] font-black text-gray-800">RESUME / PENDIDIKAN</p>
                <div class="nilai-unsur-filter flex flex-row items-center gap-3 py-4">
                    <form method="GET" action="{{ route('nilaiUnsur.index') }}" class="flex flex-wrap items-center justify-end gap-3">
                        <label for="tahun" class="font-bold text-gray-900 text-sm">Tahun</label>
                        <select id="tahun" name="Tahun" class="rounded-full px-3 py-1 text-center font-bold">
                            @foreach ([2023, 2024, 2025, 2026] as $year)
                                <option value="{{ $year }}" @selected($selectedYear === $year)>{{ $year }}</option>
                            @endforeach
                        </select>
                        <label for="nama" class="sr-only">Cari nama</label>
                        <input id="nama" name="nama" type="search" value="{{ $nameSearch }}"
                            placeholder="Cari nama responden..." class="rounded-full px-4 py-1.5 w-56">
                        <button type="submit"
                            class="rounded-full bg-slate-900 px-4 py-2 text-sm font-bold text-white transition hover:bg-slate-700">
                            Filter
                        </button>
                        <label for="per_page" class="font-bold text-gray-900 text-sm">Baris</label>
                        <select id="per_page" name="per_page" class="rounded-full px-3 py-1 text-center font-bold">
                            @foreach ([10, 25, 50, 100] as $pageSize)
                                <option value="{{ $pageSize }}" @selected($perPage === $pageSize)>{{ $pageSize }}</option>
                            @endforeach
                        </select>
                        @if ($nameSearch !== '')
                            <a href="{{ route('nilaiUnsur.index', ['Tahun' => $selectedYear]) }}"
                                class="text-sm font-semibold text-slate-600 hover:text-slate-900">Reset</a>
                        @endif
                    </form>
                    <div>
                    
                        @if (false)
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
                                        const tahun = "{{ $_GET['Tahun'] }}";
                                        const bagian = checked.join(",");
                                        window.location.href = `/nilaiUnsur?Tahun=${tahun}&bagian=${bagian}`;
                                    }
                                    </script>
                                    
                                    
                                </ul>
                            </div>
                        </div>
                        @endif

                        {{-- download --}}
                        <a href="{{ route('exports.download', ['type' => 'resume', 'jenkel' => request('jenkel', 1), 'usia' => request('usia', 1), 'pekerjaan' => request('pekerjaan', 1), 'pendidikan' => request('pendidikan', 1), 'tahun' => request('tahun', $selectedYear), 'Tahun' => $selectedYear, 'Bulan' => request('Bulan')]) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-orange-600 px-4 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-orange-700"
                            title="Download rekap nilai unsur">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-4 w-4" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14" />
                            </svg>
                            <span>Download</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full ">
                <div class="-m-1.5  ">
                    <div class="p-1.5 ">
                        <div class="nilai-unsur-scroll h-[310px]">
                            <table class="nilai-unsur-data-table w-full divide-y divide-gray-200">
                                <colgroup>
                                    <col><col><col><col><col><col><col><col><col><col><col><col>
                                </colgroup>
                                <thead class="sticky top-0 z-10 bg-slate-900">
                                    <tr>
                                        <th scope="col" rowspan="2"
                                            class="px-4 py-3 w-[76px] text-center text-xs font-semibold uppercase">
                                            No. Responden</th>
                                        <th scope="col" colspan="11"
                                            class="px-4 py-2 text-center text-xs font-semibold uppercase">
                                            NILAI UNSUR PELAYANAN</th>
                                    </tr>
                                    <tr>
                                        <th scope="col"
                                            class="nilai-unsur-name px-4 py-2 text-left text-xs font-semibold uppercase">
                                            NAMA</th>
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
                                <tbody>
                                        <?php $row = 1; ?>
                                        @forelse($selects as $data)
                                            <tr>

                                                <td class="whitespace-nowrap  px-2 py-2 text-center font-medium">
                                                    {{ $row++ }}
                                                </td>
                                                <td class="nilai-unsur-name px-4 py-2 text-left font-medium" title="{{ $data->nama ?? '-' }}">
                                                    {{ $data->nama ?? '-' }}
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
                                            <tr>
                                                <td colspan="12" class="px-4 py-8 text-center text-sm text-slate-500">
                                                    Tidak ada data responden untuk filter yang dipilih.
                                                </td>
                                            </tr>
                                        @endforelse

                                </tbody>
                            </table>
                        </div>


                        @if (false)
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
                        @endif

                        <div class="nilai-unsur-summary mt-3">
                            <table class="w-full">
                                <colgroup>
                                    <col><col><col><col><col><col><col><col><col><col><col><col>
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td aria-hidden="true"></td>
                                        <td>Total Nilai Unsur</td>
                                        <td>{{ $tu1 }}</td><td>{{ $tu2 }}</td><td>{{ $tu3 }}</td><td>{{ $tu4 }}</td>
                                        <td>{{ $tu5 }}</td><td>{{ $tu6 }}</td><td>{{ $tu7 }}</td><td>{{ $tu8 }}</td><td>{{ $tu9 }}</td>
                                        <td>{{ $Ttl_Nilai_Unsur }}</td>
                                    </tr>
                                    <tr>
                                        <td aria-hidden="true"></td>
                                        <td>NRR Per Unsur</td>
                                        <td>{{ $nrr1 }}</td><td>{{ $nrr2 }}</td><td>{{ $nrr3 }}</td><td>{{ $nrr4 }}</td>
                                        <td>{{ $nrr5 }}</td><td>{{ $nrr6 }}</td><td>{{ $nrr7 }}</td><td>{{ $nrr8 }}</td><td>{{ $nrr9 }}</td>
                                        <td>{{ $nrr }}</td>
                                    </tr>
                                    <tr>
                                        <td aria-hidden="true"></td>
                                        <td>NRR Tertimbang</td>
                                        <td>{{ $nrrt1 }}</td><td>{{ $nrrt2 }}</td><td>{{ $nrrt3 }}</td><td>{{ $nrrt4 }}</td>
                                        <td>{{ $nrrt5 }}</td><td>{{ $nrrt6 }}</td><td>{{ $nrrt7 }}</td><td>{{ $nrrt8 }}</td><td>{{ $nrrt9 }}</td>
                                        <td>{{ $nrrT }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-2">
                            {{ $selects->appends(request()->except('page'))->links() }}
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






