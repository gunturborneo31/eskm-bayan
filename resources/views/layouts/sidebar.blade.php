@php
    $i = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $das = 'pengaturan';
    $navFocus = 'py-2 my-2   bg-white rounded-lg font-bold text-base pl-3  w-full flex text-[#02A859]';
    $nav =
        'py-2 my-2 ml-1  rounded-lg font-mono text-base  drop-shadow-[0_1px_1px_rgba(0,0,0,0.9)] w-full flex text-[#ffffff]';

    if (date('m') <= 3) {
        $tw = 1;
    } elseif (date('m') <= 6) {
        $tw = 3;
    } elseif (date('m') <= 9) {
        $tw = 5;
    } elseif (date('m') <= 12) {
        $tw = 7;
    }
@endphp

<div class="py-5 px-8 w-screen relative h-screen justify-end text-sm bg-[#2b885b] bg-no-repeat"
    style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">

    <div class="flex flex-col gap-2 items-start h-1/6 -mt-2">
        <img src="/assets/bapendasmd.png" class="h-[50px] p-1 rounded-xl bg-white" alt="">
        <div class="text-white">
            <p class="text-[40px] mt-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.9)]  mb-2 ml-1 font-black">E - SKM</p>
        </div>
    </div>

    <div class="w-[160px] ml-3 flex flex-col justify-between mt-3  h-5/6 flex flex-col">

        <div class="">
            <div class="text-3xl text-white w-full flex">
                <a href="/rekapTotal?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw={{ $tw }}&Tahun={{ date('Y') }}"
                    class="{{ str_contains($i, 'rekapTotal') ? $navFocus : $nav }} -ml-3 " style="font-family:'Roboto'">
                    RESUME
                </a>
            </div>
            <a href="/nilaiUnsur?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw={{ $tw }}&Tahun={{ date('Y') }}"
                class="{{ str_contains($i, 'nilaiUnsur') ? $navFocus : $nav }} -ml-3 " style="font-family:'Roboto'">
                NILAI UNSUR
            </a>
            <a href="/nilaiRekap?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw={{ $tw }}&Tahun={{ date('Y') }}"
                class="{{ str_contains($i, 'nilaiRekap') ? $navFocus : $nav }} -ml-3 " style="font-family:'Roboto'">
                NILAI
            </a>
            <a href="/dashboardAdmin/create?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw={{ $tw }}&Tahun={{ date('Y') }}"
                class="{{ str_contains($i, 'dashboard') ? $navFocus : $nav }} -ml-3" style="font-family:'Roboto'">
                DASHBOARD
            </a>
            <a href="/pengaturanAdmin/" class="{{ str_contains($i, 'pengaturan') ? $navFocus : $nav }} -ml-3"
                style="font-family:'Roboto'">
                PENGATURAN
            </a>
        </div>

        <a href="/" class="py-3   bg-red-700 rounded-lg font-bold text-sm pl-3  w-full flex text-white"
            style="font-family:'Roboto'">
            KELUAR
        </a>
    </div>

</div>
