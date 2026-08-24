<!doctype html>
<html lang="id">
<head>
    @include('partials.google-tag')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekap Pendapatan Tenant - Bayan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-900">
    <main class="min-h-screen flex items-center justify-center p-5">
        <section class="w-full max-w-xl rounded-3xl bg-white p-6 sm:p-9 shadow-2xl">
            <div class="mb-8">
                <p class="text-xs font-bold uppercase tracking-[0.25em] text-orange-600">Bayan Open &amp; Bayan Craft</p>
                <h1 class="mt-2 text-3xl font-black">Rekap Pendapatan Harian</h1>
                <p class="mt-2 text-sm text-slate-500">Isi setiap malam setelah kegiatan jualan selesai.</p>
            </div>

            @if (session('success'))
                <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">{{ session('success') }}</div>
            @endif
            @if (session('errors') && session('errors')->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    @foreach (session('errors')->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ url('/tenant-revenue') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="revenue_date" class="mb-2 block text-sm font-bold text-slate-700">Tanggal penjualan</label>
                    <input id="revenue_date" name="revenue_date" type="date" value="{{ old('revenue_date', now()->toDateString()) }}" required class="w-full rounded-xl border-slate-300 px-4 py-3 focus:border-orange-500 focus:ring-orange-500">
                </div>
                <div>
                    <label for="merchant_name" class="mb-2 block text-sm font-bold text-slate-700">Nama merchant / tenant</label>
                    <input id="merchant_name" name="merchant_name" type="text" value="{{ old('merchant_name') }}" maxlength="150" required placeholder="Ketik nama merchant" class="w-full rounded-xl border-slate-300 px-4 py-3 focus:border-orange-500 focus:ring-orange-500">
                </div>
                <div>
                    <label for="amount" class="mb-2 block text-sm font-bold text-slate-700">Nominal pendapatan (Rp)</label>
                    <input id="amountDisplay" type="text" inputmode="numeric" autocomplete="off" value="{{ old('amount') }}" required placeholder="Contoh: 1.500.000" class="w-full rounded-xl border-slate-300 px-4 py-3 focus:border-orange-500 focus:ring-orange-500">
                    <input id="amount" name="amount" type="hidden" value="{{ old('amount') }}">
                </div>
                <button type="submit" class="w-full rounded-xl bg-orange-600 px-5 py-3 font-black text-white hover:bg-orange-700">Simpan Rekapan</button>
            </form>

            <!-- <a href="{{ url('/tenant-revenue/dashboard') }}" class="mt-5 block text-center text-sm font-bold text-orange-700 hover:text-orange-900">Lihat dashboard pendapatan</a> -->
        </section>
    </main>
    <script>
        const amountDisplay = document.getElementById('amountDisplay');
        const amount = document.getElementById('amount');

        function formatAmount(value) {
            const digits = String(value || '').replace(/\D/g, '');
            return digits ? new Intl.NumberFormat('id-ID').format(Number(digits)) : '';
        }

        amountDisplay.value = formatAmount(amountDisplay.value);
        amountDisplay.addEventListener('input', () => {
            const digits = amountDisplay.value.replace(/\D/g, '');
            amount.value = digits;
            amountDisplay.value = formatAmount(digits);
        });

        amountDisplay.form.addEventListener('submit', () => {
            amount.value = amountDisplay.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>
