<!doctype html>
<html lang="id">
<head>
    @include('partials.google-tag')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Data Sudah Terdaftar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white p-6 rounded-lg shadow max-w-md w-full text-center">
        <h1 class="text-xl font-bold mb-2">Data Sudah Terdaftar</h1>
        <p class="text-sm text-gray-600 mb-4">Sepertinya identitas yang Anda masukkan sudah pernah mendaftar sebelumnya.</p>

        <div class="text-left mb-4">
            <div class="text-sm text-gray-500">Tipe</div>
            <div class="font-semibold mb-2">{{ $field }}</div>

            <div class="text-sm text-gray-500">Nama</div>
            <div class="font-semibold">{{ $existing->nama ?? '-' }}</div>

            <div class="text-sm text-gray-500">Tanggal</div>
            <div class="font-semibold">{{ optional($existing->created_at)->format('Y-m-d H:i') }}</div>
        </div>

        <a href="/skm" class="inline-block px-4 py-2 rounded bg-orange-500 text-white">Kembali ke Form</a>
    </div>
</body>
</html>
