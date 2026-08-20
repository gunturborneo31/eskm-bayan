<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Merch - Cek Kode</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: Manrope, system-ui, Arial, sans-serif; }
        .scanner-shell { background: linear-gradient(180deg, #f8fafc 0%, #eef6ff 100%); }
        #reader {
            width: 100%;
            max-width: 420px;
            min-height: 260px;
            margin: 0 auto;
            border-radius: 18px;
            overflow: hidden;
            background: #0f172a;
            border: 3px solid rgba(59,130,246,0.15);
            position: relative;
        }
        #reader video, #reader canvas {
            display: block;
            width: 100% !important;
            height: 100% !important;
            max-height: 360px;
            min-height: 260px;
            object-fit: cover;
            border-radius: 12px;
            background: #0f172a;
        }
        .safe-card {
            box-shadow: 0 18px 42px rgba(15, 23, 42, 0.08);
        }
    </style>
</head>
<body class="min-h-screen bg-slate-100 p-3 sm:p-6 scanner-shell">
    <div class="max-w-5xl mx-auto">
        <div class="flex flex-col gap-3 sm:flex-row sm:justify-between sm:items-center mb-5">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-blue-600">Merchandise</p>
                <h1 class="text-2xl font-extrabold text-slate-800">Pemeriksa Kode & QR</h1>
            </div>
            <form method="POST" action="/merch/logout" class="self-start sm:self-auto">
                @csrf
                <button class="px-3 py-2 bg-red-600 text-white rounded-xl font-semibold shadow-sm">Logout</button>
            </form>
        </div>

        <div id="cameraStatus" class="mb-4 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800 hidden"></div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="safe-card bg-white rounded-2xl p-4 sm:p-5">
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-flex h-2.5 w-2.5 rounded-full bg-blue-500"></span>
                    <label class="text-sm font-bold text-slate-700">Input kode manual</label>
                </div>

                <div class="flex flex-col sm:flex-row gap-2">
                    <input id="valueInput" class="border border-slate-200 bg-slate-50 p-3 rounded-xl flex-1 w-full text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Masukkan kode atau URL QR" />
                    <button id="checkBtn" class="px-4 py-3 bg-blue-600 text-white rounded-xl font-semibold shadow-sm hover:bg-blue-700 transition w-full sm:w-auto">Cek</button>
                </div>

                <div class="mt-3 flex items-center justify-between gap-3 rounded-xl border border-dashed border-slate-200 bg-slate-50 px-3 py-2">
                    <span class="text-xs text-slate-500">Dapat dipakai jika kamera tidak tersedia</span>
                    <button id="openCameraBtn" type="button" class="text-xs font-bold text-blue-700 bg-blue-100 hover:bg-blue-200 px-3 py-1.5 rounded-full">Buka Kamera</button>
                </div>

                <div id="result" class="mt-4"></div>
            </div>

            <div class="safe-card bg-white rounded-2xl p-4 sm:p-5">
                <div class="flex items-center justify-between gap-3 mb-3">
                    <label class="text-sm font-bold text-slate-700">Scanner QR</label>
                    <span id="cameraDot" class="inline-flex h-2.5 w-2.5 rounded-full bg-slate-300"></span>
                </div>

                <div id="reader" class="w-full" style="display:block;">
                    <video id="kameraPreview" autoplay playsinline muted></video>
                </div>
                <div id="cameraHint" class="mt-3 text-xs text-slate-500">Arahkan kamera ke QR code untuk scan otomatis.</div>
            </div>
        </div>
    </div>

    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const cameraStatus = document.getElementById('cameraStatus');
        const cameraHint = document.getElementById('cameraHint');
        const valueInput = document.getElementById('valueInput');
        const readerEl = document.getElementById('reader');
        const cameraDot = document.getElementById('cameraDot');
        const openCameraBtn = document.getElementById('openCameraBtn');

        function setCameraDot(state) {
            if (!cameraDot) return;
            cameraDot.className = 'inline-flex h-2.5 w-2.5 rounded-full';
            if (state === 'ok') {
                cameraDot.classList.add('bg-green-500');
            } else if (state === 'warn') {
                cameraDot.classList.add('bg-amber-500');
            } else {
                cameraDot.classList.add('bg-slate-300');
            }
        }

        function setCameraStatus(message, type = 'info') {
            if (!cameraStatus) return;
            cameraStatus.classList.remove('hidden', 'border-amber-200', 'bg-amber-50', 'text-amber-800', 'border-red-200', 'bg-red-50', 'text-red-700', 'border-green-200', 'bg-green-50', 'text-green-700');
            cameraStatus.innerHTML = message;
            if (type === 'warning') {
                cameraStatus.classList.add('border-red-200', 'bg-red-50', 'text-red-700');
                setCameraDot('warn');
            } else if (type === 'success') {
                cameraStatus.classList.add('border-green-200', 'bg-green-50', 'text-green-700');
                setCameraDot('ok');
            } else {
                cameraStatus.classList.add('border-amber-200', 'bg-amber-50', 'text-amber-800');
                setCameraDot('warn');
            }
            cameraStatus.classList.remove('hidden');
        }

        function renderResponse(json) {
            const el = document.getElementById('result');
            if (!json || !json.exists) {
                el.innerHTML = '<div class="p-3 bg-red-50 text-red-700 rounded-xl">Data tidak ditemukan</div>';
                return;
            }

            if (json.type === 'code') {
                const r = json.response || {};
                el.innerHTML = `
                    <div class="p-3 bg-green-50 rounded-xl border border-green-200">
                        <div><strong>Kode:</strong> ${json.code}</div>
                        <div><strong>Redeemed:</strong> ${json.redeemed ? 'Ya' : 'Belum'}</div>
                    </div>
                    <div class="mt-2 p-3 bg-white border border-slate-200 rounded-xl">
                        <div><strong>Nama:</strong> ${r.nama || '-'}</div>
                        <div><strong>NIK:</strong> ${r.nik || '-'}</div>
                        <div><strong>No. WA:</strong> ${r.no_wa || r.nohp || '-'}</div>
                    </div>
                `;
                return;
            }

            if (json.type === 'group') {
                const r = json.response || {};
                const codesHtml = (json.codes || []).map(c => {
                    if (c.redeemed) return `<div class="py-2 flex items-center justify-between text-sm"><span>${c.code}</span><span class="text-green-600 font-semibold">Sudah</span></div>`;
                    return `<div class="py-2 flex items-center justify-between gap-2 text-sm"><span>${c.code}</span><button class="ml-2 px-2.5 py-1.5 bg-blue-600 text-white text-xs rounded-full btn-redeem" data-code="${c.code}">Tukar</button></div>`;
                }).join('');

                el.innerHTML = `
                    <div class="p-3 bg-green-50 rounded-xl border border-green-200">
                        <div><strong>Group:</strong> ${r.redeem_group || '-'}</div>
                        <div><strong>Nama:</strong> ${r.nama || '-'}</div>
                    </div>
                    <div class="mt-2 p-3 bg-white border border-slate-200 rounded-xl">${codesHtml}</div>
                `;
                attachRedeemHandlers();
            }
        }

        async function checkValue(val) {
            const url = `/merch/api/check?value=${encodeURIComponent(val)}`;
            try {
                const res = await fetch(url, { credentials: 'same-origin' });
                const json = await res.json();
                renderResponse(json);
            } catch (e) {
                document.getElementById('result').innerHTML = '<div class="p-3 bg-red-50 text-red-700 rounded-xl">Gagal koneksi</div>';
            }
        }

        document.getElementById('checkBtn').addEventListener('click', function (e) {
            e.preventDefault();
            const v = (valueInput.value || '').trim();
            if (!v) {
                setCameraStatus('Masukkan kode atau URL QR terlebih dahulu.', 'warning');
                return;
            }
            checkValue(v);
        });

        function attachRedeemHandlers() {
            document.querySelectorAll('.btn-redeem').forEach(button => {
                button.removeEventListener('click', onRedeemClick);
                button.addEventListener('click', onRedeemClick);
            });
        }

        async function onRedeemClick(e) {
            const code = e.currentTarget.getAttribute('data-code');
            if (!code) return;
            if (!confirm('Tukar merchandise untuk kode ' + code + ' ?')) return;

            try {
                const res = await fetch('/merch/api/redeem', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ code })
                });

                const json = await res.json();
                if (json && json.ok) {
                    alert('Berhasil ditukar oleh ' + json.redeemed_by);
                    checkValue((valueInput.value || '').trim());
                } else {
                    alert('Gagal: ' + (json.message || json.error || 'unknown'));
                }
            } catch (err) {
                alert('Kesalahan jaringan');
            }
        }

        async function bukaKameraDasar() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                setCameraStatus('Browser ini tidak mendukung akses kamera. Gunakan input manual.', 'warning');
                return;
            }

            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment'
                    }
                });

                const video = document.getElementById('kameraPreview');
                if (video) {
                    video.srcObject = stream;
                    video.play();
                }

                setCameraStatus('Kamera berhasil dibuka. Anda bisa scan QR atau gunakan input manual.', 'success');
            } catch (err) {
                setCameraStatus('Kamera tidak dapat diakses. Silakan izinkan akses kamera atau gunakan input manual.', 'warning');
            }
        }

        openCameraBtn.addEventListener('click', bukaKameraDasar);

        if (window.isSecureContext || location.hostname === 'localhost' || location.hostname === '127.0.0.1') {
            setCameraStatus('Meminta izin kamera saat halaman dibuka...', 'info');
            setCameraDot('warn');
            bukaKameraDasar();
        } else {
            setCameraStatus('Kamera diblokir karena situs tidak aman. Gunakan input manual.', 'warning');
        }
    </script>
</body>
</html>
