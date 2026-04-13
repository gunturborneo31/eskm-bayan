@extends('layouts.index', ['title' => 'Dashboard'])

@section('content')
    <div class="admin-main">
        <div class="bg-white h-full w-full rounded-xl p-3  mb-2">
            <div class="admin-toolbar flex w-full justify-between items-start lg:items-center gap-3 flex-wrap lg:flex-nowrap">
                <p class="text-[25px] font-black text-[#01683d]">RESUME / SARAN DAN MASUKAN</p>
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

                    if ($_GET['Bulan'] == '') {
                    } else {
                        $_SESSION['Bulan'] = $_GET['Bulan'];
                    }
                    ?>
                    <div class="flex flex-row items-center gap-3">

                        {{-- tahun --}}
                        <div class="flex flex-row items-center gap-2">
                            <label for="countries" class=" font-bold text-[#01683d] text-sm ">
                                Tahun</label>
                            <?php if($_GET['Tahun'] == ''){ ?>
                            <select id="tahun"
                                onChange="document.location.href='saranDanMasukan?filter=' + {{ $_GET['filter'] == null ? '1' : $_GET['filter'] }} + '&Tahun=' + this.value + '&Bulan=' + {{ $_GET['Bulan'] == null ? '1' : $_GET['Bulan'] }} "
                                class="bg-white border border-gray-300 text-[#005C3A] font-bold text-sm rounded-full px-3 py-1">
                                <option value="2023" <?php if (date('Y') == '2023') {
                                } else {
                                } ?>>2023</option>

                                <option value="2024" <?php if (date('Y') == '2024') {
                                    echo 'selected';
                                } else {
                                } ?>>2024</option>

                                <option value="2025" <?php if (date('Y') == '2025') {
                                } else {
                                } ?>>2025</option>

                                <option value="2026" <?php if (date('Y') == '2026') {
                                } else {
                                } ?>>2026</option>
                            </select>
                            <?php  } else {?>
                            <select id="tahun"
                                onChange="document.location.href='saranDanMasukan?filter=' + {{ $_GET['filter'] == null ? '1' : $_GET['filter'] }} + '&Tahun=' + this.value + '&Bulan=' + {{ $_GET['Bulan'] == null ? '1' : $_GET['Bulan'] }} "
                                class="bg-white border border-gray-300 text-[#005C3A] font-bold   text-sm rounded-full px-3 py-1">
                                <option value="2023" <?php
                                if ($_GET['Tahun'] == '2023') {
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

                                <option value="2026" <?php
                                if ($_GET['Tahun'] == '2026') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>2026</option>
                            </select>
                            <?php
                    }?>

                        </div>
                        {{-- bulan --}}
                        <div class="flex flex-row items-center gap-2">
                            <label for="countries" class=" font-bold text-[#01683d] text-sm ">
                                Bulan</label>
                            <select id="countries" id="language"
                                onChange="document.location.href='saranDanMasukan?filter=' + {{ $_GET['filter'] == null ? '1' : $_GET['filter'] }} + '&Tahun=' + {{ $_GET['Tahun'] == null ? '2024' : $_GET['Tahun'] }} + '&Bulan=' + this.value "
                                class="bg-white border border-gray-300 text-[#01683d] border-[#01683d] font-bold   text-sm rounded-full px-3 py-1">
                                <option value="1" <?php
                                if ($_GET['Bulan'] == '1') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>Januari</option>

                                <option value="2" <?php
                                if ($_GET['Bulan'] == '2') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>Februari</option>

                                <option value="3" <?php
                                if ($_GET['Bulan'] == '3') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>Maret</option>

                                <option value="4" <?php
                                if ($_GET['Bulan'] == '4') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>April</option>

                                <option value="5" <?php
                                if ($_GET['Bulan'] == '5') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>Mei</option>

                                <option value="6" <?php
                                if ($_GET['Bulan'] == '6') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>Juni</option>

                                <option value="7" <?php
                                if ($_GET['Bulan'] == '7') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>Juli</option>

                                <option value="8" <?php
                                if ($_GET['Bulan'] == '8') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>Agustus</option>

                                <option value="9" <?php
                                if ($_GET['Bulan'] == '9') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>September</option>

                                <option value="10" <?php
                                if ($_GET['Bulan'] == '10') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>Oktober</option>

                                <option value="11" <?php
                                if ($_GET['Bulan'] == '11') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>Nopember</option>

                                <option value="12" <?php
                                if ($_GET['Bulan'] == '12') {
                                    echo 'selected';
                                } else {
                                }
                                ?>>Desember</option>
                            </select>
                        </div>

                        {{-- download --}}
                        <a href="{{ route('exports.download', ['type' => 'saran-masukan', 'filter' => $_GET['filter'] == null ? 1 : $_GET['filter'], 'Tahun' => $_GET['Tahun'] == null ? 1 : $_GET['Tahun'], 'Bulan' => $_GET['Bulan'] == null ? 1 : $_GET['Bulan']]) }}"
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
                        <div class="border border-[#1d6835] rounded-lg overflow-hidden h-[460px]">
                            <table class="w-full divide-y divide-gray-200 ">
                                <thead class="bg-gradient-to-br from-[#1d6835] to-[#007e3f]">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 w-[50px] text-center text-xs font-medium text-gray-900 uppercase">
                                            NO</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase">
                                            NIK</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase">
                                            NAMA</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase">
                                            SARAN DAN MASUKAN</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-900 uppercase">
                                            TANGGAL</th>
                                    </tr>
                                </thead>
                                <div class="h-200 overflow-y-auto">
                                    <tbody class="  " style="overflow-y:auto;">
                                        <?php $row = 1; ?>
                                        @forelse($selects as $data)
                                            <tr class="{{ $row % 2 == 0 ? 'bg-[#E3E3E3]' : '' }}">
                                                <td
                                                    class="px-6 py-3 whitespace-nowrap text-sm text-center font-medium text-gray-800">
                                                    {{ $row++ }}</td>
                                                <td
                                                    class="px-6 py-3 whitespace-nowrap text-sm text-center text-gray-800 dark:text-gray-200">
                                                    {{-- NIK intentionally left blank --}}
                                                    </td>
                                                <td
                                                    class="px-6 py-3 whitespace-nowrap text-sm text-center text-gray-800 dark:text-gray-200">
                                                    {{ $data->nama }}</td>
                                                <td
                                                    class="px-6 py-3 whitespace-nowrap text-sm text-center text-gray-800 dark:text-gray-200">
                                                    {{ $data->saran }}</td>
                                                <td
                                                    class="px-6 py-3 whitespace-nowrap text-sm text-center text-gray-800 dark:text-gray-200">
                                                    {{ substr($data->created_at, 0, 10) }}</td>
                                            </tr>

                                        @empty
                                        @endforelse
                                    </tbody>
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


    <script src="https://cdn.ckeditor.com/4.12.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection






