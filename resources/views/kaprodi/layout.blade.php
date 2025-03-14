<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    {{-- <link rel="icon" href="data:image/svg+xml,<svg class='mr-2 h-8 w-auto' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'><path fill='%234f46e5' d='M20 14h-2.722L11 20.278a5.511 5.511 0 0 1-.9.722H20a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1ZM9 3H4a1 1 0 0 0-1 1v13.5a3.5 3.5 0 1 0 7 0V4a1 1 0 0 0-1-1ZM6.5 18.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM19.132 7.9 15.6 4.368a1 1 0 0 0-1.414 0L12 6.55v9.9l7.132-7.132a1 1 0 0 0 0-1.418Z'/></svg>"> --}}
    <title>Laravel</title>
</head>

<body class="bg-gray-100">

    <!-- Sidebar Navigasi -->
    <div class="flex">
        <div class="w-1/5 bg-cyan-900 h-screen p-4 text-white flex flex-col justify-between mr-20">
            <div>
                <h2 class="text-xl font-bold mb-4">Menu</h2>
                <ul>
                    <li class="mb-2"><a href="{{ route('kaprodi-dashboard') }}"
                            class="p-2 hover:bg-cyan-800 flex items-center">Dashboard</a>
                    </li>
                    <li class="mb-2"><a href="{{ route('kaprodi-pengajuan') }}"
                            class="p-2 hover:bg-cyan-800 flex items-center">Pengajuan
                            Surat</a></li>
                    <li class="mb-2"><a href="{{ route('logout') }}"
                            class="p-2 hover:bg-cyan-800 flex items-center">Logout</a></li>
                </ul>
            </div>

            <!-- Profile Section -->
            <button type="button"
                class="flex mx-3 text-sm rounded-full md:mr-0 justify-center items-center"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                <span class="sr-only">Open user menu</span>
                <img class="w-10 h-10 rounded-full" src="{{ asset('profilePicture/' . Auth::user()->image) }}"
                    alt="user photo" />
            </button>
            <!-- Dropdown menu -->
            <div class="hidden z-50 my-4 w-56 text-base list-none bg-white divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                id="dropdown">
                <div class="py-3 px-4">
                    <span
                        class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->nama }}</span>
                    <span class="block text-sm text-gray-900 truncate dark:text-white">{{ Auth::user()->email }}</span>
                </div>
                <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                    <li>
                        <a href="#"
                            class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My
                            profile</a>
                    </li>
                </ul>
                <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                    <li>
                        <a href="#"
                            class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign
                            out</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Konten Dashboard Kaprodi -->
        @yield('content')
    </div>

    <!-- Modal Detail Pengajuan -->
    <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-md w-1/3">
            <h2 class="text-xl font-bold mb-2">Detail Pengajuan</h2>
            <p><strong>Nama:</strong> <span id="modalNama"></span></p>
            <p><strong>Jenis Surat:</strong> <span id="modalJenis"></span></p>
            <div class="mt-4 flex gap-2">
                <button onclick="approveSurat()" class="bg-green-500 text-white px-3 py-1 rounded">Setujui</button>
                <button onclick="rejectSurat()" class="bg-red-500 text-white px-3 py-1 rounded">Tolak</button>
                <button onclick="closeModal()" class="bg-gray-500 text-white px-3 py-1 rounded">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(nama, jenis) {
            document.getElementById("modalNama").innerText = nama;
            document.getElementById("modalJenis").innerText = jenis;
            document.getElementById("modal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("modal").classList.add("hidden");
        }

        function approveSurat() {
            alert("Surat telah disetujui.");
            closeModal();
        }

        function rejectSurat() {
            alert("Surat telah ditolak.");
            closeModal();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>

</html>
