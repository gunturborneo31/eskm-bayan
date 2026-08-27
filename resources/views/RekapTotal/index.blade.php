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

$terms = array_values(array_unique(array_filter(array_map('trim', explode(',', $_GET['bagian'])))));

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

@php
    // role/keterangan dari URL login, contoh: ?keterangan=asisten2
    $role = request('keterangan', 'admin');
    $bagianQuery = request('bagian', '');

    // Semua opsi yang tersedia untuk ditampilkan
    $allOptions = \App\Support\BagianOptions::codeNameMap();
    $visibleKeys = \App\Support\BagianOptions::codesForRole($role);
@endphp



@extends('layouts.index', ['title' => 'Dashboard'])

@section('content')
    <style>
        .rekap-total-table {
            border-collapse: collapse;
            min-width: max-content;
        }

        .rekap-total-table th,
        .rekap-total-table td {
            border: 1px solid #cbd5e1;
            white-space: nowrap;
        }

        .rekap-total-table td.allow-wrap {
            white-space: normal;
            min-width: 180px;
            max-width: 280px;
        }

        .rekap-total-table thead th {
            background: #0f172a !important;
            color: #ffffff !important;
        }

        .rekap-total-table tbody td {
            color: #1e293b !important;
        }

        .rekap-total-table tbody tr:nth-child(even) td {
            background: #f8fafc !important;
        }

        .rekap-total-table tbody tr:nth-child(odd) td {
            background: #ffffff !important;
        }

        .rekap-total-table tfoot td {
            background: #fed7aa !important;
            color: #7c2d12 !important;
            font-weight: 800;
        }
    </style>

    <div class="admin-main">
        <div class="bg-white h-full w-full rounded-xl p-3  mb-2">
            <div class="admin-toolbar flex w-full justify-between items-start lg:items-center gap-3 flex-wrap lg:flex-nowrap">
                <p class="text-[25px] font-black text-gray-800">RESUME </p>
                <div class="flex justify-between items-center py-4 ">
                    <div>
                        <label class="text-gray-900 font-bold text-xl"> </label>
                    </div>
                    <?php

                    error_reporting(0);

                    ?>
                    <div class="flex flex-row items-center gap-3">
                        <form method="GET" action="{{ url('/rekapTotal') }}" class="flex items-center gap-2">
                            <input type="hidden" name="tw" value="{{ request('tw') }}">
                            <input type="hidden" name="Tahun" value="{{ request('Tahun') }}">
                            <input type="hidden" name="bagian" value="{{ request('bagian') }}">
                            <input type="hidden" name="jenkel" value="{{ request('jenkel', '0') }}">
                            <input type="hidden" name="usia" value="{{ request('usia', '0') }}">
                            <input type="hidden" name="pekerjaan" value="{{ request('pekerjaan', '0') }}">
                            <input type="hidden" name="pendidikan" value="{{ request('pendidikan', '0') }}">
                            <label for="search" class="sr-only">Cari nama</label>
                            <input id="search" name="search" type="search" value="{{ $search }}"
                                placeholder="Cari nama..." class="w-44 rounded-full border border-gray-300 px-4 py-1 text-sm text-gray-800">
                            <button type="submit" class="rounded-full bg-orange-600 px-4 py-1 text-sm font-bold text-white hover:bg-orange-700">Terapkan</button>
                            @if ($search !== '')
                                <a href="{{ url('/rekapTotal?' . http_build_query(request()->except('search', 'page'))) }}"
                                    class="rounded-full border border-gray-300 px-3 py-1 text-sm font-bold text-gray-700 hover:bg-gray-100">Reset</a>
                            @endif
                        </form>

                        {{-- filter --}}
