@extends('layouts.navbar', ['title' => 'Dashboard'])

@section('content')
    <main class="bg-[#f4f4f5] h-screen px-12">
        <div>
            <img class="right-14 top-6 absolute h-18 w-16" src="/images/logo_prov_kaltim.png" alt=""></img>
            <img class="right-32 top-8 absolute h-16 w-auto" src="/images/logo_bapenda_kaltim.png" alt=""></img>
            <div class="hidden sm:-my-px sm:flex py-4  content-center ">
                <h1 class="text-4xl font-black font-sans leading-tight tracking-tight text-gray-900 py-4  rounded-full">
                    DATA DASAR</h1>
            </div>

            <div class="grid grid-cols-4 gap-4">
                <a href="/dosen" class=" soverflow-hiden rounded-2xl bg-[#1e6653] shadow py-6">
                    <dt class="text-xl text-center w-full  font-black text-gray-900">
                        JENIS KELAMIN
                    </dt>
                    <div class="flex px-3">
                        <dt class="text-xl text-left w-full  font-black text-gray-900">
                            Laki - Laki
                        </dt>
                    </div>
                </a>
                <a href="/prodi" class=" soverflow-hiden rounded-2xl bg-[#1e6653] shadow py-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                        stroke="currentColor" class="w-16 h-16 mb-2 m-auto  justify-center text-gray-900">
                        <path
                            d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                        <path
                            d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
                        <path
                            d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
                    </svg>
                    <dt class="text-md text-center w-full  font-black text-gray-900">
                        PRODI
                    </dt>
                </a>
                <a href="/matakuliah" class=" soverflow-hiden rounded-2xl bg-[#1e6653] shadow py-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                        stroke="currentColor" class="w-16 h-16 mb-2 m-auto  justify-center text-gray-900">
                        <path fill-rule="evenodd"
                            d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
                            clip-rule="evenodd" />
                    </svg>
                    <dt class="text-md text-center w-full  font-black text-gray-900">
                        MATAKULIAH
                    </dt>
                </a>
                <a href="/kelas" class=" soverflow-hiden rounded-2xl bg-[#1e6653] shadow py-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" class="w-16 h-16 mb-2 m-auto  justify-center text-gray-900">
                        <path fill-rule="evenodd"
                            d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z"
                            clip-rule="evenodd" />
                    </svg>
                    <dt class="text-md text-center w-full  font-black text-gray-900">
                        KELAS
                    </dt>
                </a>
                <a href="/jadwal" class=" soverflow-hiden rounded-2xl bg-[#1e6653] shadow py-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" class="w-16 h-16 mb-2 m-auto  justify-center text-gray-900">
                        <path
                            d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                        <path fill-rule="evenodd"
                            d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                            clip-rule="evenodd" />
                    </svg>
                    <dt class="text-md text-center w-full  font-black text-gray-900">
                        JADWAL
                    </dt>
                </a>
                <a href="/user" class=" soverflow-hiden rounded-2xl bg-[#1e6653] shadow py-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" class="w-16 h-16 mb-2 m-auto  justify-center text-gray-900">
                        <path fill-rule="evenodd"
                            d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <dt class="text-md text-center w-full  font-black text-gray-900">
                        USER
                    </dt>
                </a>
            </div>
        </div>
    </main>

    <script src="https://cdn.ckeditor.com/4.12.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection




