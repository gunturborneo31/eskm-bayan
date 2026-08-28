



        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF8800',
                        'primary-deep': '#924C00',
                        'surface-soft': '#F8F9FA',
                        'surface-card': '#FFFFFF',
                        'surface-muted': '#F3F4F5',
                        'text-soft': '#574335'
                    },
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif']
                    },
                    borderRadius: {
                        card: '2rem'
                    }
                }
            }
        }
    

        (function(){
            try {
                if (typeof window !== 'undefined' && window.location) {
                    var h = window.location.hash;
                    if (h === '#awal' || !h) {
                        try { history.replaceState(null, '', window.location.pathname + window.location.search + '#identitas'); } catch(e) {}
                        var _s = document.createElement('style');
                        _s.id = 'hide-initial-popup';
                        _s.innerHTML = '#popup{display:none !important}';
                        document.head.appendChild(_s);
                        window.__skipInitialPopup = true;
                    }
                }
            } catch (e) {
                // ignore
            }
        })();
    

    let hasSubJenis = false;

    function escapeHtml(s){
        return String(s ?? '').replace(/[&<>"']/g, m => ({
            '&':'&amp;',
            '<':'&lt;',
            '>':'&gt;',
            '"':'&quot;',
            "'":'&#39;'
        }[m]));
    }

    function renderJenisButtons(groups){
        const el = document.getElementById('jenisContainer');
        // Data bisa berupa array of group (lama) atau array of program (baru)
        let data = Array.isArray(groups) ? groups : [];
        // Jika data[0] punya 'items', berarti format lama (group by bidang), ambil semua items
        if (data.length && data[0].items) {
            data = data.flatMap(g => g.items || []);
        }
        hasSubJenis = data.length > 0;

        if(!hasSubJenis){
            el.innerHTML = `
                <div class="px-3 py-2 text-sm text-gray-600 bg-white rounded-2xl border border-orange-200 font-semibold">
                    Bagian ini belum memiliki data program. Anda akan langsung diarahkan ke pengisian biodata.
                </div>
            `;
            setTimeout(function() {
                window.location = '#identitas';
            }, 600);
            return;
        }

        let index = 0;
        const html = data.map((it) => {
            const inputId = `jenis${it.id}`;
            const checked = index === 0 ? 'checked' : '';
            index++;
            return `
                <li>
                    <input type="radio"
                        id="${inputId}"
                        name="jenis"
                        value="${it.id}"
                        class="hidden peer radio-jenis"
                        ${checked}>
                    <label for="${inputId}"
                        class="inline-flex items-left justify-between w-full p-3 text-gray-900 bg-white border-2 border-white rounded-2xl cursor-pointer peer-checked:bg-gray-800 h-full peer-checked:text-white hover:text-gray-900 hover:bg-gray-400">
                        <div class="block flex w-full items-left">
                            <div class="w-full lg:text-lg lg:text-2xl text-left lg:text-left text-4xl font-semibold">
                                ${escapeHtml(it.jenis || '-')}
                            </div>
                        </div>
                    </label>
                </li>
            `;
        }).join('');
        el.innerHTML = `<ul class="grid w-full gap-2 lg:grid-cols-2 grid-cols-1">${html}</ul>`;
    }

    function loadJenisFlat(bagianId){
        const el = document.getElementById('jenisContainer');
        el.innerHTML = '<div class="px-3 py-2 text-sm text-gray-500">Memuat data…</div>';

        // Debug: tampilkan bagianId yang dikirim
        console.log('[DEBUG] Memuat sub_jenis untuk bagianId:', bagianId);

        fetch(`/sub-jenis/list?bagian=${encodeURIComponent(bagianId)}`)
            .then(async r => {
                let json;
                try {
                    json = await r.json();
                } catch (e) {
                    throw new Error('Respon bukan JSON');
                }
                // Debug: tampilkan hasil fetch ke console
                console.log('[DEBUG] Hasil fetch /sub-jenis/list:', json);
                if(!json.ok) {
                    // Tampilkan pesan error dari backend
                    throw new Error(json.message || 'Gagal memuat data');
                }
                if(!json.data || !Array.isArray(json.data) || json.data.length === 0) {
                    el.innerHTML = `<div class='px-3 py-2 text-sm text-red-600 bg-white rounded-2xl border border-orange-200 font-semibold'>Tidak ada data program untuk bagian ini.<br>Silakan cek data di admin atau hubungi admin.</div>`;
                    hasSubJenis = false;
                    return;
                }
                renderJenisButtons(json.data || []);
            })
            .catch((err) => {
                hasSubJenis = false;
                el.innerHTML = `<div class="px-3 py-2 text-sm text-red-600">Gagal memuat data: ${err.message || err}</div>`;
                // Debug: tampilkan error detail
                console.error('[DEBUG] Gagal load sub_jenis:', err);
            });
    }

    function lanjutKeBiodata(){
        // Jika tidak ada jenis layanan, langsung lanjut
        if (!hasSubJenis) {
            window.location = '#identitas';
            return;
        }
        // Jika ada jenis layanan, wajib pilih salah satu
        const selectedJenis = document.querySelector('.radio-jenis:checked');
        if (!selectedJenis) {
            alert('Silakan pilih pelayanan atau sub pelayanan terlebih dahulu.');
            return;
        }
        window.location = '#identitas';
    }

    function goToSection(sectionId) {
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }

        const target = document.getElementById(sectionId);
        if (!target) {
            window.location.hash = '#' + sectionId;
            return;
        }

        const y = Math.max(0, target.offsetTop - 12);
        window.location.hash = '#' + sectionId;

        setTimeout(function () {
            window.scrollTo({ top: y, left: 0, behavior: 'auto' });
            document.documentElement.scrollTop = y;
            document.body.scrollTop = y;
            if (document.scrollingElement) {
                document.scrollingElement.scrollTop = y;
            }
        }, 0);
    }

    function lanjutDariIdentitas(){
        // const nama = document.getElementById('nama');
        // const nohp = document.getElementById('nohp');
        // const alamat = document.getElementById('alamat');
        // const jenkel = document.querySelector('#identitas input[name="jenkel[jenkel]']:checked');

        // const requiredFields = [
        //     { element: nama, label: 'Nama' },
        //     { element: nohp, label: 'No. Telp' },
        //     { element: alamat, label: 'Alamat' },
        // ];

        // for (const field of requiredFields) {
        //     if (!field.element || !field.element.value.trim()) {
        //         alert(`Silakan isi ${field.label} terlebih dahulu.`);
        //         field.element?.focus();
        //         return;
        //     }
        // }

        // if (!jenkel) {
        //     alert('Silakan pilih jenis kelamin terlebih dahulu.');
        //     return;
        // }

        goToSection('kedua');
    }

    function syncViewportHeight() {
        const vh = (window.visualViewport ? window.visualViewport.height : window.innerHeight) * 0.01;
        document.documentElement.style.setProperty('--app-vh', `${vh}px`);
    }

    function ensureSectionVisible(sectionId) {
        const target = document.getElementById(sectionId);
        if (!target) return;

        requestAnimationFrame(function () {
            target.scrollIntoView({ behavior: 'auto', block: 'start' });
            setTimeout(function () {
                window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
            }, 30);
        });
    }

    function resetSurveyForm(){
        const form = document.querySelector('.survey-track');
        if (!form) {
            return;
        }

        form.reset();

        const firstBagian = document.querySelector('.radio-bagian');
        if (firstBagian) {
            firstBagian.checked = true;
            loadJenisFlat(firstBagian.value);
        }

        hasSubJenis = false;
        window.location.hash = '#awal';
    }

    document.addEventListener('change', function (e) {
        const el = e.target;
        if (el.classList && el.classList.contains('radio-bagian')) {
            loadJenisFlat(el.value);
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
    document.body.classList.add('is-ready');

        // Tampilkan popup ucapan otomatis di awal (kecuali jika kita sengaja melewatinya)
        var popup = document.getElementById('popup');
        if (popup && !window.__skipInitialPopup) popup.classList.remove('hidden');

        // Jika tidak ada hash, set ke #awal; jika awal sengaja diminta sebelumnya,
        // head script sudah mengganti URL ke #identitas, jadi jangan set ulang ke #awal.
        if (!window.location.hash || window.location.hash === '#jenisProgram') {
            window.location.hash = '#awal';
        }

        // Update progress bar dan label step sesuai hash saat halaman dimuat
        const fullSections = [
            { id: 'awal', label: 'Pilih bagian layanan' },
            { id: 'jenisProgram', label: 'Pilih jenis layanan' },
            { id: 'identitas', label: 'Lengkapi data identitas' },
            { id: 'kedua', label: 'Lengkapi biodata lainnya' },
            { id: 'satu', label: 'Kesesuaian persyaratan layanan' },
            { id: 'dua', label: 'Kemudahan prosedur pelayanan' },
            { id: 'tiga', label: 'Kecepatan waktu pelayanan' },
            { id: 'empat', label: 'Kewajaran biaya atau tarif' },
            { id: 'lima', label: 'Kesesuaian produk pelayanan' },
            { id: 'enam', label: 'Kompetensi petugas pelayanan' },
            { id: 'tujuh', label: 'Kesopanan dan keramahan petugas' },
            { id: 'delapan', label: 'Kualitas sarana dan prasarana' },
            { id: 'sembilan', label: 'Penanganan pengaduan layanan' },
            { id: 'saran', label: 'Saran dan Harapan' }
        ];

        // Keputusan apakah kita harus menghapus dua langkah awal dari indikator.
        // Kita skip jika head script menandai skip, atau jika URL sudah #identitas
        // dan tidak ada referrer (langsung akses/tautan) — ini memetakan kasus /skm#awal.
        const shouldSkipInitial = !!window.__skipInitialPopup || (window.location.hash === '#identitas' && !document.referrer);
        let sections = shouldSkipInitial ? fullSections.filter(s => s.id !== 'awal' && s.id !== 'jenisProgram') : fullSections;

        const stepLabel = document.getElementById('surveyStepLabel');
        const stepCount = document.getElementById('surveyStepCount');
        const dots = document.getElementById('surveyProgressDots');

        if (dots) {
            dots.innerHTML = sections.map((_, index) => `<span data-step-dot="${index}"></span>`).join('');
        }

        function updateStepFromHash() {
            const hash = window.location.hash ? window.location.hash.replace('#', '') : 'identitas';
            const activeIndex = Math.max(0, sections.findIndex((section) => section.id === hash));
            const activeSection = sections[activeIndex] || sections[0];
            if (stepLabel) stepLabel.textContent = activeSection.label;
            if (stepCount) stepCount.textContent = `${activeIndex + 1} / ${sections.length}`;
            document.querySelectorAll('[data-step-dot]').forEach((dot, index) => {
                dot.classList.toggle('is-active', index === activeIndex);
            });
        }

        // Jalankan update saat halaman dimuat dan saat hash berubah
        updateStepFromHash();
        window.addEventListener('hashchange', updateStepFromHash);
        window.addEventListener('hashchange', function () {
            const hash = window.location.hash ? window.location.hash.replace('#', '') : 'identitas';
            const target = document.getElementById(hash);
            if (target && typeof target.scrollIntoView === 'function') {
                setTimeout(function () {
                    target.scrollIntoView({ behavior: 'auto', block: 'start' });
                    window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
                    document.documentElement.scrollTop = 0;
                    document.body.scrollTop = 0;
                }, 50);
            }
        });

        if (window.visualViewport) {
            window.visualViewport.addEventListener('resize', syncViewportHeight, { passive: true });
            window.visualViewport.addEventListener('scroll', syncViewportHeight, { passive: true });
        }
        window.addEventListener('resize', syncViewportHeight, { passive: true });
        window.addEventListener('orientationchange', syncViewportHeight, { passive: true });
        syncViewportHeight();

        // Jika kita mengganti #awal di head (skip awal), scroll ke identitas setelah update
        if (window.__skipInitialPopup) {
            try {
                const ident = document.getElementById('identitas');
                if (ident && typeof ident.scrollIntoView === 'function') {
                    ident.scrollIntoView({ behavior: 'auto', block: 'start' });
                }
            } catch (e) {}
        }
    });


        var popup = document.getElementById("popup");

        function closePopup() {
            if (popup) {
                popup.classList.add('hidden');
            }
        }

        function syncPopupVisibility() {
            if (!popup) return;

            var hash = window.location.hash || '#awal';
            var showInitialPopup = hash === '#awal' || hash === '#jenisProgram' || hash === '';

            if (showInitialPopup) {
                popup.classList.remove('hidden');
                return;
            }

            popup.classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
            syncPopupVisibility();
        });

        window.addEventListener('hashchange', function () {
            syncPopupVisibility();
        });
    