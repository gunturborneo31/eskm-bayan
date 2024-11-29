<!doctype html>
<html class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" conteitial-scale="1.0">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php
$error = 'max-w-md  font-bold tracking-tight mb-2 text-red-600 lg:text-sm text-xl drop-shadow-[0_5px_5px_rgba(0,0,0,0.2)]';
?>

<body class="items-center">

    <div class="overflow-x-hidden">

        <div id="popup" class="fixed z-50 bg-black bg-opacity-30 w-full flex items-center h-full">
            <div class="fixed z-30 bg-opacity-50 overflow-y-auto w-full" id="modal">
                <div class="relative mx-auto p-5 border lg:w-1/2 w-5/6 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <h3 class="lg:text-lg lg:text-2xl  text-4xl  lg:leading-6 font-medium mb-4 text-gray-900 ">
                            SELAMAT
                            DATANG DI
                            SURVEY KEPUASAN
                            MASYARAKAT
                        </h3>
                        <label class="text-black font-black lg:text-sm text-4xl">PERHATIAN :</label>
                        <div class="px-7 items-start mt-4 text-left justify-start">
                            <table class="border-separate border-spacing-y-3 lg:text-sm text-4xl">
                                <tr>
                                    <td class="items-start flex">1. </td>
                                    <td class="text-justify">Tujuan survei ini adalah untuk memperoleh gambaran secara
                                        obyektif mengenai kepuasan
                                        masyarakat terhadap pelayanan publik</td>
                                </tr>
                                <tr>
                                    <td class="items-start flex">2. </td>
                                    <td class="text-justify">Pilihan jawaban yang Anda berikan diharapkan sebagai
                                        pilihan
                                        yang dapat dipertanggungjawabkan</td>
                                </tr>
                                <tr>
                                    <td class="items-start flex">3. </td>
                                    <td class="text-justify">Hasil survei ini akan digunakan untuk bahan penyusunan
                                        Laporan
                                        Survei Kepuasan
                                        Masyarakat terhadap pelayanan publik yang sangat bermanfaat bagi pemerintah
                                        maupun
                                        masyarakat</td>
                                </tr>
                                <tr>
                                    <td class="items-start flex">4. </td>
                                    <td class="text-justify">Keterangan nilai survei bersifat terbuka dan tidak
                                        dirahasiakan
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="items-center px-4 py-3">
                            <button onclick="closePopup()" id="ok-btn"
                                class="px-4 py-2 bg-[#02A859] text-white
                            lg:text-base font-medium rounded-md w-full text-4xl
                            shadow-sm hover:bg-[#308a5e] focus:outline-none focus:ring-2 focus:ring-purple-300">
                                OK
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <form action="{{ route('nilaiUnsur.store') }}" method="POST" enctype="multipart/form-data"
            class="h-screen flex">
            @csrf
            <div id=""
                class="hidden items-center relative isolate  min-w-full h-screen h-screen px-6 shadow-2xl sm:px-16 lg:hidden lg:px-24  bg-[#2b885b] "
                style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">

                <div class=" hidden text-center   lg:py-32 lg:text-left  w-full justify-between">
                    <h1
                        class=" max-w-md  font-bold tracking-tight mb-2 whitespace-nowrap mb-3 text-white lg:text-2xl  text-4xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        Jenis pelayanan yang akan anda berikan penilaian
                    </h1>
                    <div class="lg:flex w-full justify-between gap-4">
                        <ul class="grid w-full gap-2 md:grid-cols-1">
                            <li>
                                <input type="radio" id="pajak_1" name="jenisPelayanan" value="Pajak 1 Tahunan"
                                    checked class="hidden scroll-btn peer">
                                <label for="pajak_1"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Pajak 1
                                            Tahunan</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="pajak_5" name="jenisPelayanan" value="Pajak 5 Tahunan"
                                    class="hidden scroll-btn peer">
                                <label for="pajak_5"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Pajak 5
                                            Tahunan</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="e_samsat" name="jenisPelayanan" value="E-SAMSAT"
                                    class="hidden scroll-btn peer">
                                <label for="e_samsat"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">E-SAMSAT
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="bbnkb_1" name="jenisPelayanan"
                                    value="Proses BBNKB I (Daftar Kendaraan
                                            Pertama)"
                                    class="hidden scroll-btn peer">
                                <label for="bbnkb_1"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Proses BBNKB
                                            I (Daftar
                                            Kendaraan
                                            Pertama)</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="bbnkb_2" name="jenisPelayanan"
                                    value="Proses BBNKB II (Balik Nama)" class="hidden scroll-btn peer">
                                <label for="bbnkb_2"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Proses BBNKB
                                            II (Balik
                                            Nama)</div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                        <ul class="grid w-full gap-2 md:grid-cols-1">
                            <li>
                                <input type="radio" id="hilang" name="jenisPelayanan"
                                    value="Proses STNK & SKPD Hilang/Rusak" class="hidden scroll-btn peer">
                                <label for="hilang"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Proses STNK
                                            & SKPD
                                            Hilang/Rusak</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="rubah_bentuk" name="jenisPelayanan"
                                    value="Rubah Bentuk / Warna / Mesin / Ganti
                                            Nopol"
                                    class="hidden scroll-btn peer">
                                <label for="rubah_bentuk"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Rubah
                                            Bentuk / Warna /
                                            Mesin / Ganti
                                            Nopol</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="mutasi_keluar" name="jenisPelayanan"
                                    value="Proses Mutasi Keluar" class="hidden scroll-btn peer">
                                <label for="mutasi_keluar"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Proses
                                            Mutasi Keluar
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="mutasi_masuk" name="jenisPelayanan"
                                    value="Proses Mutasi Masuk" class="hidden scroll-btn peer">
                                <label for="mutasi_masuk"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Proses
                                            Mutasi Masuk</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="loket_khusus" name="jenisPelayanan"
                                    value="Loket Khusus Disabilitas" class="hidden scroll-btn peer">
                                <label for="loket_khusus"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Loket
                                            Khusus Disabilitas
                                        </div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <li class="flex justify-between mt-5">
                        <a type="button" onclick="window.location=''" class="flex items-center gap-2  ">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-8 h-8 text-transparent">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                    clip-rule="evenodd" />
                            </svg>
                            <label class="text-white font-medium lg:text-xl text-4xl cursor-pointer"></label>

                        </a>
                        <a type="button" onclick="window.location='#pertama'"
                            class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                            <label class="text-white font-medium lg:text-xl text-4xl cursor-pointer ">LANJUT</label>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-8 h-8 text-white">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </div>
            </div>
            <div id="pertama"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen px-6 shadow-2xl sm:px-16 lg:flex lg:px-24  bg-[#2b885b] "
                style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
                <div class=" text0-center  lg:flex lg:py-32 lg:text-left  w-full justify-between">
                    <div class="gap-4 w-full">
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-4xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                NIK
                            </h1>
                            <h1 id="errornik" class="{{ $error }}">
                            </h1>
                            @error('nik')
                                <div class="{{ $error }}">NIK Harus 16 Digit</div>
                            @enderror
                        </div>
                        <input type="text" id="nik" name="nik" onkeypress="return hanyaAngka(event)"
                            min="16" max="16" value="{{ old('nik') }}"
                            class="block w-full p-3 lg:text-xl text-4xl text-[#1e6653] border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-6"></input>
                        <div class="flex justify-between w-full ">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-4xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Nama
                            </h1>
                            <h1 id="errornama" class="{{ $error }}">
                            </h1>
                            @error('nama')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                            class="block w-full p-3 lg:text-xl text-4xl text-[#1e6653] border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-6"></input>
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-4xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Nomor Telpon HP
                            </h1>
                            <h1 id="errornohp" class="{{ $error }}">
                            </h1>
                            @error('nohp')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <input type="text" id="nohp" name="nohp" onkeypress="return hanyaAngka(event)"
                            value="{{ old('nohp') }}"
                            class="block w-full p-3 lg:text-xl text-4xl text-[#1e6653] border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-6"></input>

                    </div>
                    <div class="w-1/6"></div>
                    <div class="gap-4 w-full">
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-4xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Jenis Kelamin
                            </h1>
                            <h1 id="errorjenkel" class="{{ $error }}">
                            </h1>
                            @error('jenkel')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <ul class="flex grid w-full gap-2 grid-cols-2 mb-6">
                            <li>
                                <input type="radio" id="laki" name="jenkel[jenkel]" value="Laki - Laki"
                                    checked
                                    {{ old('jenkel.laki') == 'Laki - Laki' ? 'checked=' . '"' . 'checked' . '"' : '' }}
                                    class="hidden scroll-btn peer">
                                <label for="laki"
                                    class="inline-flex items-center justify-between w-full p-3 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Laki - Laki
                                            ( L )</div>
                                    </div>
                                </label>
                                </input>
                            </li>
                            <li>
                                <input type="radio" id="perempuan" name="jenkel[jenkel]" value="Perempuan"
                                    {{ old('jenkel.perempuan') == 'Perempuan' ? 'checked=' . '"' . 'checked' . '"' : '' }}
                                    class="hidden scroll-btn peer">
                                <label for="perempuan"
                                    class="inline-flex items-center justify-between w-full p-3 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Perempuan (
                                            P )</div>
                                    </div>
                                </label>
                                </input>

                            </li>
                        </ul>
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-4xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Alamat
                            </h1>
                            <h1 id="erroralamat" class="{{ $error }}">
                            </h1>
                            @error('alamat')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <textarea type="text" id="alamat" name="alamat" rows="5"
                            class="block w-full p-4  lg:text-xl text-4xl text-[#1e6653] border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-6"></textarea>
                        <li class="flex justify-between mt-5">
                            <div></div>
                            <a type="submit" id="btn1" class="flex items-center gap-2 cursor-pointer ">
                                <label
                                    class="text-white font-medium lg:text-xl text-4xl cursor-pointer ">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </div>
                </div>
            </div>
            <div id="kedua"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#87e6c1] "
                style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
                <div class=" text-center  lg:flex lg:py-32 lg:text-left   w-full justify-between">
                    <div class="gap-4 w-full">
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-4xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Usia (Tahun)
                            </h1>
                            <h1 id="errorusia" class="{{ $error }}">
                            </h1>
                            @error('usia')
                                <div class="{{ $error }}">Harus Diisi</div>
                            @enderror
                        </div>
                        <ul class="grid w-full gap-2 grid-cols-2">
                            <li>
                                <input type="radio" id="29" name="usia" value="29" checked
                                    class="hidden scroll-btn peer">
                                <label for="29"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Kurang dari
                                            30 Tahun
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="30" name="usia" value="30"
                                    class="hidden scroll-btn peer">
                                <label for="30"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">30 s/d 40
                                            Tahun</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="41" name="usia" value="41"
                                    class="hidden scroll-btn peer">
                                <label for="41"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">41 s/d 50
                                            Tahun</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="51" name="usia" value="51 "
                                    class="hidden scroll-btn peer">
                                <label for="51"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Lebih dari
                                            50 Tahun</div>
                                    </div>
                                </label>
                            </li>
                        </ul>
                        <div class="flex justify-between mt-6">
                            <h1
                                class=" max-w-md  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-4xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                Pendidikan
                            </h1>
                            </h1>
                            @error('pendidikan')
                                <div class="{{ $error }}">Pendidikan</div>
                            @enderror
                        </div>
                        <ul class="grid w-full gap-2 grid-cols-2">
                            <li>
                                <input type="radio" id="sd" name="pendidikan" value="SD"
                                    class="hidden scroll-btn peer">
                                <label for="sd"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">SD</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="smp" name="pendidikan" value="SMP"
                                    class="hidden scroll-btn peer">
                                <label for="smp"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">SMP</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="sma/smk" name="pendidikan" value="SMA / SMK" checked
                                    class="hidden scroll-btn peer">
                                <label for="sma/smk"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">SMA / SMK
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="d1/d3" name="pendidikan" value="D-I / D-III"
                                    class="hidden scroll-btn peer">
                                <label for="d1/d3"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">D-I / D-III
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="s1/setara" name="pendidikan" value="S1 / Setara"
                                    class="hidden scroll-btn peer">
                                <label for="s1/setara"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">S1 / Setara
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="s2/s3" name="pendidikan" value="S2 / S3"
                                    class="hidden scroll-btn peer">
                                <label for="s2/s3"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">S2 / S3
                                        </div>
                                    </div>
                                </label>
                            </li>
                        </ul>


                    </div>
                    <div class="w-1/6"></div>
                    <div class="gap-4 w-full lg:mt-0 mt-4">
                        <div class="flex justify-between">
                            <h1
                                class=" max-w-md capitalize  font-bold tracking-tight mb-2 text-white lg:text-2xl  text-4xl  drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                pekerjaan
                            </h1>
                            </h1>
                            @error('pekerjaan')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        <ul class="grid w-full gap-2 md:grid-cols-1">
                            <li>
                                <input type="radio" id="asn" name="pekerjaan" value="ASN"
                                    class="hidden scroll-btn peer">
                                <label for="asn"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">ASN</div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="tni/polri" name="pekerjaan" value="TNI / POLRI"
                                    class="hidden scroll-btn peer">
                                <label for="tni/polri"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">TNI / POLRI
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="swasta" name="pekerjaan" value="Swasta" checked
                                    class="hidden scroll-btn peer">
                                <label for="swasta"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Swasta
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="pengusaha" name="pekerjaan" value="Pengusaha"
                                    class="hidden scroll-btn peer">
                                <label for="pengusaha"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Pengusaha
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="pelajar" name="pekerjaan" value="Pelajar"
                                    class="hidden scroll-btn peer">
                                <label for="pelajar"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Pelajar
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li>
                                <input type="radio" id="lyn" name="pekerjaan" value="Lainnya"
                                    class="hidden scroll-btn peer">
                                <label for="lyn"
                                    class="inline-flex items-center justify-between w-full p-3 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                    <div class="block">
                                        <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Lainnya
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li class="flex justify-between mt-5">
                                <a type="button" onclick="window.location='#pertama'"
                                    class="flex items-center gap-2 cursor-pointer ">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-8 h-8 text-white">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <label
                                        class="text-white font-medium lg:text-xl text-4xl cursor-pointer ">KEMBALI</label>

                                </a>
                                <a type="button" onclick="window.location='#satu'"
                                    class="flex items-center gap-2 cursor-pointer ">
                                    <label
                                        class="text-white font-medium lg:text-xl text-4xl cursor-pointer ">LANJUT</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-8 h-8 text-white">
                                        <path fill-rule="evenodd"
                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="satu"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#001510]"
                style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
                <div class=" text-center  lg:flex lg:py-32 lg:text-left items-center w-full justify-between">
                    <h2
                        class="text-left text-left lg:max-w-md  font-bold tracking-tight text-white mb-10 text-5xl lg:text-3xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        1.
                        Bagaimana pendapat Saudara tentang Kesesuaian Persyaratan pelayanan dengan jenis pelayanannya ?
                    </h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1 scroll-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('persyaratan')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="hosting-small" name="u1" value="0"
                                class="hidden scroll-btn peer">
                            <label for="hosting-small"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Tidak Sesuai</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="hosting-big" name="u1" value="1"
                                class="hidden scroll-btn peer">
                            <label for="hosting-big"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Tidak Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-medium" name="u1" value="2"
                                class="hidden scroll-btn peer">
                            <label for="hosting-medium"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Kurang Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-aja" name="u1" value="3"
                                class="hidden scroll-btn peer">
                            <label for="hosting-aja"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sesuai</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-ad" name="u1" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="hosting-ad"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex justify-between mt-5">

                            <a type="button" onclick="window.location='#kedua'"
                                class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label
                                    class="text-white font-medium lg:text-xl text-4xl cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#dua'"
                                class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                <label
                                    class="text-white font-medium lg:text-xl text-4xl cursor-pointer ">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="dua"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#54d9a6] "
                style="background-image:
                    radial-gradient(at -5% -5%, #ffffff, transparent 30%),
                    radial-gradient(at 110% 110%, #ffffff, transparent 30%);">
                <div class=" text-center  lg:flex lg:py-32 lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-[#144235] mb-10 text-5xl lg:text-3xl drop-shadow-[0_7px_7px_rgba(0,0,0,0.5)]">
                        2.
                        Bagaimana pemahaman Saudara tentang Kemudahan Prosedur Pelayanan di DISPERINDAG KUTIM ?</h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('kompetensi')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="hosting-a" name="u2" value="0"
                                class="hidden scroll-btn peer">
                            <label for="hosting-a"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Tidak Mudah</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="hosting-b" name="u2" value="1"
                                class="hidden scroll-btn peer">
                            <label for="hosting-b"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Tidak Mudah
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-c" name="u2" value="2"
                                class="hidden scroll-btn peer">
                            <label for="hosting-c"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Kurang Mudah
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-d" name="u2" value="3"
                                class="hidden scroll-btn peer">
                            <label for="hosting-d"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Mudah</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="hosting-e" name="u2" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="hosting-e"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653]  peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Mudah
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex justify-between mt-5">
                            <a type="button" onclick="window.location='#satu'"
                                class="flex items-center gap-2 cursor-pointer ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-[#1e6653]">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label
                                    class="text-[#1e6653] font-medium lg:text-xl text-4xl cursor-pointer ">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#tiga'"
                                class="flex items-center gap-2 cursor-pointer ">
                                <label
                                    class="text-[#1e6653] font-medium lg:text-xl text-4xl cursor-pointer ">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-[#1e6653]">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="tiga"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#001510]"
                style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
                <div class=" text-center  lg:flex lg:py-32 lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-10 text-5xl lg:text-3xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        3.
                        Bagaimana pendapat Saudara tentang Kecepatan Waktu Pelayanan di DISPERINDAG KUTIM ?</h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('prosedur')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="prosedur-small" name="u3" value="0"
                                class="hidden scroll-btn peer">
                            <label for="prosedur-small"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Tidak Cepat</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="prosedur-big" name="u3" value="1"
                                class="hidden scroll-btn peer">
                            <label for="prosedur-big"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Tidak Cepat
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="prosedur-medium" name="u3" value="2"
                                class="hidden scroll-btn peer">
                            <label for="prosedur-medium"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Kurang Cepat
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="prosedur-aja" name="u3" value="3"
                                class="hidden scroll-btn peer">
                            <label for="prosedur-aja"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Cepat</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="prosedur-ad" name="u3" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="prosedur-ad"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Cepat
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex justify-between mt-5">
                            <a type="button" onclick="window.location='#dua'"
                                class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label
                                    class="text-white font-medium lg:text-xl text-4xl cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#empat'"
                                class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                <label class="text-white font-medium lg:text-xl text-4xl cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="empat"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#87e6c1] "
                style="background-image:
                    radial-gradient(at -10% -10%, #00633d, transparent 35%),
                    radial-gradient(at 110% 110%, #00633d, transparent 35%);">
                <div class=" text-center  lg:flex lg:py-32 lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-[#144235] mb-10 text-5xl lg:text-3xl drop-shadow-[0_7px_7px_rgba(0,0,0,0.5)]">
                        4. Bagaimana pendapat Saudara tentang Kewajaran Biaya/Tarif untuk Mendapatkan Pelayanan ?</h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('perilaku')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="perilaku-a" name="u4" value="0"
                                class="hidden scroll-btn peer">
                            <label for="perilaku-a"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Tidak Wajar
                                    </div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="perilaku-b" name="u4" value="1"
                                class="hidden scroll-btn peer">
                            <label for="perilaku-b"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Tidak Wajar
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="perilaku-c" name="u4" value="2"
                                class="hidden scroll-btn peer">
                            <label for="perilaku-c"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Cukup Wajar
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="perilaku-d" name="u4" value="3"
                                class="hidden scroll-btn peer">
                            <label for="perilaku-d"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Wajar</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="perilaku-e" name="u4" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="perilaku-e"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Wajar
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex justify-between mt-5">
                            <a type="button" onclick="window.location='#tiga'"
                                class="flex items-center gap-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-[#1e6653]">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label
                                    class="text-[#1e6653] font-medium lg:text-xl text-4xl cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#lima'"
                                class="flex items-center gap-2 cursor-pointer">
                                <label
                                    class="text-[#1e6653] font-medium lg:text-xl text-4xl cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-[#1e6653]">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="lima"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#001510]"
                style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
                <div class=" text-center  lg:flex lg:py-32 lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-10 text-5xl lg:text-3xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        5.
                        Bagaimana pendapat Saudara tentang Kesesuaian Produk Pelayanan antara yang tercantum dalam
                        standar pelayanan dengan hasil yang diberikan ?</h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('kecepatan')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="kecepatan-small" name="u5" value="0"
                                class="hidden scroll-btn peer">
                            <label for="kecepatan-small"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Tidak Sesuai</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="kecepatan-big" name="u5" value="1"
                                class="hidden scroll-btn peer">
                            <label for="kecepatan-big"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Tidak Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kecepatan-medium" name="u5" value="2"
                                class="hidden scroll-btn peer">
                            <label for="kecepatan-medium"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Kurang Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kecepatan-aja" name="u5" value="3"
                                class="hidden scroll-btn peer">
                            <label for="kecepatan-aja"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sesuai</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kecepatan-ad" name="u5" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="kecepatan-ad"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Sesuai
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex justify-between mt-5">
                            <a type="button" onclick="window.location='#empat'"
                                class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label
                                    class="text-white font-medium lg:text-xl text-4xl cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#enam'"
                                class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                <label class="text-white font-medium lg:text-xl text-4xl cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="enam"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#87e6c1] "
                style="background-image:
                    radial-gradient(at -10% -10%, #00633d, transparent 35%),
                    radial-gradient(at 110% 110%, #00633d, transparent 35%);">
                <div class=" text-center  lg:flex lg:py-32 lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-[#144235] mb-10 text-5xl lg:text-3xl drop-shadow-[0_7px_7px_rgba(0,0,0,0.5)]">
                        6. Bagaimana pendapat Saudara tentang Kompetensi/Kemampuan Petugas dalam pelayanan ?</h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('sarana')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="sarana-a" name="u6" value="0"
                                class="hidden scroll-btn peer">
                            <label for="sarana-a"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Tidak Kompeten</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="sarana-b" name="u6" value="1"
                                class="hidden scroll-btn peer">
                            <label for="sarana-b"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Tidak Kompeten
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="sarana-c" name="u6" value="2"
                                class="hidden scroll-btn peer">
                            <label for="sarana-c"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Kurang Kompeten
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="sarana-d" name="u6" value="3"
                                class="hidden scroll-btn peer">
                            <label for="sarana-d"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Kompeten</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="sarana-e" name="u6" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="sarana-e"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Kompeten
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex justify-between mt-5">
                            <a type="button" onclick="window.location='#lima'"
                                class="flex items-center gap-2 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-[#1e6653]">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label
                                    class="text-[#1e6653] font-medium lg:text-xl text-4xl cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#tujuh'"
                                class="flex items-center gap-2 cursor-pointer">
                                <label
                                    class="text-[#1e6653] font-medium lg:text-xl text-4xl cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-[#1e6653]">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="tujuh"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#001510]"
                style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
                <div class=" text-center  lg:flex lg:py-32 lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-10 text-5xl lg:text-3xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        7.
                        Bagaimana pemahaman Saudara tentang Perilaku Petugas dalam pelayanan terkait kesopanan dan
                        keramahan ?</h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('biaya')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="biaya-aja" name="u7" value="0"
                                class="hidden scroll-btn peer">
                            <label for="biaya-aja"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Tidak Sopan dan Ramah</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="biaya-medium" name="u7" value="1"
                                class="hidden scroll-btn peer">
                            <label for="biaya-medium"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Tidak Sopan dan
                                        Ramah</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="biaya-big" name="u7" value="2"
                                class="hidden scroll-btn peer">
                            <label for="biaya-big"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Cukup Sopan dan
                                        Ramah</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="biaya-cbig" name="u7" value="3"
                                class="hidden scroll-btn peer">
                            <label for="biaya-cbig"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sopan dan Ramah
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="biaya-small" name="u7" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="biaya-small"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Sopan
                                        dan Ramah</div>
                                </div>
                            </label>
                        </li>
                        <li class="flex justify-between mt-5">
                            <a type="button" onclick="window.location='#enam'"
                                class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label
                                    class="text-white font-medium lg:text-xl text-4xl cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#delapan'"
                                class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                <label class="text-white font-medium lg:text-xl text-4xl cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="delapan"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#87e6c1] "
                style="background-image:
                    radial-gradient(at -10% -10%, #00633d, transparent 35%),
                    radial-gradient(at 110% 110%, #00633d, transparent 35%);">
                <div class=" text-center  lg:flex lg:py-32 lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-[#144235] mb-10 text-5xl lg:text-3xl drop-shadow-[0_7px_7px_rgba(0,0,0,0.5)]">
                        8. Bagaimana pendapat Saudara tentang Kualitas sarana dan prasarana
                        ?</h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('penanganan')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="penanganan-a" name="u8" value="0"
                                class="hidden scroll-btn peer">
                            <label for="penanganan-a"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Buruk</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="penanganan-b" name="u8" value="1"
                                class="hidden scroll-btn peer">
                            <label for="penanganan-b"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Buruk</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="penanganan-c" name="u8" value="2"
                                class="hidden scroll-btn peer">
                            <label for="penanganan-c"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Cukup</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="penanganan-d" name="u8" value="3"
                                class="hidden scroll-btn peer">
                            <label for="penanganan-d"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Baik</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="penanganan-e" name="u8" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="penanganan-e"
                                class="inline-flex items-center justify-between w-full p-5 text-[#1e6653] bg-white border-2 border-white rounded-lg cursor-pointer  peer-checked:bg-[#1e6653] peer-checked:text-white hover:text-white hover:bg-[#1e6653] ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Baik
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li class="flex justify-between mt-5">
                            <a type="button" onclick="window.location='#tujuh'"
                                class="flex items-center gap-2 cursor-pointer ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-[#1e6653]    ">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label
                                    class="text-[#1e6653]  font-medium lg:text-xl text-4xl cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#sembilan'"
                                class="flex items-center gap-2 cursor-pointer ">
                                <label
                                    class="text-[#1e6653]  font-medium lg:text-xl text-4xl cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-[#1e6653]    ">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="sembilan"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#001510]"
                style="background-color: #51a592;
    background-image:
        radial-gradient(at -30% -30%, #02A859, transparent 80%),
        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
                <div class=" text-center  lg:flex lg:py-32 lg:text-left items-center  w-full justify-between">
                    <h2
                        class=" text-left lg:max-w-md  font-bold tracking-tight text-white mb-10 text-5xl lg:text-3xl drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                        9.
                        Bagaimana pendapat Saudara tentang Penanganan Pengaduan pengguna layanan ?</h2>
                    <div class="w-1/6"></div>
                    <ul class="grid w-full gap-2 md:grid-cols-1">
                        <div class="flex justify-between">
                            </h1>
                            @error('kesesuaian')
                                <div class="{{ $error }} capitalize">Harus Diisi</div>
                            @enderror
                        </div>
                        {{-- <li>
                            <input type="radio" id="kesesuaian-small" name="u9" value="0"
                                class="hidden scroll-btn peer">
                            <label for="kesesuaian-small"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Tidak Ada</div>
                                </div>
                            </label>
                        </li> --}}
                        <li>
                            <input type="radio" id="kesesuaian-big" name="u9" value="1"
                                class="hidden scroll-btn peer">
                            <label for="kesesuaian-big"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Ada Tetapi
                                        Tidak Berfungsi
                                    </div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kesesuaian-medium" name="u9" value="2"
                                class="hidden scroll-btn peer">
                            <label for="kesesuaian-medium"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  text-left font-semibold">
                                        Berfungsi
                                        Kurang Maksimal,
                                        Lambat
                                        Ditindaklanjuti</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kesesuaian-aja" name="u9" value="3"
                                class="hidden scroll-btn peer">
                            <label for="kesesuaian-aja"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Dikelola Dengan
                                        Baik</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="kesesuaian-ad" name="u9" value="4" checked
                                class="hidden scroll-btn peer">
                            <label for="kesesuaian-ad"
                                class="inline-flex items-center justify-between w-full p-5 text-white bg-transparent border-2 drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)] border-white rounded-lg cursor-pointer  peer-checked:border-white peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-[#1e6653] hover:bg-white ">
                                <div class="block">
                                    <div class="w-full lg:text-lg lg:text-2xl  text-4xl  font-semibold">Sangat Dikelola
                                        dan Cepat
                                        Ditindaklanjuti</div>
                                </div>
                            </label>
                        </li>
                        <li class="flex justify-between mt-5">
                            <a type="button" onclick="window.location='#delapan'"
                                class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                        clip-rule="evenodd" />
                                </svg>
                                <label
                                    class="text-white font-medium lg:text-xl text-4xl cursor-pointer">KEMBALI</label>

                            </a>
                            <a type="button" onclick="window.location='#saran'"
                                class="flex items-center gap-2 cursor-pointer drop-shadow-[0_3px_3px_rgba(0,0,0,0.8)]">
                                <label
                                    class="text-white font-medium lg:text-xl text-4xl cursor-pointer">LANJUT</label>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-white">
                                    <path fill-rule="evenodd"
                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="saran"
                class="lg:pt-0 pt-16 items-center relative isolate overflow-hidden min-w-full h-screen h-screen
                px-6 shadow-2xl sm:px-16 lg:flex lg:px-24 bg-[#87e6c1] "
                style="background-image:
                    radial-gradient(at -10% -10%, #00633d, transparent 35%),
                    radial-gradient(at 110% 110%, #00633d, transparent 35%);">
                <div class=" text-center  lg:py-32 lg:text-left items-center  w-full justify-between">
                    <h2 class=" font-bold tracking-tight text-[#1e6653] text-5xl lg:text-3xl mb-6">Saran
                        perbaikan, masukan dan harapan :</h2>
                    <textarea type="text" id="saran" name="saran"
                        class="block w-full p-4 pl-10 text-xl text-[#1e6653] border border-2 border-white rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-6"></textarea>
                    <button for="kesesuaian-ad" type="submit"
                        class=" font-bold items-center justify-  w-full p-5 text-white bg-[#1e6653] border-white border-2 rounded-lg cursor-pointer  peer-checked:bg-white peer-checked:text-[#1e6653] hover:text-white hover:bg-[#1e6653] ">
                        KIRIM
                    </button>
                    <a type="button" onclick="window.location='#sembilan'"
                        class="flex items-center gap-2 cursor-pointer mt-5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-8 h-8 text-[#1e6653]    ">
                            <path fill-rule="evenodd"
                                d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z"
                                clip-rule="evenodd" />
                        </svg>
                        <label class="text-[#1e6653]  font-medium lg:text-xl text-4xl cursor-pointer">KEMBALI</label>

                    </a>
                </div>

            </div>
        </form>
    </div>

    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }
        let btnCheck = document.querySelector('button');
        let input = document.querySelector('input');
        let error_nik = document.getElementById('errornik');
        let error_nama = document.getElementById('errornama');
        let error_nohp = document.getElementById('errornohp');
        let error_alamat = document.getElementById('erroralamat');
        var bnr = 0;

        btn1.addEventListener('click', () => {
            var validate = 0;
            var nik = document.getElementById('nik').value;
            var nama = document.getElementById('nama').value;
            var nohp = document.getElementById('nohp').value;
            var alamat = document.getElementById('alamat').value;

            error_nik.innerText = '';
            error_nama.innerText = '';
            error_nohp.innerText = '';
            error_alamat.innerText = '';

            if (nik.length == 0) {
                error_nik.innerText = 'NIK tidak boleh kosong';
            } else {
                nik.length != 16 ? error_nik.innerText = 'NIK harus 16 digit' : validate += 1;
            }

            if (nama.length == 0) {
                error_nama.innerText = 'NIK tidak boleh kosong';
            } else {
                validate += 1;
            }

            if (nohp.length == 0) {
                error_nohp.innerText = 'No Hp tidak boleh kosong';
            } else {
                nohp.length <= 11 ? error_nohp.innerText = 'No Hp minimal 11 angka' : validate += 1;
            }

            error_alamat.innerText = alamat.length == 0 ? 'Alamat tidak boleh kosong' : validate += 1;

            if (validate == 4) {
                window.location = '#kedua'
            }
        });
    </script>

    <script>
        var popup = document.getElementById("popup");

        function closePopup() {
            popup.classList.add('hidden');
        }
    </script>
</body>

</html>
