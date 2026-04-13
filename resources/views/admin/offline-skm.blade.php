@extends('layouts.index', ['title' => 'Input Offline SKM'])

@section('content')
<div class="admin-main">
    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-400 text-green-800 font-semibold">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-4 px-4 py-3 rounded bg-red-100 border border-red-400 text-red-800 font-semibold">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="h-full w-full rounded-xl p-3 mb-2 overflow-auto border border-orange-200 bg-white">
        <div class="flex flex-col gap-2">
            <h2 class="text-lg font-bold text-orange-700">Fitur Input Offline SKM</h2>
            <p class="text-sm text-gray-700">Download file Excel makro (xlsm) berikut, lakukan input data SKM secara offline, lalu upload kembali file tersebut untuk memasukkan data ke sistem.</p>
            <div class="flex flex-wrap gap-3 mt-2">
                <a href="/template_input_skm_offline.xlsm" download class="px-4 py-2 rounded bg-orange-500 text-white font-semibold hover:bg-orange-600">Download File Makro SKM (.xlsm)</a>
                <form action="/admin/import-offline-skm" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                    @csrf
                    <input type="file" name="file" accept=".xlsm,.xlsx,.xls" required class="border rounded px-2 py-1 text-sm" />
                    <button type="submit" class="px-3 py-1 rounded bg-green-600 text-white font-semibold hover:bg-green-700">Upload & Import</button>
                </form>
            </div>
            <p class="text-xs text-gray-500 mt-1">* Pastikan file yang diupload adalah hasil dari template makro ini.</p>
        </div>
    </div>
</div>
@endsection
