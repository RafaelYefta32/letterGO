@extends('layouts.app')

@section('content')
    <section class="bg-gray-50 p-3 sm:p-5 mt-5 pt-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">

                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" method="POST" action="{{ route('mahasiswa-history') }}">
                            @csrf
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <input type="text" id="simple-search" name='search'
                                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-l-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 placeholder-gray-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search by jenis surat or status" autocomplete="off" required>
                            </div>
                            <button type="submit"
                                class="p-2 text-sm font-medium text-white bg-cyan-700 rounded-r-lg hover:bg-cyan-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Submit
                            </button>
                        </form>
                    </div>
                    <div
                        class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                        <form class="flex items-center w-full space-x-3 md:w-auto">
                            <select name="status" onchange="this.form.submit()"
                                class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-gray-50 border border-gray-300 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-gray-700 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-600 dark:bg-gray-700 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-600">
                                <option value="" disabled selected>Status</option>
                                <option value="All">All</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Menunggu Persetujuan">Menunggu Persetujuan</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </form>
                        <a href="{{ route('mahasiswa-submit') }}">
                            <button id="addLetterButton"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-white bg-cyan-700 rounded-lg hover:bg-cyan-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">
                                <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" />
                                </svg>
                                Submit New
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            {{-- table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">Jenis Surat</th>
                            <th scope="col" class="px-4 py-3">Tanggal Pengajuan</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($submits->isEmpty())
                            <tr>
                                <td colspan="6"
                                    class="px-4 py-5 text-center text-base text-gray-600 dark:text-gray-400 font-bold">
                                    @if (request('status') == null)
                                        Tidak ada data pengajuan surat.
                                    @else
                                        Tidak ada data pengajuan surat yang {{ request('status') }}.
                                    @endif
                                </td>
                            </tr>
                        @else
                            @foreach ($submits as $submit)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $submit->jenis_surat }}</th>
                                    <td class="px-4 py-3">{{ $submit->tanggal_pengajuan }}</td>
                                    <td class="px-4 py-3">{{ $submit->status }}</td>
                                    <td class="px-4 py-3">
                                        @if ($submit->status == 'Selesai')
                                            <a href="{{ route('download-letter', $submit->file_surat) }}">
                                                <button type="button"
                                                    class="text-white bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Download</button>
                                            </a>
                                        @else
                                            <button type="button" disabled
                                                class="text-white bg-gray-400 cursor-not-allowed font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2">Download</button>
                                        @endif
                                        <button type="button"
                                            class="py-2 px-3 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                            id="detailPengajuan" data-modal-target="detail{{ $submit->id }}"
                                            data-modal-toggle="detail{{ $submit->id }}">Detail</button>
                                        @if ($submit->status == 'Menunggu Persetujuan')
                                            <button type="button"
                                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                                data-modal-target="delete{{ $submit->id }}"
                                                data-modal-toggle="delete{{ $submit->id }}">Cancel</button>
                                        @else
                                            <button type="button" disabled
                                                class="text-white bg-gray-400 cursor-not-allowed font-medium rounded-lg text-sm px-3 py-2 me-2 mb-2">Cancel</button>
                                        @endif

                                    </td>
                                </tr>

                                <!-- Detail modal -->
                                <div id="detail{{ $submit->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                                        <!-- Modal content -->
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <!-- Modal header -->
                                            <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                                                <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                                                    <h3 class="font-bold ">
                                                        {{ $submit->jenis_surat }}
                                                    </h3>
                                                    <p
                                                        class="font-semibold text-base {{ $submit->status == 'Disetujui' ? 'text-blue-500' : ($submit->status == 'Menunggu Persetujuan' ? 'text-yellow-500' : ($submit->status == 'Selesai' ? 'text-green-500' : 'text-red-500')) }}">
                                                        {{ $submit->status }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-toggle="detail{{ $submit->id }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <dl>
                                                <h3 class="font-bold text-center mb-2">
                                                    Detail Surat
                                                </h3>
                                                @if ($submit->jenis_surat == 'Surat Keterangan Lulus')
                                                    @php
                                                        $skl = $suratKL->where('id_pengajuan', $submit->id)->first();
                                                    @endphp
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Nama Lengkap</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $skl->nama_lengkap }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        NRP</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $skl->nrp }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Tanggal Lulus</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $skl->tanggal_lulus }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Tanggal Pengajuan Surat</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $skl->pengajuan->tanggal_pengajuan }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Keterangan</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        @if ($submit->status == 'Menunggu Persetujuan')
                                                            Menunggu Surat Disetujui oleh Kepala Program Studi
                                                        @elseif($submit->status == 'Disetujui')
                                                            Surat Telah Disetujui oleh Kepala Program Studi, Menunggu
                                                            Pembuatan Surat
                                                        @elseif($submit->status == 'Ditolak')
                                                            Pengajuan Surat Ditolak oleh Kepala Program Studi
                                                        @elseif($submit->status == 'Selesai')
                                                            Proses Pengajuan Telah Berhasil, Silahkan Men-download Surat.
                                                        @endif
                                                    </dd>
                                                @elseif($submit->jenis_surat == 'Surat Pengantar Tugas MK')
                                                    @php
                                                        $stmk = $suratTMK->where('id_pengajuan', $submit->id)->first();
                                                    @endphp
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Tujuan Instansi</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $stmk->tujuan_instansi }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Data mahasiswa</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $stmk->data_mahasiswa }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Mata Kuliah</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $stmk->mataKuliah->kode }} - {{ $stmk->mataKuliah->nama }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Tujuan</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $stmk->tujuan }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Topik</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $stmk->topik }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Tanggal Pengajuan Surat</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $stmk->pengajuan->tanggal_pengajuan }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Keterangan</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        @if ($submit->status == 'Menunggu Persetujuan')
                                                            Menunggu Surat Disetujui oleh Kepala Program Studi
                                                        @elseif($submit->status == 'Disetujui')
                                                            Surat Telah Disetujui oleh Kepala Program Studi, Menunggu
                                                            Pembuatan Surat
                                                        @elseif($submit->status == 'Ditolak')
                                                            Pengajuan Surat Ditolak oleh Kepala Program Studi
                                                        @elseif($submit->status == 'Selesai')
                                                            Proses Pengajuan Telah Berhasil, Silahkan Men-download Surat.
                                                        @endif
                                                    </dd>
                                                @elseif($submit->jenis_surat == 'Surat Keterangan Mahasiswa Aktif')
                                                    @php
                                                        $sma = $suratMA->where('id_pengajuan', $submit->id)->first();
                                                    @endphp
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Nama Lengkap</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $sma->nama_lengkap }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        NRP</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $sma->nrp }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Periode</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $sma->periode }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Alamat</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $sma->alamat }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Keperluan Pengajuan</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $sma->keperluan_pengajuan }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Tanggal Pengajuan Surat</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $sma->pengajuan->tanggal_pengajuan }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Keterangan</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        @if ($submit->status == 'Menunggu Persetujuan')
                                                            Menunggu Surat Disetujui oleh Kepala Program Studi
                                                        @elseif($submit->status == 'Disetujui')
                                                            Surat Telah Disetujui oleh Kepala Program Studi, Menunggu
                                                            Pembuatan Surat
                                                        @elseif($submit->status == 'Ditolak')
                                                            Pengajuan Surat Ditolak oleh Kepala Program Studi
                                                        @elseif($submit->status == 'Selesai')
                                                            Proses Pengajuan Telah Berhasil, Silahkan Men-download Surat.
                                                        @endif
                                                    </dd>
                                                @elseif($submit->jenis_surat == 'Laporan Hasil Studi')
                                                    @php
                                                        $lhs = $laporanHS->where('id_pengajuan', $submit->id)->first();
                                                    @endphp
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Nama Lengkap</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $lhs->nama_lengkap }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        NRP</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $lhs->nrp }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Keperluan Pembuatan</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $lhs->keperluan_pembuatan }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Tanggal Pengajuan Surat</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        {{ $lhs->pengajuan->tanggal_pengajuan }}</dd>
                                                    <dt
                                                        class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                        Keterangan</dt>
                                                    <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                        @if ($submit->status == 'Menunggu Persetujuan')
                                                            Menunggu Surat Disetujui oleh Kepala Program Studi
                                                        @elseif($submit->status == 'Disetujui')
                                                            Surat Telah Disetujui oleh Kepala Program Studi, Menunggu
                                                            Pembuatan Surat
                                                        @elseif($submit->status == 'Ditolak')
                                                            Pengajuan Surat Ditolak oleh Kepala Program Studi
                                                        @elseif($submit->status == 'Selesai')
                                                            Proses Pengajuan Telah Berhasil, Silahkan Men-download Surat.
                                                        @endif
                                                    </dd>
                                                @endif
                                                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                    DIsetujui Oleh</dt>
                                                <dd class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                    @if ($submit->status == 'Menunggu Persetujuan')
                                                        -
                                                    @else
                                                        {{ $submit->kaprodi_nik }} - {{ $submit->kaprodi->nama }}
                                                    @endif
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete modal -->
                                <div id="delete{{ $submit->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <!-- Modal content -->
                                        <div
                                            class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <button type="button"
                                                class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="delete{{ $submit->id }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah Anda Yakin Ingin
                                                Membatalkan Pengajuan?</p>
                                            <div class="flex justify-center items-center space-x-4">
                                                <button data-modal-toggle="delete{{ $submit->id }}" type="button"
                                                    class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    No, cancel
                                                </button>
                                                <form action="{{ route('mahasiswa-cancel', [$submit->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                        Yes, I'm sure
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{ $submits->links() }}
        </div>
    </section>
@endsection
