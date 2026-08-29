<!doctype html>
<html lang="id">
<head>
    @include('partials.google-tag')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Draw Peserta - Bayan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* countdown overlay styles */
        .overlay{
          position:fixed;inset:0;display:none;align-items:center;justify-content:center;
          background: linear-gradient(0deg, rgba(255,255,255,0.01) 1px, transparent 1px) 0 0 / 36px 36px,
                      linear-gradient(90deg, rgba(255,255,255,0.01) 1px, transparent 1px) 0 0 / 36px 36px,
                      #0d1114;
          z-index:9999;
        }
        .countdown-center{display:flex;flex-direction:column;align-items:center;justify-content:center;color:#fff}
        .countdown-seconds{font-weight:800;color:#fff;font-size:4rem;margin:0}
        .roller-window{height:56px;width:420px;overflow:hidden;display:flex;align-items:center;justify-content:center}
        .roller-name{font-weight:700;color:#fff;font-size:1.8rem;transition:transform .15s linear,color .2s}
        .winner-card{position:fixed;inset:0;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(6px);opacity:0;pointer-events:none;transition:opacity .3s}
        .winner-card.show{opacity:1;pointer-events:auto}
        .winner-inner{background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));border:1px solid rgba(255,255,255,0.06);padding:24px;border-radius:12px;min-width:300px;text-align:center}
    </style>
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

            <div id="countdownContainer" class="mt-6"></div>

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

    <!-- Countdown + Rolling Overlay -->
    <div id="overlay" class="overlay" aria-hidden="true">
      <div class="countdown-center">
        <svg viewBox="0 0 220 220" width="280" height="280" aria-hidden="true">
          <g id="ticks" transform="translate(110,110)"></g>
          <circle cx="110" cy="110" r="90" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="3"/>
          <circle id="progress" cx="110" cy="110" r="82" fill="none" stroke="#ffb000" stroke-width="6" stroke-linecap="round" transform="rotate(-90 110 110)" style="stroke-dasharray:0 9999"/>
        </svg>
        <div id="overlaySeconds" class="countdown-seconds">8</div>
        <div class="roller-window"><div id="rollerName" class="roller-name">—</div></div>
        <div style="margin-top:6px;color:#9aa6b2;letter-spacing:4px;font-size:12px">T-MINUS DETIK</div>
      </div>
    </div>

    <script>
        const participants = @json($participants->values());
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

                const phoneElement = document.createElement('p');
                phoneElement.className = muted ? 'mt-2 text-slate-400 text-base font-semibold' : 'mt-2 text-slate-300 text-lg font-semibold';
                phoneElement.textContent = `HP: ${participant.phone}`;
                drawResult.appendChild(phoneElement);

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

            // Use full-screen overlay countdown with rolling names
            const overlay = document.getElementById('overlay');
            const overlaySeconds = document.getElementById('overlaySeconds');
            const rollerName = document.getElementById('rollerName');
            const progress = document.getElementById('progress');
            const ticks = document.getElementById('ticks');

            // helper: create ticks
            function createTicks(groupEl, total = 60) {
                groupEl.innerHTML = '';
                const radius = 96;
                for (let i = 0; i < total; i++) {
                    const angle = (i / total) * Math.PI * 2;
                    const inner = (i % 5 === 0) ? radius - 9 : radius - 5;
                    const outer = radius;
                    const x1 = Math.cos(angle) * inner;
                    const y1 = Math.sin(angle) * inner;
                    const x2 = Math.cos(angle) * outer;
                    const y2 = Math.sin(angle) * outer;
                    const line = document.createElementNS('http://www.w3.org/2000/svg','line');
                    line.setAttribute('x1', x1);
                    line.setAttribute('y1', y1);
                    line.setAttribute('x2', x2);
                    line.setAttribute('y2', y2);
                    line.setAttribute('stroke', 'rgba(255,255,255,0.04)');
                    line.setAttribute('stroke-width', i % 5 === 0 ? 2 : 1);
                    groupEl.appendChild(line);
                }
            }

            // roller helper
            function createRoller(nameEl) {
                let intervalId = null;
                function startShuffle(names, speedMs = 60) {
                    stop();
                    if (!Array.isArray(names) || names.length === 0) {
                        nameEl.textContent = '—';
                        return;
                    }
                    intervalId = setInterval(() => {
                        const n = names[Math.floor(Math.random() * names.length)];
                        nameEl.textContent = n.name || n;
                        nameEl.style.color = '#fff';
                    }, speedMs);
                }
                function stop() {
                    if (intervalId) {
                        clearInterval(intervalId);
                        intervalId = null;
                    }
                }
                function decelerateToWinner(names, winner, steps = 12, startDelay = 80, factor = 1.35) {
                    stop();
                    if (!Array.isArray(names) || names.length === 0) {
                        nameEl.textContent = '—';
                        return Promise.resolve();
                    }
                    const seq = [];
                    for (let i = 0; i < Math.max(steps - 1, 3); i++) {
                        let candidate = names[Math.floor(Math.random() * names.length)];
                        if (candidate.id === winner.id && names.length > 1) {
                            const alt = names.filter(n => n.id !== winner.id);
                            candidate = alt[Math.floor(Math.random() * alt.length)];
                        }
                        seq.push(candidate);
                    }
                    seq.push(winner);

                    return new Promise((resolve) => {
                        let idx = 0;
                        let delay = startDelay;
                        function step() {
                            const item = seq[idx];
                            nameEl.textContent = item.name || item;
                            nameEl.style.transform = 'translateY(-4px)';
                            setTimeout(()=> nameEl.style.transform = 'translateY(0)', Math.min(80, delay/2));
                            idx++;
                            if (idx < seq.length) {
                                setTimeout(step, delay);
                                delay = Math.min(1200, delay * factor);
                            } else {
                                nameEl.style.color = '#ffb000';
                                resolve();
                            }
                        }
                        step();
                    });
                }
                return { startShuffle, stop, decelerateToWinner };
            }

            if (!ticks.hasChildNodes()) createTicks(ticks, 60);
            const radius = 82;
            const circumference = 2 * Math.PI * radius;
            progress.style.strokeDasharray = `${circumference} ${circumference}`;
            progress.style.strokeDashoffset = `${circumference}`;

            overlay.style.display = 'flex';
            overlay.setAttribute('aria-hidden','false');

            const roller = createRoller(rollerName);
            roller.startShuffle(availableParticipants, 60);

            const seconds = 8; // countdown seconds
            overlaySeconds.textContent = String(seconds);
            const start = performance.now();
            let animFrame = null;

            function setProgress(ft) {
                const offset = circumference * (1 - ft);
                progress.style.transition = 'stroke-dashoffset 0.25s linear';
                progress.style.strokeDashoffset = offset;
            }
            setProgress(1);

            function tick(now) {
                const elapsed = (now - start) / 1000;
                const t = Math.min(1, elapsed / seconds);
                const ft = 1 - t;
                const current = Math.ceil(seconds * ft);
                overlaySeconds.textContent = current >= 0 ? current : 0;
                setProgress(1 - t);
                if (elapsed < seconds) {
                    animFrame = requestAnimationFrame(tick);
                } else {
                    // finish: choose winner and decelerate
                    const winner = availableParticipants[Math.floor(Math.random() * availableParticipants.length)];
                    roller.decelerateToWinner(availableParticipants, winner, 12, 80, 1.35).then(() => {
                        // hide overlay after a short pause
                        setTimeout(() => {
                            overlay.style.display = 'none';
                            overlay.setAttribute('aria-hidden','true');
                            // mark and render
                            drawnParticipantIds.add(winner.id);
                            renderResult('Pemenang', winner);
                            drawButton.disabled = false;
                        }, 300);
                    });
                }
            }
            animFrame = requestAnimationFrame(tick);
        });
    </script>
</body>
</html>