<!doctype html>
<html lang="id">
<head>
    @include('partials.google-tag')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Merch - History Penukaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-50">
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">History Penukaran</h1>
        <a href="/merch/check" class="px-3 py-1 bg-blue-600 text-white rounded">Kembali</a>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <table class="w-full text-left text-sm">
            <thead>
            <tr class="border-b"><th class="py-2">Kode</th><th>Group</th><th>Nama</th><th>Redeemed At</th><th>By</th></tr>
            </thead>
            <tbody>
            @foreach($items as $it)
                <tr class="border-b">
                    <td class="py-2 font-mono">{{ $it->code }}</td>
                    <td>{{ optional($it->response)->redeem_group }}</td>
                    <td>{{ optional($it->response)->nama }}</td>
                    <td>{{ $it->redeemed_at }}</td>
                    <td>{{ $it->redeemed_by }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
