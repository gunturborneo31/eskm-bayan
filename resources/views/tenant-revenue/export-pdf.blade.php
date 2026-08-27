<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Akumulasi Pendapatan Tenant</title>
    <style>
        @page { margin: 28px 24px; }
        body { color: #1e293b; font-family: DejaVu Sans, sans-serif; font-size: 10px; }
        h1 { color: #0f172a; font-size: 18px; margin: 0 0 5px; }
        p { color: #64748b; margin: 0 0 16px; }
        table { border-collapse: collapse; width: 100%; }
        th { background: #0f172a; color: #fff; font-weight: bold; }
        th, td { border: 1px solid #cbd5e1; padding: 6px; }
        td { background: #fff; }
        td.amount { text-align: right; white-space: nowrap; }
        td.total { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Akumulasi Pendapatan Tenant</h1>
    <p>Periode {{ \Carbon\Carbon::parse($from)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($to)->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Merchant</th>
                @foreach ($dateColumns as $date)
                    <th>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</th>
                @endforeach
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($summary as $merchant)
                <tr>
                    <td>{{ $merchant['name'] }}</td>
                    @foreach ($dateColumns as $date)
                        <td class="amount">Rp {{ number_format($merchant['amount_by_date'][$date] ?? 0, 0, ',', '.') }}</td>
                    @endforeach
                    <td class="amount total">Rp {{ number_format($merchant['total'], 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $dateColumns->count() + 2 }}">Belum ada data pada rentang tanggal ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
