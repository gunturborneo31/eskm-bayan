<!doctype html>
<html class="scroll-smooth">

<head>
    @include('partials.google-tag')
    <meta charset="utf-8">
    <meta name="viewport" conteitial-scale="1.0">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php
$error = 'max-w-md  font-bold tracking-tight mb-2 text-red-600 lg:text-sm text-xl drop-shadow-[0_5px_5px_rgba(0,0,0,0.2)]';
$slug = request()->segment(count(request()->segments()));
?>

<?php
// Ambil slug terakhir dari URL
$slug = request()->segment(count(request()->segments()));

// Definisikan 3 array utama
$badan = [
    [
        'nama' => 'BAPPELITBANGDA MAHULU', 
        'link' => 'https://e-skm.bappelitbangdamahulu.com/?tw=7&Tahun=2025'
    ],
    [
        'nama' => 'BANKESBANGPOL MAHULU', 
        'link' => ''
    ],
    // [
    //     'nama' => '', 
    //     'link' => ''
    // ],
];

$dinas = [
   [
        'nama' => 'DP3A MAHULU', 
        'link' => ''
    ],
    [
        'nama' => 'DISHUB MAHULU', 
        'link' => ''
    ],
//     [
//         'nama' => '', 
//         'link' => ''
//     ],
];

$kantor = [
    [
        'nama' => 'INSPEKTORAT MAHULU', 
        'link' => 'https://eskm-inspektorat.akkreatif.my.id/?tw=7&Tahun=2025'
    ],
    // [
    //     'nama' => '', 
    //     'link' => ''
    // ],
];

// Tentukan data yang diambil berdasarkan slug aktif
switch ($slug) {
    case 'badan':
        $data = $badan;
        break;
    case 'dinas':
        $data = $dinas;
        break;
    case 'kantor':
        $data = $kantor;
        break;
    default:
        $data = [];
        break;
}
?>


<body class="items-center">

    <div class="overflow-x-hidden">
        <form action="{{ route('nilaiUnsur.store') }}" method="POST" enctype="multipart/form-data"
            class="h-screen flex">
            @csrf
            <div id="awal"
                class=" items-center relative isolate  min-w-full h-screen h-screen px-6 shadow-2xl sm:px-16 lg:px-24 bg-gradient-to-br from-[#18bdde] from-60%  to-[#fffb61] to-95%">

                <div class="  text-center   lg:py-32 lg:text-left  w-full justify-between">
                    <h1
                        class=" max-w-md  capitalize font-bold tracking-tight mb-2 whitespace-nowrap mb-3 text-gray-900 lg:text-2xl  text-4xl  drop-shadow-[0_1px_1px_rgba(0,0,0,0.3)]">
                        Silahkan Memlilih {{$slug}} Terkait :
                    </h1>
                    <div class="lg:flex w-full justify-between gap-4">
                        <ul class="grid w-full gap-2 md:grid-cols-2 grid-cols-1">
                            @foreach ($data as $item)
                                <a target="_blank" href="{{ $item['link'] }}">
                                    <label
                                        class="inline-flex items-center justify-between w-full p-3 text-gray-900 bg-white border-2 border-white rounded-xl cursor-pointer peer-checked:bg-gray-800 h-full peer-checked:text-white hover:text-gray-900 hover:bg-gray-400">
                                        <div class="block w-full">
                                            <div class="w-full text-left text-lg font-bold">{{ strtoupper($item['nama']) }}</div>
                                        </div>
                                    </label>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
                    



