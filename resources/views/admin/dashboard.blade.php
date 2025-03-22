@extends('layouts.layout')

@section('content')
    <main class="p-4 md:ml-64 h-auto pt-20">
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 mt-5 ">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
                    <!-- Card 1 (Total Users) -->
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
                            <h5 class="mb-1 text-base text-gray-500 dark:text-white">User</h5>
                            <p class="font-bold text-gray-700 dark:text-gray-400">100</p>
                        </div>
                    </div>
    
                    <!-- Card 2 (Total Majors) -->
                    <div
                        class="border border-gray-300 rounded-lg shadow-md h-28 flex items-center p-6 bg-white dark:bg-gray-800">
                        <div class="mr-4 text-green-500">
                            <svg class="w-14 h-14 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="m6 10.5237-2.27075.6386C3.29797 11.2836 3 11.677 3 12.125V20c0 .5523.44772 1 1 1h2V10.5237Zm12 0 2.2707.6386c.4313.1213.7293.5147.7293.9627V20c0 .5523-.4477 1-1 1h-2V10.5237Z" />
                                <path fill-rule="evenodd"
                                    d="M12.5547 3.16795c-.3359-.22393-.7735-.22393-1.1094 0l-6.00002 4c-.45952.30635-.5837.92722-.27735 1.38675.30636.45953.92723.5837 1.38675.27735L8 7.86853V21h8V7.86853l1.4453.96352c.0143.00957.0289.01873.0435.02746.1597.09514.3364.14076.5112.1406.3228-.0003.6395-.15664.832-.44541.3064-.45953.1822-1.0804-.2773-1.38675l-6-4ZM10 12c0-.5523.4477-1 1-1h2c.5523 0 1 .4477 1 1s-.4477 1-1 1h-2c-.5523 0-1-.4477-1-1Zm1-4c-.5523 0-1 .44772-1 1s.4477 1 1 1h2c.5523 0 1-.44772 1-1s-.4477-1-1-1h-2Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-1 text-base text-gray-500 dark:text-white">Major</h5>
                            <p class="font-bold text-gray-700 dark:text-gray-400">5</p>
                        </div>
                    </div>
    
                    <!-- Card 3 (New Users) -->
                    <div
                        class="border border-gray-300 rounded-lg shadow-md h-28 flex items-center p-6 bg-white dark:bg-gray-800">
                        <div class="mr-4 text-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14">
                                <path
                                    d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="mb-1 text-base text-gray-500 dark:text-white">New User</h5>
                            <p class="font-bold text-gray-700 dark:text-gray-400">10</p>
                        </div>
                    </div>
                </div>
    
    
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Daftar Pengguna Terbaru</h1>
    
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nik</th>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3">Role</th>
                                    <th scope="col" class="px-6 py-3">Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <td class="px-6 py-3">1</td>
                                    <td class="px-6 py-3">1234567890</td>
                                    <td class="px-6 py-3 ">John Doe</td>
                                    <td class="px-6 py-3">Admin</td>
                                    <td class="px-6 py-3">2025-03-18</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <td class="px-6 py-3">2</td>
                                    <td class="px-6 py-3">0987654321</td>
                                    <td class="px-6 py-3">Jane Smith</td>
                                    <td class="px-6 py-3">User</td>
                                    <td class="px-6 py-3">2025-03-17</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <td class="px-6 py-3">3</td>
                                    <td class="px-6 py-3">1122334455</td>
                                    <td class="px-6 py-3 ">Alice Johnson</td>
                                    <td class="px-6 py-3">User</td>
                                    <td class="px-6 py-3">2025-03-16</td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <td class="px-6 py-3">4</td>
                                    <td class="px-6 py-3">6677889900</td>
                                    <td class="px-6 py-3 ">Michael Brown</td>
                                    <td class="px-6 py-3">User</td>
                                    <td class="px-6 py-3">2025-03-15</td>
                                </tr>
                                <tr class="bg-white dark:bg-gray-800">
                                    <td class="px-6 py-3">5</td>
                                    <td class="px-6 py-3">5544332211</td>
                                    <td class="px-6 py-3 ">Emma Wilson</td>
                                    <td class="px-6 py-3">User</td>
                                    <td class="px-6 py-3">2025-03-14</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          
        </section>
    </main>
@endsection
