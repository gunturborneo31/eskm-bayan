<!doctype html>
<html>

<head>


    <meta name="viewport" conteitial-scale="1.0">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,400&family=Roboto:wght@500&display=swap"
        rel="stylesheet">
    {{-- <script src="node_modules/flowbite/dist/flowbite.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script data-hid="gpr-kominfo" src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js" async
        onload="this.__vm_l=1"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primaryColor: '#da373d',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-white text-gray-900 h-full relative" style="font-family:  'Roboto'">
    @include('layouts.sidebar')
    {{-- @include('remake.layouts.resume') --}}
    @yield('content')
</body>

</html>
