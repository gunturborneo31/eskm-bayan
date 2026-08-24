@php
    $i = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $bagian = $_GET['bagian'] ?? \App\Support\BagianOptions::allCodesCsv();
    $keterangan = $_GET['keterangan'] ?? 'admin';
    $das = 'pengaturan';
    $navFocus = 'py-2 my-2   bg-white rounded-lg font-bold text-base pl-3  w-full flex text-gray-800';
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

<aside class="fixed left-0 top-0 z-40 h-[58px] lg:h-screen w-full lg:w-[215px] p-2 lg:p-3 bg-gradient-to-r lg:bg-gradient-to-b from-[#EA580C] via-[#F97316] to-[#FB923C] border-b lg:border-b-0 lg:border-r border-orange-200/70 shadow-xl overflow-hidden lg:overflow-visible">
    <div class="h-full rounded-2xl lg:rounded-3xl bg-orange-950/15 backdrop-blur-sm border border-orange-100/35 px-2 lg:px-3 py-2 lg:py-4 flex flex-row lg:flex-col items-center lg:items-stretch gap-2 lg:gap-0">
        <a href="/" class="flex items-center gap-2 px-1 lg:px-2 js-admin-nav shrink-0">
            <div class="flex items-center -space-x-2">
                <img src="/assets/logo-bayan.png" class="h-10 w-10 p-1 rounded-xl bg-white border border-orange-100/80" alt="Logo Bayan">
            </div>
            <div class="text-white hidden sm:block">
                <p class="text-base font-extrabold tracking-tight">E-SKM</p>
                <p class="text-[10px] font-semibold text-white/90">Admin Panel</p>
            </div>
        </a>

        <nav class="mt-0 lg:mt-4 flex-1 hidden lg:block space-y-1.5 text-[12px] font-extrabold tracking-wide">
            <a href="/rekapTotal?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw={{ $tw }}&Tahun={{ date('Y') }}&bagian={{ $bagian }}&keterangan={{ $keterangan }}"
                class="js-admin-nav block rounded-xl px-3 py-2.5 transition {{ str_contains($i, 'rekapTotal') ? 'bg-white text-orange-900 shadow-md' : 'text-white hover:bg-orange-100/20' }}">
                RESUME
            </a>
            <a href="/nilaiUnsur?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw={{ $tw }}&Tahun={{ date('Y') }}&bagian={{ $bagian }}&keterangan={{ $keterangan }}"
                class="js-admin-nav block rounded-xl px-3 py-2.5 transition {{ str_contains($i, 'nilaiUnsur') ? 'bg-white text-orange-900 shadow-md' : 'text-white hover:bg-orange-100/20' }}">
                NILAI UNSUR
            </a>
            <a href="/nilaiRekap?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw={{ $tw }}&Tahun={{ date('Y') }}&bagian={{ $bagian }}&keterangan={{ $keterangan }}"
                class="js-admin-nav block rounded-xl px-3 py-2.5 transition {{ str_contains($i, 'nilaiRekap') ? 'bg-white text-orange-900 shadow-md' : 'text-white hover:bg-orange-100/20' }}">
                NILAI
            </a>
            <a href="/dashboardAdmin/create?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw={{ $tw }}&Tahun={{ date('Y') }}&bagian={{ $bagian }}&keterangan={{ $keterangan }}"
                class="js-admin-nav block rounded-xl px-3 py-2.5 transition {{ str_contains($i, 'dashboard') ? 'bg-white text-orange-900 shadow-md' : 'text-white hover:bg-orange-100/20' }}">
                DASHBOARD
            </a>
            <!-- <a href="/sub-jenis?jenkel=1&usia=1&pekerjaan=1&pendidikan=1&tw={{ $tw }}&Tahun={{ date('Y') }}&bagian={{ $bagian }}&keterangan={{ $keterangan }}"
                class="js-admin-nav block rounded-xl px-3 py-2.5 transition {{ str_contains($i, 'sub-jenis') ? 'bg-white text-orange-900 shadow-md' : 'text-white hover:bg-orange-100/20' }}">
                SUB PELAYANAN
            </a> -->

            <!-- <a href="/admin/offline-skm" class="js-admin-nav block rounded-xl px-3 py-2.5 transition {{ str_contains($i, 'offline-skm') ? 'bg-white text-orange-900 shadow-md' : 'text-white hover:bg-orange-100/20' }}">
                INPUT OFFLINE SKM
            </a> -->
            <a href="/admin/tenant-revenue" class="js-admin-nav block rounded-xl px-3 py-2.5 transition {{ str_contains($i, 'tenant-revenue') ? 'bg-white text-orange-900 shadow-md' : 'text-white hover:bg-orange-100/20' }}">
                PENDAPATAN TENANT
            </a>
        </nav>

        <div class="space-y-2 hidden lg:block">
            <a href="/" class="js-admin-nav block w-full rounded-xl bg-white/90 text-orange-800 text-center px-3 py-2.5 text-[11px] font-black hover:bg-white transition">
                HALAMAN DEPAN
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full rounded-xl bg-orange-900 text-white px-3 py-2.5 text-[11px] font-black hover:bg-orange-950 transition">
                    KELUAR
                </button>
            </form>
        </div>
    </div>
</aside>




