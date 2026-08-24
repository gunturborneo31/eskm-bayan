<!doctype html>
<html lang="id">
<head>
    @include('partials.google-tag')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Draw Peserta - Bayan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-white">
    <main class="min-h-screen flex items-center justify-center p-5">
        <section class="w-full max-w-3xl text-center">
            <div class="flex items-center justify-between mb-8 text-sm">
                <a href="/merch/check" class="text-slate-300 hover:text-white">Kembali</a>
                <span class="uppercase tracking-[0.25em] text-amber-400 font-bold">Bayan Open &amp; Bayan Craft</span>
                <span class="text-slate-400">{{ $participants->count() }} peserta</span>
            </div>

            <p class="text-slate-400 uppercase tracking-[0.3em] text-xs font-bold">Pengundian Peserta</p>
            <h1 class="mt-3 text-4xl sm:text-6xl font-black">Siapa yang beruntung?</h1>
            <div id="drawResult" class="mt-12 min-h-56 rounded-3xl border border-slate-800 bg-slate-900 px-6 py-10 flex flex-col items-center justify-center">
                <p class="text-slate-500 text-xl">Tekan tombol untuk mengacak peserta</p>
            </div>

            <button id="drawButton" type="button" class="mt-8 w-full sm:w-auto rounded-2xl bg-amber-500 px-10 py-4 text-lg font-black text-slate-950 shadow-lg shadow-amber-500/20 hover:bg-amber-400 disabled:cursor-wait disabled:opacity-70">
                Acak Peserta
            </button>
            <p class="mt-4 text-sm text-slate-500">MC membacakan nama pemenang. Pengundian ini tidak otomatis melakukan redeem.</p>
        </section>
    </main>

    <div id="participantModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 p-5">
        <div class="w-full max-w-xl rounded-2xl bg-white p-6 text-slate-900 shadow-2xl">
            <div class="flex items-center justify-between gap-4">
                <h2 class="text-xl font-black">Data Pribadi Peserta</h2>
                <button id="closeParticipantModal" type="button" class="rounded-lg bg-slate-200 px-3 py-2 text-sm font-bold hover:bg-slate-300">Tutup</button>
            </div>
            <div id="participantDetails" class="mt-5 grid gap-3 sm:grid-cols-2"></div>
        </div>
    </div>

    <script>
        const participants = @json($participants->map(fn ($participant) => [
            'id' => $participant->id,
            'name' => $participant->nama,
        ])->values());
        const drawButton = document.getElementById('drawButton');
        const drawResult = document.getElementById('drawResult');
        const drawnParticipantIds = new Set();

        function renderResult(label, participant, muted = false) {
            drawResult.replaceChildren();
            const labelElement = document.createElement('p');
            labelElement.className = muted ? 'text-slate-500 text-sm uppercase tracking-[0.25em]' : 'text-amber-400 text-sm uppercase tracking-[0.25em] font-bold';
            labelElement.textContent = label;
            drawResult.appendChild(labelElement);

            if (participant) {
                const nameElement = document.createElement('p');
                nameElement.className = muted ? 'mt-3 text-3xl font-black' : 'mt-3 text-4xl sm:text-6xl font-black break-words';
                nameElement.textContent = participant.name;
                drawResult.appendChild(nameElement);

                if (!muted) {
                    const idElement = document.createElement('p');
                    idElement.className = 'mt-4 text-slate-400';
                    idElement.textContent = `Peserta #${participant.id}`;
                    drawResult.appendChild(idElement);

                    const detailButton = document.createElement('button');
                    detailButton.type = 'button';
                    detailButton.className = 'mt-6 rounded-xl bg-white px-5 py-3 text-sm font-bold text-slate-900 hover:bg-amber-100';
                    detailButton.textContent = 'Lihat Data Pribadi';
                    detailButton.dataset.participantId = participant.id;
                    drawResult.appendChild(detailButton);
                }
            }
        }

        const participantModal = document.getElementById('participantModal');
        const participantDetails = document.getElementById('participantDetails');
        const closeParticipantModal = document.getElementById('closeParticipantModal');
        const detailFields = [
            ['nama', 'Nama'],
            ['nik', 'NIK'],
            ['no_wa', 'Nomor WhatsApp'],
            ['nohp', 'Nomor HP'],
            ['alamat', 'Alamat'],
            ['usia', 'Usia'],
            ['jenkel', 'Jenis Kelamin'],
            ['pekerjaan', 'Pekerjaan'],
            ['pendidikan', 'Pendidikan'],
            ['jenisPelayanan', 'Jenis Pelayanan'],
            ['tahun', 'Tahun'],
            ['saran', 'Saran / Masukan'],
        ];

        function closeParticipantDetails() {
            participantModal.classList.add('hidden');
            participantModal.classList.remove('flex');
        }

        closeParticipantModal.addEventListener('click', closeParticipantDetails);
        participantModal.addEventListener('click', (event) => {
            if (event.target === participantModal) closeParticipantDetails();
        });

        drawResult.addEventListener('click', async (event) => {
            const button = event.target.closest('[data-participant-id]');
            if (!button) return;

            button.disabled = true;
            button.textContent = 'Memuat data...';
            try {
                const response = await fetch(`/merch/api/detail?id=${encodeURIComponent(button.dataset.participantId)}`);
                const json = await response.json();
                if (!response.ok || !json.response) throw new Error('Data peserta tidak ditemukan');

                participantDetails.replaceChildren();
                detailFields.forEach(([key, label]) => {
                    const item = document.createElement('div');
                    item.className = 'rounded-xl bg-slate-50 p-3';
                    const labelElement = document.createElement('p');
                    labelElement.className = 'text-xs font-bold uppercase tracking-wide text-slate-500';
                    labelElement.textContent = label;
                    const valueElement = document.createElement('p');
                    valueElement.className = 'mt-1 break-words font-semibold';
                    valueElement.textContent = json.response[key] || '-';
                    item.append(labelElement, valueElement);
                    participantDetails.appendChild(item);
                });
                participantModal.classList.remove('hidden');
                participantModal.classList.add('flex');
            } catch (error) {
                window.alert(error.message || 'Data peserta gagal dimuat');
            } finally {
                button.disabled = false;
                button.textContent = 'Lihat Data Pribadi';
            }
        });

        drawButton.addEventListener('click', () => {
            const availableParticipants = participants.filter((participant) => !drawnParticipantIds.has(participant.id));
            if (!availableParticipants.length) {
                renderResult('Semua peserta sudah terpilih');
                drawButton.disabled = true;
                return;
            }

            drawButton.disabled = true;
            let ticks = 0;
            const animation = setInterval(() => {
                const preview = availableParticipants[Math.floor(Math.random() * availableParticipants.length)];
                renderResult('Mengacak...', preview, true);
                ticks += 1;
                if (ticks >= 12) {
                    clearInterval(animation);
                    const winner = availableParticipants[Math.floor(Math.random() * availableParticipants.length)];
                    drawnParticipantIds.add(winner.id);
                    renderResult('Pemenang', winner);
                    drawButton.disabled = false;
                }
            }, 100);
        });
    </script>
</body>
</html>