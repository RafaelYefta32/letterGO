<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kaprodi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Sidebar Navigasi -->
    <div class="flex">
        <div class="w-1/5 bg-cyan-900 h-screen p-4 text-white flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-bold mb-4">Menu</h2>
                <ul>
                    <li class="mb-2"><a href="#" class="p-2 hover:bg-cyan-800 flex items-center">Dashboard</a>
                    </li>
                    <li class="mb-2"><a href="#" class="p-2 hover:bg-cyan-800 flex items-center">Pengajuan
                            Surat</a></li>
                    <li class="mb-2"><a href="#" class="p-2 hover:bg-cyan-800 flex items-center">Persetujuan</a>
                    </li>
                    <li class="mb-2"><a href="#" class="p-2 hover:bg-cyan-800 flex items-center">Surat
                            Terbit</a></li>
                </ul>
            </div>

            <!-- Profile Section -->
            <button class="flex items-center p-4 bg-cyan-800 rounded">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                    class="w-10 h-10 rounded-full mr-3" alt="Profile Picture">
                <div>
                    <p class="text-white font-bold">Tom Cook</p>
                    <p class="text-sm text-cyan-300">Kaprodi Teknik Informatika</p>
                </div>
            </button>
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

</body>

</html>
