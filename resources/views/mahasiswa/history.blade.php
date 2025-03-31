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
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <div class="flex items-center space-x-3 w-full md:w-auto">
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
                            @foreach ($submits as $submit)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $submit->jenis_surat }}</th>
                                    <td class="px-4 py-3">{{ $submit->tanggal_pengajuan }}</td>
                                    <td class="px-4 py-3">{{ $submit->status }}</td>
                                    <td class="px-4 py-3">
                                        @if ($submit->status == 'Selesai')
                                            <a href="{{ route('mahasiswa-download-letter', $submit->file_surat) }}">
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
                                    </td>
                                </tr>

                                <!-- Main modal -->
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
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li>
                            <a href="#"
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page"
                                class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection
