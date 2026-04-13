<div class="min-h-screen bg-app text-slate-950">
    <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 py-6 sm:px-6 lg:px-8">
        <header class="glass-panel overflow-hidden rounded-[2rem] border border-white/60 px-5 py-5 shadow-[0_30px_100px_rgba(15,23,42,0.12)] sm:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                <div class="max-w-3xl space-y-4">
                    <div class="inline-flex items-center gap-3 rounded-full bg-white/70 px-4 py-2 text-sm font-semibold uppercase tracking-[0.28em] text-teal-800">
                        <img src="{{ asset('assets/logo-bayan.png') }}" alt="Logo Bayan" class="h-9 w-9 rounded-full bg-white p-1">
                        PWA Livewire Dashboard
                    </div>

                    <div class="space-y-3">
                        <p class="text-sm font-semibold uppercase tracking-[0.32em] text-orange-600">Sekretariat Daerah Kabupaten Mahulu</p>
                        <h1 class="display-font text-4xl leading-none text-slate-950 sm:text-5xl lg:text-6xl">
                            E-SKM yang lebih rapi, responsif, dan siap dipasang di layar utama.
                        </h1>
                        <p class="max-w-2xl text-sm leading-7 text-slate-700 sm:text-base">
                            Halaman utama sekarang memakai Livewire untuk filter interaktif, layout responsif untuk mobile dan desktop, serta shell PWA dengan manifest dan service worker. Admin modern dipindahkan ke panel Filament.
                        </p>
                    </div>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 lg:w-[23rem] lg:grid-cols-1">
                    <a href="{{ url('/skm') }}" class="cta-primary">Isi Survei</a>
                    <a href="{{ url('/admin') }}" class="cta-secondary">Masuk Admin Filament</a>
                </div>
            </div>
        </header>

        <section class="mt-6 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="glass-panel rounded-[2rem] border border-white/60 p-5 sm:p-6">
                <div class="flex flex-col gap-5">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-teal-700">Filter Live</p>
                            <h2 class="display-font text-2xl text-slate-950">Ringkasan layanan publik</h2>
                        </div>
                        <button type="button" wire:click="selectAllDepartments" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-teal-500 hover:text-teal-700">
                            Pilih semua bagian
                        </button>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        <label class="space-y-2 text-sm font-semibold text-slate-700">
                            Tahun
                            <select wire:model.live="year" class="field-input">
                                @foreach ($availableYears as $availableYear)
                                    <option value="{{ $availableYear }}">{{ $availableYear }}</option>
                                @endforeach
                            </select>
                        </label>

                        <label class="space-y-2 text-sm font-semibold text-slate-700">
                            Periode
                            <select wire:model.live="period" class="field-input">
                                @foreach ($periodOptions as $periodValue => $periodLabel)
                                    <option value="{{ $periodValue }}">{{ $periodLabel }}</option>
                                @endforeach
                            </select>
                        </label>

                        <div class="rounded-[1.5rem] border border-slate-200 bg-white/70 p-4">
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-orange-600">Cakupan</p>
                            <p class="mt-2 text-sm leading-6 text-slate-700">{{ $summary['date_range_label'] }}</p>
                            <p class="mt-1 text-xs text-slate-500">{{ $summary['period_label'] }} • {{ count($summary['departments']) }} bagian dipilih</p>
                        </div>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($departmentOptions as $code => $label)
                            <button
                                type="button"
                                wire:click="toggleDepartment('{{ $code }}')"
                                class="department-chip {{ in_array($code, $summary['departments'], true) ? 'department-chip-active' : '' }}"
                            >
                                <span class="text-left">
                                    <span class="block text-xs uppercase tracking-[0.24em] text-slate-500">Bagian</span>
                                    <span class="mt-1 block text-sm font-semibold text-slate-900">{{ $label }}</span>
                                </span>
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ in_array($code, $summary['departments'], true) ? 'bg-white/20 text-white' : 'bg-teal-100 text-teal-700' }}">
                                    {{ in_array($code, $summary['departments'], true) ? 'Aktif' : 'Pilih' }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <article class="metric-card bg-slate-950 text-white sm:col-span-2">
                    <p class="metric-label text-white/70">Nilai SKM</p>
                    <div class="mt-3 flex items-end justify-between gap-4">
                        <div>
                            <h3 class="display-font text-5xl">{{ number_format($summary['average_skm'], 2) }}</h3>
                            <p class="mt-2 text-sm text-white/80">{{ $summary['grade'] }}</p>
                        </div>
                        <div class="rounded-[1.5rem] bg-white/10 px-4 py-3 text-right">
                            <p class="text-xs uppercase tracking-[0.24em] text-white/50">Sumber data</p>
                            <p class="mt-1 text-sm font-semibold">Tabel {{ $summary['table'] ?? 'belum tersedia' }}</p>
                        </div>
                    </div>
                </article>

                <article class="metric-card">
                    <p class="metric-label">Total responden</p>
                    <h3 class="display-font mt-3 text-4xl">{{ number_format($summary['responses']) }}</h3>
                    <p class="mt-2 text-sm text-slate-600">Data terhitung otomatis dari filter aktif.</p>
                </article>

                <article class="metric-card">
                    <p class="metric-label">Saran masuk</p>
                    <h3 class="display-font mt-3 text-4xl">{{ number_format($summary['suggestions_count']) }}</h3>
                    <p class="mt-2 text-sm text-slate-600">Masukan non-kosong dari responden.</p>
                </article>

                <article class="metric-card">
                    <p class="metric-label">Bagian aktif</p>
                    <h3 class="display-font mt-3 text-4xl">{{ number_format($summary['active_departments']) }}</h3>
                    <p class="mt-2 text-sm text-slate-600">Bagian dengan data pada rentang terpilih.</p>
                </article>

                <article class="metric-card">
                    <p class="metric-label">Update terakhir</p>
                    <h3 class="mt-3 text-xl font-semibold text-slate-900">{{ $summary['latest_response'] }}</h3>
                    <p class="mt-2 text-sm text-slate-600">Memudahkan admin melihat aktivitas terbaru.</p>
                </article>
            </div>
        </section>

        <section class="mt-6 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
            <article class="glass-panel rounded-[2rem] border border-white/60 p-5 sm:p-6">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.28em] text-teal-700">Tren Bulanan</p>
                        <h2 class="display-font text-2xl text-slate-950">Aktivitas responden</h2>
                    </div>
                    <div wire:loading.flex class="items-center gap-2 rounded-full bg-teal-100 px-4 py-2 text-xs font-bold uppercase tracking-[0.24em] text-teal-700">
                        Memuat ulang
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-3 gap-3 sm:grid-cols-6 xl:grid-cols-12 xl:gap-4">
                    @foreach ($summary['monthly_chart'] as $month)
                        <div class="flex flex-col items-center gap-3">
                            <div class="flex h-44 w-full items-end rounded-[1.25rem] bg-slate-100/80 p-2">
                                <div class="w-full rounded-[1rem] bg-gradient-to-t from-teal-700 via-cyan-500 to-orange-300 transition-all duration-300" style="height: {{ $month['height'] }}%;"></div>
                            </div>
                            <div class="text-center">
                                <p class="text-sm font-semibold text-slate-900">{{ $month['value'] }}</p>
                                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ $month['label'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </article>

            <div class="grid gap-6">
                <article class="glass-panel rounded-[2rem] border border-white/60 p-5 sm:p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-teal-700">Komposisi Bagian</p>
                    <h2 class="display-font mt-2 text-2xl text-slate-950">Distribusi responden</h2>

                    <div class="mt-5 space-y-4">
                        @forelse ($summary['department_breakdown'] as $department)
                            <div class="space-y-2">
                                <div class="flex items-center justify-between gap-4 text-sm font-semibold text-slate-700">
                                    <span>{{ $department['label'] }}</span>
                                    <span>{{ number_format($department['total']) }}</span>
                                </div>
                                <div class="h-3 overflow-hidden rounded-full bg-slate-200">
                                    <div class="h-full rounded-full bg-gradient-to-r from-teal-600 to-orange-400" style="width: {{ $summary['responses'] > 0 ? max(8, round(($department['total'] / $summary['responses']) * 100)) : 0 }}%;"></div>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-[1.5rem] border border-dashed border-slate-300 px-4 py-8 text-center text-sm text-slate-500">
                                Belum ada distribusi yang bisa ditampilkan untuk filter ini.
                            </div>
                        @endforelse
                    </div>
                </article>

                <article class="glass-panel rounded-[2rem] border border-white/60 p-5 sm:p-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-teal-700">Respons Terbaru</p>
                    <h2 class="display-font mt-2 text-2xl text-slate-950">Activity feed</h2>

                    <div class="mt-5 space-y-3">
                        @forelse ($summary['recent_responses'] as $response)
                            <div class="rounded-[1.5rem] border border-slate-200 bg-white/70 px-4 py-3">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-sm font-semibold text-slate-900">{{ $response['name'] }}</p>
                                        <p class="mt-1 text-sm text-slate-600">{{ $response['department'] }}</p>
                                    </div>
                                    <span class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">{{ $response['created_at'] }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-[1.5rem] border border-dashed border-slate-300 px-4 py-8 text-center text-sm text-slate-500">
                                Belum ada respons yang cocok dengan filter ini.
                            </div>
                        @endforelse
                    </div>
                </article>
            </div>
        </section>
    </div>
</div>