<div class="flex flex-row items-center gap-2">
                        <form method="GET" action="{{ url('/rekapTotal') }}" class="flex items-center gap-2">
                            <input type="hidden" name="tw" value="{{ request('tw') }}">
                            <input type="hidden" name="Tahun" value="{{ request('Tahun') }}">
                            <input type="hidden" name="bagian" value="{{ request('bagian') }}">
                            <input type="hidden" name="jenkel" value="{{ request('jenkel', '0') }}">
                            <input type="hidden" name="usia" value="{{ request('usia', '0') }}">
                            <input type="hidden" name="pekerjaan" value="{{ request('pekerjaan', '0') }}">
                            <input type="hidden" name="pendidikan" value="{{ request('pendidikan', '0') }}">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <label for="per_page" class="text-sm font-bold text-gray-800">Baris</label>
                            <select id="per_page" name="per_page" onchange="this.form.submit()"
                                class="rounded-full border border-gray-300 bg-white px-3 py-1 text-sm font-bold text-gray-800">
                                @foreach ([10, 25, 50, 100] as $pageSize)
                                    <option value="{{ $pageSize }}" {{ $perPage === $pageSize ? 'selected' : '' }}>{{ $pageSize }}</option>
                                @endforeach
                            </select>
                        </form>
    <label class="font-bold text-gray-800 text-sm">Filter</label>
  
    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
      class="flex items-center bg-white border border-gray-300 text-[#005C3A] font-bold text-sm rounded-full px-5 py-1" type="button">
      Pilih
      <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
      </svg>
    </button>
  
    <div id="dropdown" class="z-10 hidden border bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
      <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
        @php
          $tw = $_GET['tw'] ?? '';
          $Tahun = $_GET['Tahun'] ?? '';
          $bagian = $_GET['bagian'] ?? '';
          $jenkel = $_GET['jenkel'] ?? '0';
          $usia = $_GET['usia'] ?? '0';
          $pekerjaan = $_GET['pekerjaan'] ?? '0';
          $pendidikan = $_GET['pendidikan'] ?? '0';
        @endphp
  
        <li>
          <a href="/rekapTotal?tw={{ $tw }}&Tahun={{ $Tahun }}&bagian={{ urlencode($bagian) }}&jenkel={{ $jenkel=='0'?'1':'0' }}&usia={{ $usia }}&pekerjaan={{ $pekerjaan }}&pendidikan={{ $pendidikan }}"
             class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
            <p>Jenis kelamin</p>
            <svg aria-hidden="true" fill="none" stroke-width="4" stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 {{ $jenkel=='1' ? '' : 'hidden' }}">
              <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </a>
        </li>
  
        <li>
          <a href="/rekapTotal?tw={{ $tw }}&Tahun={{ $Tahun }}&bagian={{ urlencode($bagian) }}&jenkel={{ $jenkel }}&usia={{ $usia=='0'?'1':'0' }}&pekerjaan={{ $pekerjaan }}&pendidikan={{ $pendidikan }}"
             class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
            <p>Usia</p>
            <svg aria-hidden="true" fill="none" stroke-width="4" stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 {{ $usia=='1' ? '' : 'hidden' }}">
              <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </a>
        </li>
  
        <li>
          <a href="/rekapTotal?tw={{ $tw }}&Tahun={{ $Tahun }}&bagian={{ urlencode($bagian) }}&jenkel={{ $jenkel }}&usia={{ $usia }}&pekerjaan={{ $pekerjaan=='0'?'1':'0' }}&pendidikan={{ $pendidikan }}"
             class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
            <p>Pekerjaan</p>
            <svg aria-hidden="true" fill="none" stroke-width="4" stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 {{ $pekerjaan=='1' ? '' : 'hidden' }}">
              <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </a>
        </li>
  
        <li>
          <a href="/rekapTotal?tw={{ $tw }}&Tahun={{ $Tahun }}&bagian={{ urlencode($bagian) }}&jenkel={{ $jenkel }}&usia={{ $usia }}&pekerjaan={{ $pekerjaan }}&pendidikan={{ $pendidikan=='0'?'1':'0' }}"
             class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
            <p>Pendidikan</p>
            <svg aria-hidden="true" fill="none" stroke-width="4" stroke="currentColor" viewBox="0 0 24 24" class="w-3 h-3 {{ $pendidikan=='1' ? '' : 'hidden' }}">
              <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </a>
        </li>
      </ul>
    </div>
  </div>

  {{-- tahun --}}
