<!doctype html>
<html lang="id">
<head>
    @include('partials.google-tag')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Pendapatan Tenant - Bayan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <main class="mx-auto max-w-6xl p-5 sm:p-8">
        <header class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.25em] text-orange-600">Bayan Open &amp; Bayan Craft</p>
                <h1 class="mt-2 text-3xl font-black">Dashboard Pendapatan Tenant</h1>
                <p class="mt-2 text-sm text-slate-500">Rekap dapat dilihat berdasarkan rentang tanggal.</p>
            </div>
            <a href="{{ url('/tenant-revenue') }}" class="rounded-xl bg-orange-600 px-4 py-3 text-center text-sm font-black text-white hover:bg-orange-700">Input Pendapatan</a>
        </header>

        <form method="GET" class="mb-6 grid gap-3 rounded-2xl bg-white p-4 shadow-sm sm:grid-cols-[auto_1fr_1fr_auto_auto] sm:items-end">
            <a href="{{ $previousUrl }}" aria-label="Rentang tanggal sebelumnya" class="rounded-lg border border-slate-300 px-4 py-2.5 text-center text-sm font-bold text-slate-700 hover:bg-slate-100">&larr; Sebelumnya</a>
            <div><label for="from" class="mb-1 block text-xs font-bold text-slate-500">Dari tanggal</label><input id="from" name="from" type="date" value="{{ $from }}" class="w-full rounded-lg border-slate-300"></div>
            <div><label for="to" class="mb-1 block text-xs font-bold text-slate-500">Sampai tanggal</label><input id="to" name="to" type="date" value="{{ $to }}" class="w-full rounded-lg border-slate-300"></div>
            <button class="rounded-lg bg-slate-900 px-5 py-2.5 text-sm font-bold text-white hover:bg-slate-700">Terapkan</button>
            <a href="{{ $nextUrl }}" aria-label="Rentang tanggal berikutnya" class="rounded-lg border border-slate-300 px-4 py-2.5 text-center text-sm font-bold text-slate-700 hover:bg-slate-100">Berikutnya &rarr;</a>
        </form>

        <div class="mb-6 grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl bg-slate-950 p-5 text-white"><p class="text-xs uppercase tracking-widest text-slate-400">Total Pendapatan</p><p class="mt-2 text-2xl font-black">Rp {{ number_format($grandTotal, 0, ',', '.') }}</p></div>
            <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-xs uppercase tracking-widest text-slate-500">Jumlah Tenant</p><p class="mt-2 text-2xl font-black">{{ $summary->count() }}</p></div>
            <div class="rounded-2xl bg-white p-5 shadow-sm"><p class="text-xs uppercase tracking-widest text-slate-500">Entri Harian</p><p class="mt-2 text-2xl font-black">{{ $entries->count() }}</p></div>
        </div>

        <section class="overflow-hidden rounded-2xl bg-white shadow-sm">
            <div class="border-b px-5 py-4"><h2 class="font-black">Akumulasi per Tenant</h2></div>
            <div class="overflow-x-auto"><table class="w-full text-left text-sm"><thead class="bg-orange-600 text-white"><tr><th class="sticky left-0 bg-orange-600 px-5 py-3"><a href="{{ $sortUrl('name') }}" class="inline-flex items-center gap-1">Nama Merchant <span>{{ $sort === 'name' ? ($direction === 'asc' ? '^' : 'v') : '' }}</span></a></th>@foreach ($dateColumns as $date)<th class="whitespace-nowrap px-5 py-3 text-right">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</th>@endforeach<th class="whitespace-nowrap px-5 py-3 text-right"><a href="{{ $sortUrl('total') }}" class="inline-flex items-center gap-1">Total <span>{{ $sort === 'total' ? ($direction === 'asc' ? '^' : 'v') : '' }}</span></a></th></tr></thead><tbody class="divide-y divide-slate-100">
                @forelse ($summary as $merchant)
                    <tr><td class="sticky left-0 bg-white px-5 py-3 font-bold">{{ $merchant['name'] }}</td>@foreach ($dateColumns as $date)@php($dateEntries = $merchant['entries_by_date'][$date] ?? [])<td class="whitespace-nowrap px-5 py-3 text-right font-semibold">@if (count($dateEntries) > 1)<span title="Tenant ini menginput {{ count($dateEntries) }} kali pada tanggal ini" class="mr-1 inline-flex rounded-full bg-red-100 px-2 py-0.5 text-xs font-black text-red-700">{{ count($dateEntries) }}x</span>@endif @if (isset($merchant['amount_by_date'][$date])) Rp {{ number_format($merchant['amount_by_date'][$date], 0, ',', '.') }} @else - @endif</td>@endforeach<td class="whitespace-nowrap px-5 py-3 text-right font-black">Rp {{ number_format($merchant['total'], 0, ',', '.') }}</td></tr>
                @empty
                    <tr><td colspan="{{ $dateColumns->count() + 2 }}" class="px-5 py-8 text-center text-slate-500">Belum ada data pada rentang tanggal ini.</td></tr>
                @endforelse
            </tbody></table></div>
        </section>
    </main>
</body>
</html>
