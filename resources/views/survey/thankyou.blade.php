<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Terima Kasih — Survey</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body{font-family:Manrope,system-ui,Arial}</style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#fff5e6] via-[#ffecd6] to-[#ffd9b0]">
    <div class="bg-white p-6 rounded-2xl shadow-lg max-w-md text-center">
        <h1 class="text-2xl font-bold text-[#191c1d] mb-2">Terima Kasih!</h1>
        <p class="text-sm text-slate-600 mb-4">Simpan QR dan kode di bawah untuk penukaran merchandise.</p>

        <div class="mb-4">
            @php
                $redeemUrl = route('survey.redeem', ['group' => $group]);
                $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=280x280&data=' . urlencode($redeemUrl);
            @endphp
            <img src="{{ $qrUrl }}" alt="QR Code" class="mx-auto mb-3">
            <div class="text-xs text-slate-500">Scan untuk menampilkan data Anda</div>
        </div>

        <div class="grid grid-cols-1 gap-2 mb-4">
            @foreach($codes as $c)
                <div class="py-2 px-2 rounded-lg border bg-gray-50 font-mono text-sm">{{ $c }}</div>
            @endforeach
        </div>

        <a href="{{ url('/') }}" class="inline-block px-6 py-2 rounded-full bg-[#ff8800] text-white font-bold">Kembali ke Beranda</a>
    </div>
</body>
</html>
