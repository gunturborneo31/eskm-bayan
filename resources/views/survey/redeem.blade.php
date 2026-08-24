<!doctype html>
<html lang="id">
<head>
    @include('partials.google-tag')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Responden</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-2xl shadow-lg max-w-lg w-full">
        <h1 class="text-xl font-bold mb-2">Data Responden</h1>
        <div class="grid grid-cols-2 gap-3 mb-4">
            <div class="text-sm text-slate-500">Nama</div>
            <div class="font-semibold">{{ $response->nama }}</div>
            <div class="text-sm text-slate-500">NIK</div>
            <div class="font-semibold">{{ $response->nik }}</div>
            <div class="text-sm text-slate-500">No. WA</div>
            <div class="font-semibold">{{ $response->no_wa ?? $response->nohp }}</div>
            <div class="text-sm text-slate-500">Alamat</div>
            <div class="font-semibold">{{ $response->alamat }}</div>
            <div class="text-sm text-slate-500">Jenis Pelayanan</div>
            <div class="font-semibold">{{ $response->jenisPelayanan }}</div>
            <div class="text-sm text-slate-500">Tanggal</div>
            <div class="font-semibold">{{ substr($response->created_at,0,10) }}</div>
        </div>

        <h2 class="text-sm font-bold mb-2">Kode Penukaran</h2>
        <div class="grid grid-cols-3 gap-2 mb-4">
            @foreach($codes as $c)
                <div class="py-2 px-2 rounded-lg border bg-gray-50 font-mono text-sm">
                    <div>{{ $c->code }} @if($c->redeemed_at) <span class="ml-2 text-xs text-green-600">(Sudah ditukar oleh {{ $c->redeemed_by }})</span> @endif</div>
                </div>
            @endforeach
        </div>

        <div class="text-xs text-gray-500 mb-4">Tunjukkan halaman ini bersama kode kepada petugas untuk menukarkan merchandise.</div>
        <a href="{{ url('/') }}" class="inline-block px-4 py-2 rounded bg-[#ff8800] text-white">Selesai</a>
    </div>
    <script>
        (function(){
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            document.getElementById('codesGrid').addEventListener('click', function(e){
                const btn = e.target.closest('button[data-action="redeem"]');
                if (!btn) return;
                const code = btn.getAttribute('data-code');
                if (!confirm('Tandai kode ' + code + ' sebagai sudah ditukar?')) return;

                fetch(`{{ url('/survey/redeem/' . $group . '/redeem') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ code: code })
                })
                .then(r => r.json())
                .then(json => {
                    if (json && json.ok) {
                        const container = btn.closest('[data-code]');
                        btn.remove();
                        const tag = document.createElement('span');
                        tag.className = 'ml-2 text-xs text-green-600';
                        tag.textContent = 'Sudah ditukar';
                        container.appendChild(tag);
                        alert('Kode berhasil ditandai sebagai ditukar');
                    } else {
                        alert('Gagal: ' + (json.message || json.error || 'unknown'));
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Terjadi kesalahan jaringan');
                });
            });
        })();
    </script>
</body>
</html>
