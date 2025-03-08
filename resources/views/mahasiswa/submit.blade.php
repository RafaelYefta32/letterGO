@extends('layouts.app')

@section('content')
    <div class="flex h-screen">

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Ajukan Surat</h1>

            <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto mb-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Pilih Jenis Surat</h2>
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" onclick="updateForm('Surat Keterangan Mahasiswa Aktif', this)"
                        class="px-4 py-2 bg-cyan-800 text-white rounded-lg hover:bg-cyan-700 transition">Surat Keterangan
                        Mahasiswa Aktif</button>
                    <button type="button" onclick="updateForm('Surat Pengantar Tugas MK', this)"
                        class="px-4 py-2 bg-cyan-800 text-white rounded-lg hover:bg-cyan-700 transition">Surat Pengantar Tugas MK</button>
                    <button type="button" onclick="updateForm('Surat Keterangan Lulus', this)"
                        class="px-4 py-2 bg-cyan-800 text-white rounded-lg hover:bg-cyan-700 transition">Surat
                        Keterangan Lulus</button>
                    <button type="button" onclick="updateForm('Laporan Hasil Studi', this)"
                        class="px-4 py-2 bg-cyan-800 text-white rounded-lg hover:bg-cyan-700 transition">Laporan Hasil Studi</button>
                </div>
            </div>

            <form class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
                <h2 id="selectedSuratType" class="text-xl font-semibold mb-4 text-gray-700">Surat Keterangan Mahasiswa</h2>
                <div id="extraFields"></div>
                <button
                    class="w-full bg-cyan-800 text-white px-2 py-2 rounded-lg hover:bg-cyan-700 transition font-semibold mt-3">Kirim
                    Pengajuan
                </button>
            </form>
        </main>
    </div>
@endsection

@section('ExtraJS')
    <script>
        function updateForm(suratType, button) {
            let extraFields = document.getElementById("extraFields");
            let selectedSuratType = document.getElementById("selectedSuratType");
            selectedSuratType.innerText = suratType;
            extraFields.innerHTML = "";

            if (suratType === "Surat Keterangan Mahasiswa Aktif") {
                extraFields.innerHTML = `
                <div class='grid grid-cols-2 gap-4 mb-4'>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Nama Lengkap</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan Nama Lengkap'>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>NRP</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan NRP'>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Semester</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Semester yang ditempuh saat ini'>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Alamat</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Alamat'>
                    </div>
                </div>
                <div>
                    <label class='block text-sm font-medium text-gray-900 mb-1'>Keperluan Pengajuan</label>
                    <textarea class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' rows='4' placeholder='Jelaskan keperluan pengajuan...'></textarea>
                </div>
                `;
            } else if (suratType === "Surat Pengantar Tugas MK") {
                extraFields.innerHTML = `
                <div class='grid grid-cols-2 gap-4 mb-4'>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Surat Ditujukan Kepada:</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Informasi lengkap Perusahaan'>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Mata Kuliah</label>
                        <select class='block w-full px-3 py-2 border border-gray-300 rounded-lg'>
                            <option value=''>Pilih Mata Kuliah</option>
                            <option value='MK1'>Mata Kuliah 1</option>
                            <option value='MK2'>Mata Kuliah 2</option>
                            <option value='MK3'>Mata Kuliah 3</option>
                            <option value='MK4'>Mata Kuliah 4</option>
                        </select>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Semester</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Semester yang ditempuh saat ini'>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Data Mahasiswa</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Mhs1 - 15720xx; dst'>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Tujuan</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan Tujuan'>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Topik</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan Topik'>
                    </div>
                </div>
                `;
            } else if (suratType === "Surat Keterangan Lulus") {
                extraFields.innerHTML = `
                <div class='grid grid-cols-2 gap-4 mb-4'>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Nama Lengkap</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan Nama Lengkap'>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>NRP</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan NRP'>
                    </div>
                </div>
                <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Tanggal Kelulusan</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='dd-mm-YYY'>
                    </div>
                `;
            } else if (suratType === "Laporan Hasil Studi") {
                extraFields.innerHTML = `
                <div class='grid grid-cols-2 gap-4 mb-4'>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Nama Lengkap</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan Nama Lengkap'>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>NRP</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan NRP'>
                    </div>
                </div>
                <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Keperluajn Pembuatan LHS</label>
                        <input type='text' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan keperluan...'>
                    </div>
                `;
            }
        }

        // Set default form
        document.addEventListener("DOMContentLoaded", function() {
            updateForm('Surat Keterangan Mahasiswa Aktif');
        });
    </script>
@endsection
