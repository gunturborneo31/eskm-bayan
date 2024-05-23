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

@extends('layouts.index', ['title' => 'Dashboard'])

@section('content')
    <div class="absolute top-0 left-[215px] h-screen w-10/12 p-2">
        <div class="bg-white h-full w-full rounded-xl p-3  mb-2">
            <div class="flex w-full justify-between items-center -mt-3">
                <p class="text-[25px] font-black text-[#01683d]">RESUME / PENDIDIKAN</p>
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
                        <div class="border border-[#02A859] rounded-lg overflow-hidden h-[335px]">
                            <table class="w-full divide-y divide-gray-200 ">
                                <thead
                                    style="background-color: #51a592;
                                        background-image:
                                            radial-gradient(at -30% -30%, #02A859, transparent 80%),
                                            radial-gradient(at 130% 150%, #02A859, transparent 80%);">
                                    <tr>
                                        <th scope="col" rowspan="2"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-white uppercase">
                                            No.<br>RESPONDEN</th>
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
                                    style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 100%),
        radial-gradient(at 130% 150%, #02A859, transparent 100%);">
                                    <tr class="border-b  text-white font-bold"
                                        style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 100%),
        radial-gradient(at 130% 150%, #02A859, transparent 100%);">
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
                                    <tr class="border-b text-white font-bold"
                                        style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 100%),
        radial-gradient(at 130% 150%, #02A859, transparent 100%);">
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
                                    <tr class="border-b text-white font-bold"
                                        style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 100%),
        radial-gradient(at 130% 150%, #02A859, transparent 100%);">
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
