<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Merch - Cek Kode</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
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
        <div id="toast" class="fixed top-6 right-6 z-50 hidden">
            <div id="toastBody" class="px-4 py-2 rounded shadow text-sm bg-green-600 text-white"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="safe-card bg-white rounded-2xl p-4 sm:p-5">
                <div class="flex items-center gap-2 mb-3">
                    <span class="inline-flex h-2.5 w-2.5 rounded-full bg-blue-500"></span>
                    <label class="text-sm font-bold text-slate-700">Input kode manual</label>
                </div>

                <div class="flex flex-col sm:flex-row gap-2">
                    <input id="valueInput" class="border border-slate-200 bg-slate-50 p-3 rounded-xl flex-1 w-full text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none" placeholder="Masukkan kode atau URL QR" />
                    <div class="flex gap-2 w-full sm:w-auto">
                        <button id="checkBtn" class="px-4 py-3 bg-blue-600 text-white rounded-xl font-semibold shadow-sm hover:bg-blue-700 transition w-full sm:w-auto">Cek</button>
                        <button id="clearBtn" class="px-4 py-3 bg-gray-200 text-slate-700 rounded-xl font-semibold shadow-sm hover:bg-gray-300 transition">Bersih</button>
                    </div>
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

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="p-3 bg-white rounded-xl border shadow-sm flex items-center justify-between">
                        <div>
                            <div class="text-xs text-slate-500">Sudah ditukar</div>
                            <div id="redeemedCount" class="text-2xl font-bold">0</div>
                        </div>
                        <div>
                            <button id="viewRedeemedBtn" class="px-3 py-2 bg-blue-600 text-white rounded-md">Lihat</button>
                        </div>
                    </div>

                    <div class="p-3 bg-white rounded-xl border shadow-sm flex items-center justify-between">
                        <div>
                            <div class="text-xs text-slate-500">Sudah mengisi survey</div>
                            <div id="surveyedCount" class="text-2xl font-bold">0</div>
                        </div>
                        <div>
                            <button id="viewSurveyedBtn" class="px-3 py-2 bg-blue-600 text-white rounded-md">Lihat</button>
                        </div>
                    </div>
                </div>

                <!-- List modal -->
                <div id="listModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center p-4">
                    <div class="bg-white rounded-xl w-full max-w-4xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 id="listTitle" class="font-bold">Daftar</h3>
                            <div class="flex items-center gap-2">
                                <input id="listSearch" placeholder="Cari nama/no hp/kode" class="border px-2 py-1 rounded" />
                                <select id="listPerPage" class="border px-2 py-1 rounded">
                                    <option value="10">10 / halaman</option>
                                    <option value="25">25 / halaman</option>
                                    <option value="50">50 / halaman</option>
                                </select>
                                <button id="closeList" class="ml-2 px-3 py-1 bg-red-500 text-white rounded">Tutup</button>
                            </div>
                        </div>
                        <div id="listTable" class="overflow-x-auto max-h-80 overflow-y-auto border rounded mb-3"></div>
                        <div class="flex items-center justify-between">
                            <div id="listPagination"></div>
                            <div><button id="listCloseFooter" class="px-3 py-1 bg-slate-200 rounded">Tutup</button></div>
                        </div>
                    </div>
                </div>

                <!-- Detail modal -->
                <div id="detailModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center p-4">
                    <div class="bg-white rounded-xl w-full max-w-2xl p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="font-bold">Detail</h3>
                            <button id="closeDetail" class="px-3 py-1 bg-red-500 text-white rounded">Tutup</button>
                        </div>
                        <div id="detailBody"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // toast helper: non-blocking notification
        function showToast(message, timeout = 1200) {
            const t = document.getElementById('toast');
            const b = document.getElementById('toastBody');
            if (!t || !b) return;
            b.textContent = message;
            t.classList.remove('hidden');
            t.classList.add('flex');
            setTimeout(() => { t.classList.add('hidden'); t.classList.remove('flex'); }, timeout);
        }

        // format timestamp returned from server into localized string
        function formatDateTime(s) {
            if (!s) return '-';
            try {
                // convert 'YYYY-MM-DD HH:MM:SS' to 'YYYY-MM-DDTHH:MM:SS' for reliable parsing
                const iso = String(s).replace(' ', 'T');
                const d = new Date(iso);
                if (isNaN(d.getTime())) return s;
                return d.toLocaleString('id-ID', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            } catch (e) {
                return s;
            }
        }
        const cameraStatus = document.getElementById('cameraStatus');
        const cameraHint = document.getElementById('cameraHint');
        const valueInput = document.getElementById('valueInput');
        const readerEl = document.getElementById('reader');
        const cameraDot = document.getElementById('cameraDot');
        const openCameraBtn = document.getElementById('openCameraBtn');
        let cameraStream = null;
        let scanLoopActive = false;
        let lastScannedValue = null;
        let scanLock = false;

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
                const redeemed = !!json.redeemed;
                el.innerHTML = `
                    <div class="p-3 bg-white border border-slate-200 rounded-xl">
                        <div><strong>KODE:</strong> ${json.code}</div>
                        <div><strong>Status:</strong> ${redeemed ? 'Sudah ditukar' : 'Belum'}</div>
                        <div class="mt-2"><strong>Nama:</strong> ${r.nama || '-'}</div>
                        <div><strong>No. HP:</strong> ${r.no_wa || r.nohp || '-'}</div>
                        <div><strong>Waktu Pengisian SKM:</strong> ${formatDateTime(r.created_at || r.surveyed_at)}</div>
                    </div>
                `;

                // redeem button (if available)
                if (!redeemed) {
                    const btn = document.createElement('button');
                    btn.id = 'doRedeem';
                    btn.className = 'mt-3 px-3 py-2 bg-amber-600 text-white rounded';
                    btn.textContent = 'Tukar Merchandise';
                    el.appendChild(btn);

                    btn.addEventListener('click', async function () {
                        const code = json.code;
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
                            const jr = await res.json();
                            if (jr && jr.ok) {
                                showToast('Data di konfirmasi');
                                fetchStats();
                                setTimeout(()=> { window.location.href = '/merch/check'; }, 800);
                            } else {
                                alert('Gagal: ' + (jr.message || jr.error || 'unknown'));
                            }
                        } catch (err) {
                            alert('Kesalahan jaringan');
                        }
                    });
                }

                // add a result-level clear button so user can clear after check
                const rc = document.createElement('button');
                rc.id = 'resultClear';
                rc.className = 'ml-2 mt-3 px-3 py-2 bg-gray-200 text-slate-700 rounded';
                rc.textContent = 'Bersih';
                el.appendChild(rc);
                rc.addEventListener('click', function(e){
                    e.preventDefault();
                    valueInput.value = '';
                    lastScannedValue = null;
                    document.getElementById('result').innerHTML = '';
                    if (cameraStatus) cameraStatus.classList.add('hidden');
                });

                return;
            }

            if (json.type === 'group') {
                const r = json.response || {};
                const codes = json.codes || [];
                const anyRedeemed = codes.some(c => c.redeemed);
                const allRedeemed = codes.length > 0 && codes.every(c => c.redeemed);
                const status = allRedeemed ? 'Semua sudah ditukar' : (anyRedeemed ? 'Beberapa sudah ditukar' : 'Belum ditukar');

                el.innerHTML = `
                    <div class="p-3 bg-white border border-slate-200 rounded-xl">
                        <div><strong>KODE:</strong> ${r.redeem_group || '-'}</div>
                        <div><strong>Status:</strong> ${status}</div>
                        <div class="mt-2"><strong>Nama:</strong> ${r.nama || '-'}</div>
                        <div><strong>No. HP:</strong> ${r.no_wa || r.nohp || '-'}</div>
                        <div><strong>Waktu Pengisian SKM:</strong> ${formatDateTime(r.created_at || r.surveyed_at)}</div>
                    </div>
                `;

                // list codes below with actionable redeem buttons for unredeemed codes
                const codesHtml = codes.map(c => {
                    const redeemedLabel = c.redeemed ? ' - (Redeemed: '+formatDateTime(c.redeemed_at)+')' : '';
                    const actionBtn = c.redeemed ? '' : `<button class="btn-redeem ml-2 px-2 py-1 bg-blue-600 text-white rounded" data-code="${c.code}">Tukar</button>`;
                    return `<div class="py-1 text-sm flex items-center justify-between"><span>${c.code}${redeemedLabel}</span>${actionBtn}</div>`;
                }).join('');
                const wrapper = document.createElement('div');
                wrapper.className = 'mt-2 p-3 bg-white border border-slate-200 rounded-xl';
                wrapper.innerHTML = codesHtml;
                el.appendChild(wrapper);

                // attach handlers for per-code redeem buttons
                attachRedeemHandlers();

                // add a clear button for group result as well
                const rcg = document.createElement('button');
                rcg.id = 'resultClearGroup';
                rcg.className = 'mt-3 px-3 py-2 bg-gray-200 text-slate-700 rounded';
                rcg.textContent = 'Bersih';
                el.appendChild(rcg);
                rcg.addEventListener('click', function(e){
                    e.preventDefault();
                    valueInput.value = '';
                    lastScannedValue = null;
                    document.getElementById('result').innerHTML = '';
                    if (cameraStatus) cameraStatus.classList.add('hidden');
                });
            }
        }

        async function checkValue(val) {
            const value = (val || '').trim();
            if (!value) return;

            if (scanLock) return;
            scanLock = true;

            const url = `/merch/api/check?value=${encodeURIComponent(value)}`;
            try {
                const res = await fetch(url, { credentials: 'same-origin' });
                const json = await res.json();
                renderResponse(json);
                if (json && json.exists) {
                    valueInput.value = value;
                    setCameraStatus('Kode terdeteksi dan valid.', 'success');
                }
            } catch (e) {
                document.getElementById('result').innerHTML = '<div class="p-3 bg-red-50 text-red-700 rounded-xl">Gagal koneksi</div>';
            } finally {
                setTimeout(() => { scanLock = false; }, 1200);
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

        // clear input/result
        document.getElementById('clearBtn').addEventListener('click', function(e){
            e.preventDefault();
            valueInput.value = '';
            lastScannedValue = null;
            document.getElementById('result').innerHTML = '';
            if (cameraStatus) cameraStatus.classList.add('hidden');
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
                    showToast('Data di konfirmasi');
                    fetchStats();
                    setTimeout(()=> { window.location.href = '/merch/check'; }, 800);
                } else {
                    alert('Gagal: ' + (json.message || json.error || 'unknown'));
                }
            } catch (err) {
                alert('Kesalahan jaringan');
            }
        }

        function startQrLoop() {
            const video = document.getElementById('kameraPreview');
            if (!video || !window.jsQR || !cameraStream || scanLoopActive) return;

            scanLoopActive = true;
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            const tick = () => {
                if (!cameraStream || !video || video.readyState < 2) {
                    if (scanLoopActive) requestAnimationFrame(tick);
                    return;
                }

                const width = video.videoWidth || 640;
                const height = video.videoHeight || 480;
                canvas.width = width;
                canvas.height = height;
                ctx.drawImage(video, 0, 0, width, height);

                const imageData = ctx.getImageData(0, 0, width, height);
                const code = window.jsQR(imageData.data, width, height, { inversionAttempts: 'dontInvert' });

                if (code && code.data) {
                    const value = String(code.data).trim();
                    if (value && value !== lastScannedValue) {
                        lastScannedValue = value;
                        cameraHint.textContent = 'QR terdeteksi, memeriksa data...';
                        checkValue(value);
                    }
                }

                if (scanLoopActive) requestAnimationFrame(tick);
            };

            requestAnimationFrame(tick);
        }

        async function bukaKameraDasar() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                setCameraStatus('Browser ini tidak mendukung akses kamera. Gunakan input manual.', 'warning');
                return;
            }

            try {
                if (cameraStream) {
                    cameraStream.getTracks().forEach(track => track.stop());
                }

                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment'
                    },
                    audio: false
                });

                cameraStream = stream;
                const video = document.getElementById('kameraPreview');
                if (video) {
                    video.srcObject = stream;
                    await video.play();
                }

                setCameraStatus('Kamera berhasil dibuka. Arahkan ke QR code.', 'success');
                cameraHint.textContent = 'Arahkan kamera ke QR code untuk scan otomatis.';
                startQrLoop();
            } catch (err) {
                setCameraStatus('Kamera tidak dapat diakses. Silakan izinkan akses kamera atau gunakan input manual.', 'warning');
                cameraHint.textContent = 'Kamera tidak aktif. Gunakan input kode manual.';
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

        // Fetch and display stats
        async function fetchStats() {
            try {
                const res = await fetch('/merch/api/stats', { credentials: 'same-origin' });
                const json = await res.json();
                document.getElementById('redeemedCount').textContent = json.redeemed ?? 0;
                document.getElementById('surveyedCount').textContent = json.surveyed ?? 0;
            } catch (e) {
                // ignore
            }
        }

        // Open list modal (type: 'redeemed' or 'survey')
        let currentListType = 'redeemed';
        let listPerPage = 10;
        async function openList(type) {
            currentListType = type;
            document.getElementById('listTitle').textContent = type === 'redeemed' ? 'Daftar Redeemed' : 'Daftar Survey Respondents';
            document.getElementById('listModal').classList.remove('hidden');
            document.getElementById('listModal').classList.add('flex');
            document.getElementById('listSearch').value = '';
            const sel = document.getElementById('listPerPage');
            if (sel) listPerPage = parseInt(sel.value || '10', 10);
            await fetchList(type, 1, listPerPage, '');
        }

        async function closeList() {
            document.getElementById('listModal').classList.add('hidden');
            document.getElementById('listModal').classList.remove('flex');
        }

        document.getElementById('viewRedeemedBtn').addEventListener('click', function(){ openList('redeemed'); });
        document.getElementById('viewSurveyedBtn').addEventListener('click', function(){ openList('survey'); });
        document.getElementById('closeList').addEventListener('click', closeList);
        document.getElementById('listCloseFooter').addEventListener('click', closeList);

        document.getElementById('listPerPage').addEventListener('change', function(){
            listPerPage = parseInt(this.value || '10', 10);
            fetchList(currentListType, 1, listPerPage, document.getElementById('listSearch').value.trim());
        });

        document.getElementById('listSearch').addEventListener('keyup', function(e){
            if (e.key === 'Enter') fetchList(currentListType, 1, 10, this.value.trim());
        });

        async function fetchList(type, page = 1, perPage = 10, q = '') {
            const url = `/merch/api/list?type=${encodeURIComponent(type)}&page=${page}&per_page=${perPage}&q=${encodeURIComponent(q)}`;
            try {
                const res = await fetch(url, { credentials: 'same-origin' });
                const json = await res.json();
                renderList(json, type);
            } catch (err) {
                document.getElementById('listTable').innerHTML = '<div class="p-3 text-red-600">Gagal memuat data</div>';
            }
        }

        function renderList(payload, type) {
            const container = document.getElementById('listTable');
            if (!payload || !payload.data) {
                container.innerHTML = '<div class="p-3">Tidak ada data</div>';
                return;
            }

            let html = '<table class="w-full text-sm"><thead class="bg-slate-50"><tr>';
            html += '<th class="p-2 text-left">No</th>';
            html += '<th class="p-2 text-left">Kode</th>';
            html += '<th class="p-2 text-left">Nama</th>';
            html += '<th class="p-2 text-left">No. HP</th>';
            html += '<th class="p-2 text-left">No. Peserta</th>';
            html += '<th class="p-2 text-left">Waktu Survey</th>';
            html += '<th class="p-2 text-left">Waktu Redeem</th>';
            html += '</tr></thead><tbody>';

            const baseIndex = ((payload.current_page || 1) - 1) * (payload.per_page || 10);
            payload.data.forEach((row, idx) => {
                const no = baseIndex + idx + 1;
                if (type === 'redeemed') {
                    const r = row.response || {};
                    html += `<tr class="hover:bg-slate-50" data-code="${row.code}">`+
                        `<td class="p-2">${no}</td>`+
                        `<td class="p-2">${row.code}</td>`+
                        `<td class="p-2">${r.nama || '-'}</td>`+
                        `<td class="p-2">${r.no_wa || r.nohp || '-'}</td>`+
                        `<td class="p-2">${r.no_peserta || '-'}</td>`+
                        `<td class="p-2">${formatDateTime(r.surveyed_at) || '-'}</td>`+
                        `<td class="p-2">${formatDateTime(row.redeemed_at) || '-'}</td>`+
                        `</tr>`;
                } else {
                    const firstCode = (row.codes && row.codes.length) ? row.codes[0].code : '-';
                    html += `<tr class="hover:bg-slate-50" data-id="${row.id}">`+
                        `<td class="p-2">${no}</td>`+
                        `<td class="p-2">${firstCode}</td>`+
                        `<td class="p-2">${row.nama || '-'}</td>`+
                        `<td class="p-2">${row.no_wa || '-'}</td>`+
                        `<td class="p-2">${row.no_peserta || '-'}</td>`+
                        `<td class="p-2">${formatDateTime(row.surveyed_at) || '-'}</td>`+
                        `<td class="p-2">-</td>`+
                        `</tr>`;
                }
            });

            html += '</tbody></table>';
            container.innerHTML = html;

            // pagination (numbered)
            const pag = document.getElementById('listPagination');
            pag.innerHTML = '';
            if (payload.last_page && payload.last_page > 1) {
                const makeBtn = (p, text, disabled=false, cls='') => {
                    const b = document.createElement('button'); b.textContent = text; b.className = 'px-2 py-1 bg-slate-100 rounded mx-1 ' + cls; b.disabled = !!disabled;
                    b.addEventListener('click', ()=> fetchList(type, p, payload.per_page, document.getElementById('listSearch').value.trim()));
                    return b;
                };

                pag.appendChild(makeBtn(payload.current_page - 1, 'Prev', payload.current_page <= 1));

                const last = payload.last_page;
                const cur = payload.current_page;
                const pages = [];
                if (last <= 7) {
                    for (let i=1;i<=last;i++) pages.push(i);
                } else {
                    pages.push(1);
                    if (cur > 4) pages.push('...');
                    const start = Math.max(2, cur-2);
                    const end = Math.min(last-1, cur+2);
                    for (let i=start;i<=end;i++) pages.push(i);
                    if (cur < last-3) pages.push('...');
                    pages.push(last);
                }

                pages.forEach(p => {
                    if (p === '...') {
                        const span = document.createElement('span'); span.textContent = '...'; span.className = 'px-2'; pag.appendChild(span); return;
                    }
                    const active = p === cur;
                    const btn = makeBtn(p, String(p), false, active ? 'bg-blue-600 text-white' : '');
                    pag.appendChild(btn);
                });

                pag.appendChild(makeBtn(payload.current_page + 1, 'Next', payload.current_page >= last));

                // show total
                const totalInfo = document.createElement('div'); totalInfo.className = 'text-xs text-slate-500 ml-3'; totalInfo.textContent = `Total: ${payload.total || 0}`;
                pag.appendChild(totalInfo);
            }

            // row click handlers intentionally removed: rows are non-actionable
        }

        async function openDetail(params) {
            const q = new URLSearchParams(params).toString();
            try {
                const res = await fetch('/merch/api/detail?' + q, { credentials: 'same-origin' });
                const json = await res.json();
                const body = document.getElementById('detailBody');
                if (json.type === 'code') {
                    const r = json.response || {};
                    body.innerHTML = `
                        <div><strong>Kode:</strong> ${json.code}</div>
                        <div><strong>Nama:</strong> ${r.nama || '-'} </div>
                        <div><strong>No. HP:</strong> ${r.no_wa || r.nohp || '-'} </div>
                        <div><strong>Waktu Pengisian SKM:</strong> ${formatDateTime(r.created_at)}</div>
                        <div><strong>Redeemed At:</strong> ${formatDateTime(json.redeemed_at)}</div>
                        <div><strong>Redeemed By:</strong> ${json.redeemed_by || '-'}</div>
                    `;
                } else if (json.type === 'response') {
                    const r = json.response || {};
                    const codes = (json.codes || []).map(c=>`<div>${c.code} - ${c.redeemed_at ? 'Redeemed at '+formatDateTime(c.redeemed_at) : 'Belum'}</div>`).join('');
                    body.innerHTML = `
                        <div><strong>Nama:</strong> ${r.nama || '-'} </div>
                        <div><strong>No. HP:</strong> ${r.no_wa || r.nohp || '-'} </div>
                        <div><strong>Waktu Pengisian SKM:</strong> ${formatDateTime(r.created_at)}</div>
                        <div class="mt-2"><strong>Kode terkait:</strong>${codes}</div>
                    `;
                } else {
                    body.innerHTML = '<div>Tidak ada data</div>';
                }

                document.getElementById('detailModal').classList.remove('hidden');
                document.getElementById('detailModal').classList.add('flex');
            } catch (err) {
                alert('Gagal memuat detail');
            }
        }

        document.getElementById('closeDetail').addEventListener('click', function(){
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('detailModal').classList.remove('flex');
        });

        // initial load
        fetchStats();
    </script>
</body>
</html>
