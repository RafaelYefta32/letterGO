@extends('layouts.layout')

@section('content')
    <main class="p-4 md:ml-64 h-auto pt-20">
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 mt-5 ">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
                    <!-- Card 1 (Surat Menunggu) -->
                    <div
                        class="border border-gray-300 rounded-lg shadow-md h-28 flex items-center p-6 bg-white dark:bg-gray-800">
                        <div class="mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-14 h-14 text-orange-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-1 text-base text-gray-500 dark:text-white">Menunggu Persetujuan</h5>
                            <p class="font-bold text-gray-700 dark:text-gray-400">{{ $totalSuratMenunggu }}</p>
                        </div>
                    </div>

                    <!-- Card 2 (Surat Disetujui) -->
                    <div
                        class="border border-gray-300 rounded-lg shadow-md h-28 flex items-center p-6 bg-white dark:bg-gray-800">
                        <div class="mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-14 h-14 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-1 text-base text-gray-500 dark:text-white">Disetujui</h5>
                            <p class="font-bold text-gray-700 dark:text-gray-400">{{ $totalSuratDisetujui }}</p>
                        </div>
                    </div>

                    <!-- Card 3 (Surat Siap Upload) -->
                    <div
                        class="border border-gray-300 rounded-lg shadow-md h-28 flex items-center p-6 bg-white dark:bg-gray-800">
                        <div class="mr-4 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-14 h-14 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-1 text-base text-gray-500 dark:text-white">Ditolak</h5>
                            <p class="font-bold text-gray-700 dark:text-gray-400">{{ $totalSuratDitolak }}</p>
                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 lg:grid-cols-[auto,2fr] gap-6 items-start">
                    <!-- Diagram Pie Chart -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full min-w-[350px] h-auto">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Jenis Pengajuan Surat</h1>

                        <div class="flex flex-col items-center">
                            <!-- Chart -->
                            <div class="chart-container w-full max-w-[300px] h-[300px]">
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Line Chart -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-full min-w-[400px] h-auto">
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Jumlah Pengajuan Surat</h1>

                        <div class="flex flex-col items-center">
                            <!-- Chart -->
                            <div class="chart-container w-full max-w-[800px] h-[300px]">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Daftar Surat -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md min-w-[400px] h-auto mt-4">
                    <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Daftar Surat Terbaru</h1>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">No</th>
                                    <th class="px-6 py-3">Jenis Surat</th>
                                    <th class="px-6 py-3">Nama Mahasiswa</th>
                                    <th class="px-6 py-3">Tanggal Pengajuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestLetterList as $letter)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-3">{{ $letter->jenis_surat }}</td>
                                        <td class="px-6 py-3">{{ $letter->mahasiswa->nama }}</td>
                                        <td class="px-6 py-3">{{ $letter->tanggal_pengajuan }}</td>
                                    </tr>
                                @endforeach
                              
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
        var lineChart = document.getElementById("lineChart").getContext("2d");

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
                    data: [{{ $totalLetterMA }}, {{ $totalLetterTMK }}, {{ $totalLetterKL }}, {{ $totalLetterHS }}],
                    backgroundColor: ["#2C7DA0", "#00A6A6", "#F4A259", "#8FC93A"],
                    borderWidth: 1,
                    borderColor: "#ffffff",
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            font: {
                                size: 12,
                            },
                            usePointStyle: true,
                        },
                    },
                    datalabels: {
                        display: context => context.dataset.data[context.dataIndex] >= 1,
                        color: "white",
                        font: {
                            size: 14,
                        },
                    },
                },
            },
            plugins: [ChartDataLabels],
        });

        var myLineChart = new Chart(lineChart, {
        type: "line",
        data: {
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
          datasets: [
            {
              label: "Surat",
              borderColor: "#1d7af3",
              pointBorderColor: "#FFF",
              pointBackgroundColor: "#1d7af3",
              pointBorderWidth: 2,
              pointHoverRadius: 4,
              pointHoverBorderWidth: 1,
              pointRadius: 4,
              backgroundColor: "transparent",
              fill: true,
              borderWidth: 2,
              data: [
                {{ $totalSuratJan }}, {{ $totalSuratFeb }}, {{ $totalSuratMar }}, {{ $totalSuratApr }}, {{ $totalSuratMay }}, {{ $totalSuratJun }}, {{ $totalSuratJul }}, {{ $totalSuratAug }}, {{ $totalSuratSep }}, {{ $totalSuratOkt }}, {{ $totalSuratNov }}, {{ $totalSuratDes }},
              ],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "bottom",
            labels: {
              padding: 10,
              fontColor: "#1d7af3",
            },
          },
          tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10,
          },
          layout: {
            padding: { left: 15, right: 15, top: 15, bottom: 15 },
          },
        },
      });


       
    </script>
@endsection
