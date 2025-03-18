@extends('mo.layout')

@section('content')
    <main class="p-4 md:ml-64 h-auto pt-20">
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 mt-5 ">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
                    <!-- Card 1 (Total Mahasiswa) -->
                    <div
                        class="border border-gray-300 rounded-lg shadow-md h-28 flex items-center p-6 bg-white dark:bg-gray-800">
                        <div class="mr-4 text-blue-500">
                            <svg class="w-14 h-14 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 12c2.7614 0 5-2.2386 5-5s-2.2386-5-5-5-5 2.23858-5 5 2.2386 5 5 5Zm0 2c-4.4183 0-8 2.0147-8 4.5V21h16v-2.5c0-2.4853-3.5817-4.5-8-4.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-1 text-base text-gray-500 dark:text-white">Mahasiswa</h5>
                            <p class="font-bold text-gray-700 dark:text-gray-400">70</p>
                        </div>
                    </div>


                    <!-- Card 2 (Total Mata Kuliah) -->
                    <div
                        class="border border-gray-300 rounded-lg shadow-md h-28 flex items-center p-6 bg-white dark:bg-gray-800">
                        <div class="mr-4 text-yellow-500">
                            <svg class="w-14 h-14 text-yellow-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-1 text-base text-gray-500 dark:text-white">Mata Kuliah</h5>
                            <p class="font-bold text-gray-700 dark:text-gray-400">50</p>
                        </div>
                    </div>
                    <!-- Card 3 (Surat Siap Upload) -->
                    <div
                        class="border border-gray-300 rounded-lg shadow-md h-28 flex items-center p-6 bg-white dark:bg-gray-800">
                        <div class="mr-4 text-red-500">
                            <svg class="w-14 h-14 text-red-500" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-1 text-base text-gray-500 dark:text-white">Surat Siap Upload</h5>
                            <p class="font-bold text-gray-700 dark:text-gray-400">100</p>
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 lg:grid-cols-[auto,auto] gap-6 items-start">
                    <!-- Diagram Pie Chart -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full min-w-[400px] h-auto">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Distribusi Surat</h1>
    
                        <div class="flex flex-col items-center">
                            <!-- Chart -->
                            <div class="chart-container w-[300px] h-[300px]">
                                <canvas id="pieChart"></canvas>
                            </div>
    
                            <!-- Legend -->
                            <div id="legend-container" class="mt-6 max-w-[300px] text-center"></div>
                        </div>
                    </div>
    

                    <!-- Tabel Daftar Surat -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md min-w-[400px] h-auto">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Daftar Surat Terbaru</h1>
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-6 py-3">No</th>
                                        <th class="px-6 py-3">Jenis Surat</th>
                                        <th class="px-6 py-3">Nama Mahasiswa</th>
                                        <th class="px-6 py-3">Tanggal Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-3">1</td>
                                        <td class="px-6 py-3">Surat Keterangan Aktif</td>
                                        <td class="px-6 py-3">John Doe</td>
                                        <td class="px-6 py-3">2025-03-18</td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-3">2</td>
                                        <td class="px-6 py-3">Surat Cuti Akademik</td>
                                        <td class="px-6 py-3">Jane Smith</td>
                                        <td class="px-6 py-3">2025-03-17</td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-3">3</td>
                                        <td class="px-6 py-3">Surat Keterangan Lulus</td>
                                        <td class="px-6 py-3">Michael Johnson</td>
                                        <td class="px-6 py-3">2025-03-16</td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-3">4</td>
                                        <td class="px-6 py-3">Surat Rekomendasi Beasiswa</td>
                                        <td class="px-6 py-3">Emily Davis</td>
                                        <td class="px-6 py-3">2025-03-15</td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-3">5</td>
                                        <td class="px-6 py-3">Surat Pengunduran Diri</td>
                                        <td class="px-6 py-3">David Wilson</td>
                                        <td class="px-6 py-3">2025-03-14</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                 <!-- Tabel Daftar Pengguna Terbaru -->
                 <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md min-w-[400px] h-auto mt-4">
                    <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Daftar Mahasiswa Terbaru</h1>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3">Nik</th>
                                    <th class="px-6 py-3">Nama</th>
                                    <th class="px-6 py-3">Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-3">1</td>
                                    <td class="px-6 py-3">1234567890</td>
                                    <td class="px-6 py-3">John Doe</td>
                                    <td class="px-6 py-3">2025-03-18</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-3">2</td>
                                    <td class="px-6 py-3">0987654321</td>
                                    <td class="px-6 py-3">Jane Smith</td>
                                    <td class="px-6 py-3">2025-03-17</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-3">3</td>
                                    <td class="px-6 py-3">5678901234</td>
                                    <td class="px-6 py-3">Michael Johnson</td>
                                    <td class="px-6 py-3">2025-03-16</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-3">4</td>
                                    <td class="px-6 py-3">3456789012</td>
                                    <td class="px-6 py-3">Emily Davis</td>
                                    <td class="px-6 py-3">2025-03-15</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-3">5</td>
                                    <td class="px-6 py-3">2345678901</td>
                                    <td class="px-6 py-3">David Wilson</td>
                                    <td class="px-6 py-3">2025-03-14</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


               




            </div>

        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-piecelabel@0.3.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    

    <script>
        var pieChart = document.getElementById("pieChart").getContext("2d");

        var myPieChart = new Chart(pieChart, {
            type: "pie",
            data: {
                labels: [
                    "Keterangan Aktif",
                    "Pengantar Tugas",
                    "Keterangan Lulus",
                    "Laporan Hasil Studi",
                ],
                datasets: [{
                    data: [40, 25, 20, 15], // Data contoh, bisa diambil dari database
                    backgroundColor: ["#2C7DA0", "#00A6A6", "#F4A259", "#8FC93A"],
                    borderWidth: 1,
                    borderColor: "#ffffff", // Border putih agar kontras
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom", // Pindahkan legend ke bawah
                        labels: {
                            font: {
                                size: 12,
                            },
                            usePointStyle: true,
                        },
                    },
                    datalabels: {
                        display: true, // Tampilkan datalabels
                        color: "white", // Warna font label
                        font: {
                            size: 14, // Ukuran font label
                        },
                    },
                },
            },
            plugins: [ChartDataLabels], // Tambahkan plugin datalabels
        });
    </script>
@endsection