@php
$tw = $_GET['tw'] ?? '';
$Tahun = $_GET['Tahun'] ?? '';
$bagian = $_GET['bagian'] ?? '';
$jenkel = $_GET['jenkel'] ?? '0';
$usia = $_GET['usia'] ?? '0';
$pekerjaan = $_GET['pekerjaan'] ?? '0';
$pendidikan = $_GET['pendidikan'] ?? '0';
@endphp

<div class="flex flex-row items-center gap-3 mb-5 lg:mb-0">
<label for="tahun" class="font-bold text-gray-800 text-5xl lg:text-base">Tahun</label>
<select id="tahun"
  onChange="document.location.href='/rekapTotal?tw={{ $tw }}&Tahun=' + this.value + '&bagian={{ urlencode($bagian) }}&jenkel={{ $jenkel }}&usia={{ $usia }}&pekerjaan={{ $pekerjaan }}&pendidikan={{ $pendidikan }}'"
  class="bg-white border border-gray-300 text-gray-800 font-bold text-5xl w-[250px] text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">
  <option value="2023" {{ $Tahun=='2023' ? 'selected' : '' }}>2023</option>
  <option value="2024" {{ $Tahun=='2024' ? 'selected' : '' }}>2024</option>
  <option value="2025" {{ $Tahun=='2025' ? 'selected' : '' }}>2025</option>
  <option value="2026" {{ ($Tahun=='2026' || $Tahun=='') ? 'selected' : '' }}>2026</option>
</select>
</div>

{{-- tw --}}
@php
  $tw = $_GET['tw'] ?? '';
  $Tahun = $_GET['Tahun'] ?? '';
  $bagian = $_GET['bagian'] ?? '';
  $jenkel = $_GET['jenkel'] ?? '0';
  $usia = $_GET['usia'] ?? '0';
  $pekerjaan = $_GET['pekerjaan'] ?? '0';
  $pendidikan = $_GET['pendidikan'] ?? '0';
@endphp

<div class="flex flex-row items-center gap-3 mb-5 lg:mb-0">
  <label for="tw" class="font-bold text-gray-800 text-5xl lg:text-base">Triwulan</label>
  <select id="tw"
    onChange="document.location.href='/rekapTotal?tw=' + this.value + '&Tahun={{ $Tahun }}&bagian={{ urlencode($bagian) }}&jenkel={{ $jenkel }}&usia={{ $usia }}&pekerjaan={{ $pekerjaan }}&pendidikan={{ $pendidikan }}'"
    class="bg-white border border-gray-300 text-gray-800 font-bold text-5xl w-[300px] text-center lg:w-fit lg:text-sm rounded-full px-3 py-1">
    <option value="1" {{ $tw=='1' ? 'selected' : '' }}>Triwulan 1 (Jan, Feb, Mar)</option>
    <option value="2" {{ $tw=='2' ? 'selected' : '' }}>Triwulan 2 (Apr, Mei, Jun)</option>
    <option value="3" {{ $tw=='3' ? 'selected' : '' }}>Triwulan 2 (Jan s/d Jun)</option>
    <option value="4" {{ $tw=='4' ? 'selected' : '' }}>Triwulan 3 (Jul, Agu, Sep)</option>
    <option value="5" {{ $tw=='5' ? 'selected' : '' }}>Triwulan 3 (Jan s/d Sep)</option>
    <option value="6" {{ $tw=='6' ? 'selected' : '' }}>Triwulan 4 (Okt, Nop, Des)</option>
    <option value="7" {{ $tw=='7' ? 'selected' : '' }}>Triwulan 4 (Jan s/d Des)</option>
  </select>
