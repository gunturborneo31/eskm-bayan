<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Merch Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body{font-family:Manrope,system-ui,Arial}</style>
    </head>
<body class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="bg-white p-6 rounded shadow max-w-sm w-full">
        <h1 class="text-xl font-bold mb-4">Login Tim Merchandise</h1>
        @if($errors->any())
            <div class="mb-3 text-red-600">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="/merch/login">
            @csrf
            <div class="mb-3">
                <label class="block text-sm">Username</label>
                <input name="username" class="w-full border p-2 rounded" />
            </div>
            <div class="mb-3">
                <label class="block text-sm">Password</label>
                <input name="password" type="password" class="w-full border p-2 rounded" />
            </div>
            <div class="flex justify-end">
                <button class="px-4 py-2 bg-orange-500 text-white rounded">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
