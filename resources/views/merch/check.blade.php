<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Merch - Cek Kode</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/minified/html5-qrcode.min.js"></script>
    <style>body{font-family:Manrope,system-ui,Arial}</style>
</head>
<body class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Pemeriksa Merchandise</h1>
            <form method="POST" action="/merch/logout">@csrf<button class="px-3 py-1 bg-red-600 text-white rounded">Logout</button></form>
        </div>

        <div id="cameraStatus" class="mb-4 rounded border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800 hidden"></div>

        <div class="grid grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <label class="block mb-2">Masukkan kode atau scan QR</label>
                <div class="flex gap-2">
                    <input id="valueInput" class="border p-2 rounded flex-1" placeholder="Masukkan kode atau paste URL QR" />
                    <button id="checkBtn" class="px-3 py-2 bg-blue-600 text-white rounded">Cek</button>
                </div>

                <div class="mt-3 text-xs text-gray-500">
                    Jika kamera tidak muncul, tetap bisa memasukkan kode/group manual di kolom di atas.
                </div>

                <div id="result" class="mt-4"></div>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <label class="block mb-2">Scanner QR</label>
                <div id="reader" style="width:100%"></div>
                <div id="cameraHint" class="text-xs text-gray-500 mt-2">Arahkan kamera ke QR code.</div>
            </div>
        </div>
    </div>

    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const cameraStatus = document.getElementById('cameraStatus');
        const cameraHint = document.getElementById('cameraHint');

        function setCameraStatus(message, type = 'info') {
            if (!cameraStatus) return;
            cameraStatus.classList.remove('hidden', 'border-amber-200', 'bg-amber-50', 'text-amber-800', 'border-red-200', 'bg-red-50', 'text-red-700', 'border-green-200', 'bg-green-50', 'text-green-700');
            cameraStatus.innerHTML = message;
            if (type === 'warning') {
                cameraStatus.classList.add('border-red-200', 'bg-red-50', 'text-red-700');
            } else if (type === 'success') {
                cameraStatus.classList.add('border-green-200', 'bg-green-50', 'text-green-700');
            } else {
                cameraStatus.classList.add('border-amber-200', 'bg-amber-50', 'text-amber-800');
            }
            cameraStatus.classList.remove('hidden');
        }

        function renderResponse(json){
            const el = document.getElementById('result');
            if (!json || !json.exists) {
                el.innerHTML = '<div class="p-3 bg-red-50 text-red-700 rounded">Data tidak ditemukan</div>';
                return;
            }

            if (json.type === 'code'){
                const r = json.response || {};
                el.innerHTML = `
                    <div class="p-3 bg-green-50 rounded">
                        <div><strong>Kode:</strong> ${json.code}</div>
                        <div><strong>Redeemed:</strong> ${json.redeemed ? 'Ya' : 'Belum'}</div>
                    </div>
                    <div class="mt-2 p-3 bg-white border rounded">
                        <div><strong>Nama:</strong> ${r.nama || '-'}</div>
                        <div><strong>NIK:</strong> ${r.nik || '-'}</div>
                        <div><strong>No. WA:</strong> ${r.no_wa || r.nohp || '-'}</div>
                    </div>
                `;
                return;
            }

            if (json.type === 'group'){
                const r = json.response || {};
                const codesHtml = (json.codes || []).map(c=>{
                    if (c.redeemed) return `<div class=\"py-1 flex items-center justify-between\">${c.code} - <span class=\\"text-green-600\\">Sudah</span></div>`;
                    return `<div class=\"py-1 flex items-center justify-between\">${c.code} - <button class=\\"ml-2 px-2 py-1 bg-blue-600 text-white text-xs rounded btn-redeem\\" data-code=\\"${c.code}\\">Tukar</button></div>`;
                }).join('');
                el.innerHTML = `
                    <div class="p-3 bg-green-50 rounded">
                        <div><strong>Group:</strong> ${r.redeem_group || '-'}</div>
                        <div><strong>Nama:</strong> ${r.nama || '-'}</div>
                    </div>
                    <div class="mt-2 p-3 bg-white border rounded">${codesHtml}</div>
                `;
                // attach handlers for redeem buttons
                attachRedeemHandlers();
                return;
            }
        }

        async function checkValue(val){
            const url = `/merch/api/check?value=${encodeURIComponent(val)}`;
            try {
                const res = await fetch(url, {credentials:'same-origin'});
                const json = await res.json();
                renderResponse(json);
            } catch (e){
                document.getElementById('result').innerHTML = '<div class="p-3 bg-red-50 text-red-700 rounded">Gagal koneksi</div>';
            }
        }

        document.getElementById('checkBtn').addEventListener('click', function(e){
            e.preventDefault();
            const v = document.getElementById('valueInput').value.trim();
            if (!v) return;
            checkValue(v);
        });

        const isSecureContext = window.isSecureContext || location.hostname === 'localhost' || location.hostname === '127.0.0.1';
        if (!isSecureContext) {
            setCameraStatus('Browser memblokir kamera karena situs ini tidak aman. Gunakan HTTPS atau localhost, atau cukup masukkan kode/group manual di kolom input.', 'warning');
            if (cameraHint) {
                cameraHint.textContent = 'Kamera tidak tersedia karena situs tidak aman. Masukkan kode manual di kolom input.';
            }
        }

        function attachRedeemHandlers(){
            document.querySelectorAll('.btn-redeem').forEach(b => {
                b.removeEventListener('click', onRedeemClick);
                b.addEventListener('click', onRedeemClick);
            });
        }

        async function onRedeemClick(e){
            const code = e.currentTarget.getAttribute('data-code');
            if (!confirm('Tukar merchandise untuk kode '+code+' ?')) return;
            try{
                const res = await fetch('/merch/api/redeem', {
                    method: 'POST',
                    headers: {
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept':'application/json'
                    },
                    body: JSON.stringify({ code })
                });
                const json = await res.json();
                if (json && json.ok){
                    alert('Berhasil ditukar oleh '+json.redeemed_by);
                    checkValue(document.getElementById('valueInput').value.trim());
                } else {
                    alert('Gagal: '+(json.message||json.error||'unknown'));
                }
            }catch(err){
                alert('Kesalahan jaringan');
            }
        }

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia && isSecureContext) {
            const html5QrCode = new Html5Qrcode("reader");
            Html5Qrcode.getCameras().then(cameras => {
                if (cameras && cameras.length) {
                    setCameraStatus('Kamera siap dipakai. Arahkan ke QR code untuk scan otomatis.', 'success');
                    html5QrCode.start(
                        cameras[0].id,
                        { fps: 10, qrbox: 250 },
                        qrCodeMessage => {
                            document.getElementById('valueInput').value = qrCodeMessage;
                            checkValue(qrCodeMessage);
                            setTimeout(attachRedeemHandlers, 250);
                        },
                        () => {
                            // ignore scanner errors; user can still enter code manually
                        }
                    ).catch(err => {
                        console.warn('QR init failed', err);
                        setCameraStatus('Kamera tidak bisa dimulai di browser ini. Silakan masukkan kode atau group secara manual.', 'warning');
                    });
                    return;
                }

                setCameraStatus('Tidak ada kamera yang tersedia di browser ini. Masukkan kode/group manual di kolom input.', 'warning');
                if (cameraHint) {
                    cameraHint.textContent = 'Tidak ada kamera terdeteksi. Masukkan kode manual untuk cek data.';
                }
            }).catch(err => {
                console.warn('Camera detection failed', err);
                setCameraStatus('Browser tidak dapat mengakses kamera. Gunakan mode manual dengan memasukkan kode/group.', 'warning');
                if (cameraHint) {
                    cameraHint.textContent = 'Akses kamera diblokir. Silakan masukkan kode manual.';
                }
            });
        } else {
            setCameraStatus('Akses kamera dibatasi karena situs ini bukan secure context. Masukkan kode/group manual untuk melanjutkan.', 'warning');
            if (cameraHint) {
                cameraHint.textContent = 'Akses kamera dibatasi. Masukkan kode manual untuk melanjutkan.';
            }
        }
    </script>
</body>
</html>
