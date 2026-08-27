@extends('layouts.index', ['title' => 'Rekap Pendapatan Tenant'])

@section('content')
<style>
    .tenant-revenue-admin {
        color: #1e293b;
    }

    .tenant-revenue-admin>.bg-white,
    .tenant-revenue-admin>section,
    .tenant-revenue-admin>.grid>.bg-white {
        background-color: #ffffff !important;
    }

    .tenant-revenue-admin>.grid>.bg-orange-600 {
        background-color: #ea580c !important;
        color: #ffffff !important;
    }

    .tenant-revenue-admin>.grid>.bg-orange-600 .text-orange-100 {
        color: #ffedd5 !important;
    }

    .tenant-revenue-admin label,
    .tenant-revenue-admin h1,
    .tenant-revenue-admin h2,
    .tenant-revenue-admin table td,
    .tenant-revenue-admin input[type="date"] {
        color: #1e293b !important;
    }

    .tenant-revenue-admin input[type="date"] {
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1;
    }

    .tenant-revenue-admin table th {
        background-color: #0f172a !important;
        color: #ffffff !important;
    }

    .tenant-revenue-admin table td {
        background-color: #ffffff !important;
    }
</style>

<div class="admin-main tenant-revenue-admin p-4 lg:p-6">
    <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-orange-600">Admin</p>
            <h1 class="mt-1 text-2xl font-black text-slate-800">Rekap Pendapatan Tenant</h1>
        </div>
        <a href="{{ url('/tenant-revenue/dashboard') }}" target="_blank"
            class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-bold text-white">Buka Dashboard Publik</a>
    </div>

    <form method="GET"
        class="mb-5 grid gap-3 rounded-2xl bg-white p-4 shadow-sm sm:grid-cols-[auto_1fr_1fr_auto_auto] sm:items-end">
        <a href="{{ $previousUrl }}" aria-label="Rentang tanggal sebelumnya"
            class="rounded-lg border border-slate-300 px-4 py-2.5 text-center text-sm font-bold text-slate-700 hover:bg-slate-100">&larr;
            Sebelumnya</a>
        <div><label for="from" class="mb-1 block text-xs font-bold text-slate-500">Dari tanggal</label><input id="from"
                name="from" type="date" value="{{ $from }}" class="w-full rounded-lg border-slate-300"></div>
        <div><label for="to" class="mb-1 block text-xs font-bold text-slate-500">Sampai tanggal</label><input id="to"
                name="to" type="date" value="{{ $to }}" class="w-full rounded-lg border-slate-300"></div>
        <button class="rounded-lg bg-orange-600 px-5 py-2.5 text-sm font-bold text-white">Terapkan</button>
        <a href="{{ $nextUrl }}" aria-label="Rentang tanggal berikutnya"
            class="rounded-lg border border-slate-300 px-4 py-2.5 text-center text-sm font-bold text-slate-700 hover:bg-slate-100">Berikutnya
            &rarr;</a>
    </form>

    <div class="mb-5 grid gap-4 sm:grid-cols-3">
        <div class="rounded-2xl bg-orange-600 p-5 text-white">
            <p class="text-xs uppercase tracking-widest text-orange-100">Total Pendapatan</p>
            <p class="mt-2 text-2xl font-black">Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm">
            <p class="text-xs uppercase tracking-widest text-slate-500">Tenant</p>
            <p class="mt-2 text-2xl font-black">{{ $summary->count() }}</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm">
            <p class="text-xs uppercase tracking-widest text-slate-500">Entri Harian</p>
            <p class="mt-2 text-2xl font-black">{{ $entries->count() }}</p>
        </div>
    </div>

    <div class="mb-3 flex flex-wrap justify-end gap-2">
        <a href="{{ route('tenant-revenue.export', ['format' => 'excel', 'from' => $from, 'to' => $to, 'sort' => $sort, 'direction' => $direction]) }}"
            class="rounded-lg bg-emerald-600 px-3 py-2 text-xs font-black text-white hover:bg-emerald-700">Export Excel</a>
        <a href="{{ route('tenant-revenue.export', ['format' => 'pdf', 'from' => $from, 'to' => $to, 'sort' => $sort, 'direction' => $direction]) }}"
            class="rounded-lg bg-red-600 px-3 py-2 text-xs font-black text-white hover:bg-red-700">Export PDF</a>
    </div>

    <section class="overflow-hidden rounded-2xl bg-white shadow-sm">
        <div class="border-b px-5 py-4">
            <h2 class="font-black">Akumulasi per Tenant</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="sticky left-0 bg-slate-900 px-5 py-3"><a href="{{ $sortUrl('name') }}"
                                class="inline-flex items-center gap-1">Nama Merchant
                                <span>{{ $sort === 'name' ? ($direction === 'asc' ? '^' : 'v') : '' }}</span></a></th>
                        @foreach ($dateColumns as $date)
                            <th class="whitespace-nowrap px-5 py-3 text-right">
                        {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</th>@endforeach<th
                            class="whitespace-nowrap px-5 py-3 text-right"><a href="{{ $sortUrl('total') }}"
                                class="inline-flex items-center gap-1">Total
                                <span>{{ $sort === 'total' ? ($direction === 'asc' ? '^' : 'v') : '' }}</span></a></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($summary as $merchant)
                    <tr>
                        <td class="sticky left-0 bg-white px-5 py-3 font-bold">{{ $merchant['name'] }}</td>
                        @foreach ($dateColumns as $date)@php($dateEntries = $merchant['entries_by_date'][$date] ?? [])
                        <td class="whitespace-nowrap px-5 py-3 text-right font-semibold">
                            @if (count($dateEntries) > 1)<button type="button"
                                data-duplicate-key="{{ $merchant['key'] }}" data-duplicate-date="{{ $date }}"
                                title="Lihat detail {{ count($dateEntries) }} input pada tanggal ini"
                                class="no-theme inline-flex w-full items-center justify-end gap-2 rounded-lg px-2 py-1 text-right text-slate-700 hover:bg-red-50 hover:text-red-700"><span
                                    class="rounded-full bg-red-100 px-2 py-0.5 text-xs font-black text-red-700">{{ count($dateEntries) }}x</span>
                                @if (isset($merchant['amount_by_date'][$date]))
                                Rp {{ number_format($merchant['amount_by_date'][$date], 0, ',', '.') }} @else - @endif</button>@elseif (isset($merchant['amount_by_date'][$date]))
                                    Rp {{ number_format($merchant['amount_by_date'][$date], 0, ',', '.') }} @else - @endif</td>
                        @endforeach<td class="whitespace-nowrap px-5 py-3 text-right font-black">Rp
                            {{ number_format($merchant['total'], 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ $dateColumns->count() + 2 }}" class="px-5 py-8 text-center text-slate-500">Belum
                            ada data pada rentang tanggal ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</div>

<div id="duplicateModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-5">
    <div class="w-full max-w-xl rounded-2xl bg-white p-6 text-slate-900 shadow-2xl">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black">Input Ganda</h2>
                <p id="duplicateCaption" class="mt-1 text-sm text-slate-500"></p>
            </div>
            <button id="closeDuplicateModal" type="button"
                class="rounded-lg bg-slate-200 px-3 py-2 text-sm font-bold hover:bg-slate-300">Tutup</button>
        </div>
        <div id="duplicateList" class="mt-5 space-y-2"></div>
    </div>
</div>

<script>
    const duplicateData = @json($summary->mapWithKeys(fn($merchant) => [$merchant['key'] => $merchant['entries_by_date']])->all());
    const duplicateModal = document.getElementById('duplicateModal');
    const duplicateList = document.getElementById('duplicateList');
    const duplicateCaption = document.getElementById('duplicateCaption');

    function closeDuplicateModal() {
        duplicateModal.classList.add('hidden');
        duplicateModal.classList.remove('flex');
    }

    document.getElementById('closeDuplicateModal').addEventListener('click', closeDuplicateModal);
    duplicateModal.addEventListener('click', (event) => {
        if (event.target === duplicateModal) closeDuplicateModal();
    });

    document.querySelectorAll('[data-duplicate-key]').forEach((button) => {
        button.addEventListener('click', () => {
            const entries = duplicateData[button.dataset.duplicateKey]?.[button.dataset.duplicateDate] || [];
            duplicateCaption.textContent = `${button.dataset.duplicateDate.split('-').reverse().join('/')} - ${entries.length} kali input`;
            duplicateList.replaceChildren();

            entries.forEach((entry, index) => {
                const row = document.createElement('div');
                row.className = 'flex items-center justify-between gap-3 rounded-xl bg-slate-50 p-3';
                const info = document.createElement('div');
                info.innerHTML = `<p class="font-bold">Input ke-${index + 1}</p><p class="text-sm text-slate-500">Rp ${new Intl.NumberFormat('id-ID').format(entry.amount)}${entry.created_at ? ` - ${entry.created_at}` : ''}</p>`;
                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'rounded-lg bg-red-600 px-3 py-2 text-xs font-bold text-white hover:bg-red-700 disabled:cursor-not-allowed disabled:bg-slate-300';
                deleteButton.textContent = 'Hapus';
                deleteButton.disabled = entries.length <= 1;
                deleteButton.addEventListener('click', async () => {
                    if (entries.length <= 1) return;
                    if (!window.confirm('Hapus entri pendapatan ini?')) return;
                    deleteButton.disabled = true;
                    const response = await fetch(`/admin/tenant-revenue/${entry.id}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                    });
                    const result = await response.json();
                    if (!response.ok) {
                        window.alert(result.message || 'Entri gagal dihapus.');
                        deleteButton.disabled = false;
                        return;
                    }
                    window.location.reload();
                });
                row.append(info, deleteButton);
                duplicateList.appendChild(row);
            });

            duplicateModal.classList.remove('hidden');
            duplicateModal.classList.add('flex');
        });
    });
</script>
@endsection