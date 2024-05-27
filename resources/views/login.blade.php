<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Roboto:ital,wght@1,100&display=swap"
        rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="h-screen">
        <div class="container h-full ">
            <div class="grid-2 flex h-full items-center justify-stretch">
                <!-- Left column container with background-->
                <div class="w-1/2 block grid-1 flex h-full items-center justify-stretch  bg-[#2b885b] bg-no-repeat"
                    style="background-image:
        radial-gradient(at -30% -30%, #4da279, transparent 80%),
        radial-gradient(at 130% 150%, #4da279, transparent 80%);">
                    <div class="w-full">
                        <div class="flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-1/6 h-1/6  text-white ">
                                <path fill-rule="evenodd"
                                    d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z"
                                    clip-rule="evenodd" />
                            </svg>
                            <label class="text-8xl font-extrabold text-white font-Lilita">SKM</label>
                        </div>
                        <label class="w-full block text-center text-xl font-extrabold text-white font-sans">
                            Survey
                            Kepuasan
                            Masyarakat
                        </label>
                    </div>
                </div>

                <!-- Right column container with form -->
                <div class="md:w-8/12 lg:ml-6 lg:w-5/12 justify-center">
                    <form method="POST" action="{{ route('dashboard.store') }}" class="justify-center"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Email input -->
                        <div class="mb-6">
                            <label class="text-2xl">Username</label>
                            <input type="text" name="username"
                                class="peer mt-2 block min-h-[auto] w-full rounded-lg  bg-transparent px-3 py-[0.32rem] leading-[3]  border border-2 border-[#4da279]"
                                id="exampleFormControlInput3" placeholder="Username" />
                        </div>

                        <!-- Password input -->
                        <div class="mb-6">
                            <label class="text-2xl">Password</label>
                            <input type="password" name="password"
                                class="peer mt-2 block min-h-[auto] w-full rounded-lg  bg-transparent px-3 py-[0.32rem] leading-[3]  border border-2 border-[#4da279]"
                                id="exampleFormControlInput3" placeholder="Username" />
                        </div>

                        <!-- Submit button -->
                        <?php
                        $tahun = date('Y');
                        $bulan = date('m');
                        ?>

                        <button type="submit"
                            class="text-2xl inline-block w-full rounded-lg h-16  px-7 pb-2.5 pt-3 font-medium uppercase text-white font-black  bg-[#2b885b] bg-no-repeat"
                            style="background-color: #51a592;
                                    background-image:
                                        radial-gradient(at -30% -30%, #02A859, transparent 80%),
                                        radial-gradient(at 130% 150%, #02A859, transparent 80%);">
                            MASUK
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
