@extends('layouts.app')

@section('content')
    <div class="flex h-screen">

        <!-- Main Content -->
        <main class="flex-1 p-6 mt-5 mb-5">
            <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">Ajukan Surat</h1>

            <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto mb-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Pilih Jenis Surat</h2>
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" onclick="updateForm('Surat Keterangan Mahasiswa Aktif', this)"
                        class="px-4 py-2 bg-cyan-800 text-white rounded-lg hover:bg-cyan-700 transition">Surat Keterangan
                        Mahasiswa Aktif</button>
                    <button type="button" onclick="updateForm('Surat Pengantar Tugas MK', this)"
                        class="px-4 py-2 bg-cyan-800 text-white rounded-lg hover:bg-cyan-700 transition">Surat Pengantar
                        Tugas MK</button>
                    <button type="button" onclick="updateForm('Surat Keterangan Lulus', this)"
                        class="px-4 py-2 bg-cyan-800 text-white rounded-lg hover:bg-cyan-700 transition">Surat
                        Keterangan Lulus</button>
                    <button type="button" onclick="updateForm('Laporan Hasil Studi', this)"
                        class="px-4 py-2 bg-cyan-800 text-white rounded-lg hover:bg-cyan-700 transition">Laporan Hasil
                        Studi</button>
                </div>
            </div>

            <form class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto" method="POST"
                action="{{ route('mahasiswa-store') }}">
                @csrf
                <h2 id="selectedSuratType" class="text-xl font-semibold mb-4 text-gray-700">Surat Keterangan Mahasiswa</h2>
                <input type="hidden" name="jenis_surat" id="jenisSuratInput" value="Surat Keterangan Mahasiswa Aktif">
                <div id="extraFields"></div>
                <button type="submit"
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
            document.getElementById("jenisSuratInput").value = suratType;

            if (suratType === "Surat Keterangan Mahasiswa Aktif") {
                extraFields.innerHTML = `
                <div class='grid grid-cols-2 gap-4 mb-4'>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Nama Lengkap</label>
                        <input type='text' name='nama_lengkap' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan Nama Lengkap' value='{{ Auth::user()->nama }}' required autofocus>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>NRP</label>
                        <input type='text' name='nrp' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan NRP' value='{{ Auth::user()->nik }}' required>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Periode</label>
                        <input type='text' name='periode' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Periode' value='{{ Auth::user()->periode }}' required>
                    </div>
                    <div>
                        <label class='block text-sm font-medium text-gray-900 mb-1'>Alamat</label>
                        <input type='text' name='alamat' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Alamat' required>
                    </div>
                </div>
                <div>
                    <label class='block text-sm font-medium text-gray-900 mb-1'>Keperluan Pengajuan</label>
                    <textarea name='keperluan_pengajuan' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' rows='4' placeholder='Jelaskan keperluan pengajuan...' required></textarea>
                </div>
                `;
            } else if (suratType === "Surat Pengantar Tugas MK") {
                extraFields.innerHTML = `
                <div class='grid grid-cols-2 gap-4 mb-4'>
                    <input type="text" name="nrp" id="nrp" value="{{ Auth::user()->nik }}" hidden>
                    <div>
                        <label for='tujuan_instansi' class='block text-sm font-medium text-gray-900 mb-1'>Surat Ditujukan Kepada:</label>
                        <input type='text' name='tujuan_instansi' id='tujuan_instansi' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Informasi lengkap Perusahaan' required>
                    </div>
                    <div>
                        <label for='periode' class='block text-sm font-medium text-gray-900 mb-1'>Periode</label>
                        <input type='text' name='periode' id='periode' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Periode perkuliahan' value='{{ Auth::user()->periode }}' required>
                    </div>
                    <div>
                        <label for='kode_mk' class='block text-sm font-medium text-gray-900 mb-1'>Mata Kuliah</label>
                        <select name='kode_mk' id='kode_mk' class='block w-full px-3 py-2 border border-gray-300 rounded-lg' required>
                            <option value='' selected>Pilih Mata Kuliah</option>
                            @foreach ($courses as $course)
                                <option value={{ $course->kode }}>{{ $course->kode }} - {{ $course->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for='data_mahasiswa' class='block text-sm font-medium text-gray-900 mb-1'>Data Mahasiswa</label>
                        <input type='text' name='data_mahasiswa' id='data_mahasiswa' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Mhs1 - 15720xx; dst' required>
                    </div>
                    <div>
                        <label for='tujuan' class='block text-sm font-medium text-gray-900 mb-1'>Tujuan</label>
                        <input type='text' name='tujuan' id='tujuan' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan Tujuan' required>
                    </div>
                    <div>
                        <label for='topik' class='block text-sm font-medium text-gray-900 mb-1'>Topik</label>
                        <input type='text' name='topik' id='topik' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan Topik' required>
                    </div>
                </div>
                `;
            } else if (suratType === "Surat Keterangan Lulus") {
                extraFields.innerHTML = `
                <div class='grid grid-cols-2 gap-4 mb-4'>
                    <div>
                        <label for='nama_lengkap' class='block text-sm font-medium text-gray-900 mb-1'>Nama Lengkap</label>
                        <input type='text' name='nama_lengkap' id='nama_lengkap' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan Nama Lengkap' value='{{ Auth::user()->nama }}' required>
                    </div>
                    <div>
                        <label for='nrp' class='block text-sm font-medium text-gray-900 mb-1'>NRP</label>
                        <input type='text' name='nrp' id='nrp' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan NRP' value='{{ Auth::user()->nik }}' required>
                    </div>
                </div>
                <div>
                        <label for='tanggal_lulus' class='block text-sm font-medium text-gray-900 mb-1'>Tanggal Kelulusan</label>
                        <input type='date' name='tanggal_lulus' id='tanggal_lulus' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='dd-mm-yyyy' required>
                    </div>
                `;
            } else if (suratType === "Laporan Hasil Studi") {
                extraFields.innerHTML = `
                <div class='grid grid-cols-2 gap-4 mb-4'>
                    <div>
                        <label for='nama_lengkap' class='block text-sm font-medium text-gray-900 mb-1'>Nama Lengkap</label>
                        <input type='text' name='nama_lengkap' id='nama_lengkap' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan Nama Lengkap' value='{{ Auth::user()->nama }}' required>
                    </div>
                    <div>
                        <label for='nrp' class='block text-sm font-medium text-gray-900 mb-1'>NRP</label>
                        <input type='text' name='nrp' id='nrp' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' value='{{ Auth::user()->nik }}' placeholder='Masukkan NRP' required>
                    </div>
                </div>
                <div>
                    <label for='keperluan_pembuatan' class='block text-sm font-medium text-gray-900 mb-1'>Keperluan Pembuatan LHS</label>
                    <input type='text' name='keperluan_pembuatan' id='keperluan_pembuatan' class='block w-full px-3 py-2 border border-gray-300 rounded-lg placeholder:text-gray-400' placeholder='Masukkan keperluan...' required>
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
