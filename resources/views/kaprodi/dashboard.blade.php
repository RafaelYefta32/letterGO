@extends('kaprodi.layout')

@section('content')
    <div class="w-4/5 p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard Kaprodi</h1>

        <!-- Ringkasan Pengajuan Surat -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-cyan-500 text-white p-4 rounded shadow">
                <h2 class="text-lg font-bold">Menunggu Persetujuan</h2>
                <p class="text-2xl">5</p>
            </div>
            <div class="bg-green-500 text-white p-4 rounded shadow">
                <h2 class="text-lg font-bold">Disetujui</h2>
                <p class="text-2xl">10</p>
            </div>
            <div class="bg-red-500 text-white p-4 rounded shadow">
                <h2 class="text-lg font-bold">Ditolak</h2>
                <p class="text-2xl">2</p>
            </div>
        </div>

        <!-- Daftar Pengajuan Surat -->
        <table class="w-full border-collapse bg-white shadow-md rounded">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">Nama Mahasiswa</th>
                    <th class="border p-2">Jenis Surat</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="border p-2">Budi Santoso</td>
                    <td class="border p-2">Surat Aktif</td>
                    <td class="border p-2 text-yellow-500">Menunggu</td>
                    <td class="border p-2">
                        <button onclick="openModal('Budi Santoso', 'Surat Aktif')"
                            class="bg-cyan-500 text-white px-3 py-1 rounded">Detail</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