</div>

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
        <ul class="py-2 px-4 text-sm text-gray-700 dark:text-gray-200"
            aria-labelledby="dropdownDefaultButton">
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
            
            <!-- Tombol Tampilkan -->
            <div class="mt-4 py-1">
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
                const jenkel = "{{ $_GET['jenkel'] }}";
                const usia = "{{ $_GET['usia'] }}";
                const pekerjaan = "{{ $_GET['pekerjaan'] }}";
                const pendidikan = "{{ $_GET['pendidikan'] }}";
                const bagian = checked.join(",");
                window.location.href = `/rekapTotal?tw=${tw}&Tahun=${tahun}&bagian=${bagian}&jenkel=${jenkel}&usia=${usia}&pekerjaan=${pekerjaan}&pendidikan=${pendidikan}`;
            }
            </script>
            
            
        </ul>
    </div>
</div>
@endif

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
                        <div class="border border-[#EA580C] rounded-lg h-[460px] max-w-full overflow-auto">
                            <table class="rekap-total-table w-full divide-y divide-gray-200 h-full ">
                                <thead class="sticky top-0 z-10 bg-slate-900">
                                    <tr>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            No.<br>RESPONDEN</th>
                                        {{-- <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            NIK</th> --}}
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            NAMA</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase">
                                            NO HP</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase">
                                            ALAMAT</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase">
                                            SARAN</th>
                                        {{-- <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            JENIS<br>Pelayanan</th> --}}
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase {{ $_GET['jenkel'] == 0 ? 'hidden' : '' }}">
                                            JENIS<br>KELAMIN</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase {{ $_GET['usia'] == 0 ? 'hidden' : '' }}">
                                            USIA</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase {{ $_GET['pekerjaan'] == 0 ? 'hidden' : '' }}">
                                            PEKERJAAN</th>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase {{ $_GET['pendidikan'] == 0 ? 'hidden' : '' }}">
                                            PENDIDIKAN</th>
                                        {{-- <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase {{ $_GET['pendidikan'] == 0 ? 'hidden' : '' }}">
                                            JENIS PELAYANAN</th> --}}
                                        <th scope="col" colspan="9"
                                            class=" px-6 px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase ">
                                            NILAI UNSUR PELAYANAN</th>
                                        <th scope="col" rowspan="2"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            Tanggal</th>
                                        <th scope="col" rowspan="2"
                                            class=" px-6 py-1 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            AKSI</th>
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
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $row = 1; ?>
                                        @forelse($selects as $data)
                                            <tr class="{{ $row % 2 == 0 ? 'bg-[#E3E3E3]' : '' }}">

                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $row++ }}
                                                </td>
                                                {{-- <td class="text-center px-2 font-normal text-xs">
                                                    {{-- NIK intentionally left blank --}}
                                                </td>
                                                <td class="text-center px-2 font-normal text-xs">
                                                    {{ $data->nama }}
                                                </td>
                                                <td class="px-2 font-normal text-xs">
                                                    {{ $data->nohp ?? '-' }}
                                                </td>
                                                <td class="allow-wrap px-2 font-normal text-xs">
                                                    {{ $data->alamat ?? '-' }}
                                                </td>
                                                <td class="allow-wrap px-2 font-normal text-xs">
                                                    {{ $data->saran ?? '-' }}
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
                                                {{-- <td
                                                    class="text-center px-2 font-normal text-xs {{ $_GET['usia'] == 0 ? 'hidden' : '' }}">
                                                    {{ $data->sub_jenis_jenis }}
                                                </td> --}}
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
                                                    {{ $data->created_at }}
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
                                    <tfoot class="h-[50px]">
                                        <?php $row = 1; ?>
                                        <tr>

                                            <td class="text-center px-2 font-normal text-xs">
                                                TOTAL
                                            </td>
                                            {{-- <td class="text-center px-2 font-normal text-xs">

                                            </td>
                                            <td class="text-center px-2 font-normal text-xs">

                                            </td> --}}
                                            
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
                                            <td class="text-center px-2 font-normal text-xs">

                                            </td>
                                            </tr>
                                    </tfoot>
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






