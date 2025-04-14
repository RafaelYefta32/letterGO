@extends('layouts.layout')

@section('content')
    <main class="p-4 md:ml-64 h-auto pt-20">
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 mt-5">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->
                <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    <div
                        class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="simple-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 dark:bg-gray-700 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Search by nrp or jenis surat" autocomplete="off" name="search"
                                        required="">
                                </div>
                                <div>
                                    <button type="submit"
                                        class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-cyan-800 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-cyan-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                        autocomplete="off">Search</button>
                                </div>
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
                        </div>
                    </div>
                </div>

                {{-- table --}}
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 text-center mt-2">Tabel Pengajuan Surat
                </h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Jenis Surat</th>
                                <th scope="col" class="px-4 py-3">NRP</th>
                                <th scope="col" class="px-4 py-3">Nama Mahasiswa</th>
                                <th scope="col" class="px-4 py-3">Tanggal Pengajuan</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($submissions->isEmpty())
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
                                @foreach ($submissions as $submission)
                                    <tr class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $submission->jenis_surat }}
                                        </th>
                                        <td class="px-4 py-3">{{ $submission->nrp }}</td>
                                        <td class="px-4 py-3">{{ $submission->mahasiswa->nama }}</td>
                                        <td class="px-4 py-3">
                                            {{ \Carbon\Carbon::parse($submission->tanggal_persetujuan)->format('d-m-Y H:i') }}
                                        </td>
                                        <td class="px-4 py-3">{{ $submission->status }}</td>
                                        <td class="px-4 py-3 flex items-center justify-start">
                                            <button id="apple-imac-27-dropdown-button"
                                                data-dropdown-toggle="action{{ $submission->id }}"
                                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100 ml-2"
                                                type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                            <div id="action{{ $submission->id }}"
                                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                    aria-labelledby="apple-imac-27-dropdown-button">
                                                    <li>
                                                        <button id="updateButton"
                                                            data-modal-target="detail{{ $submission->id }}"
                                                            data-modal-toggle="detail{{ $submission->id }}"
                                                            class="block py-2 px-4 w-full text-left hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Detail</button>
                                                    </li>
                                                </ul>
                                                <div class="py-1">
                                                    @if ($submission->status != 'Selesai')
                                                        <a href="#"
                                                            class="block py-2 px-4 text-sm text-gray-700 bg-gray-300 cursor-not-allowed dark:bg-gray-600 dark:text-gray-400 opacity-50">Lihat</a>
                                                    @else
                                                        <a href="{{ route('download-letter', $submission->file_surat) }}"
                                                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Lihat</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Main modal -->
                                    <div id="detail{{ $submission->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div
                                                class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 max-h-screen overflow-y-auto">
                                                <!-- Modal header -->
                                                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                                                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                                                        <h3 class="font-semibold ">
                                                            Pengajuan Surat
                                                        </h3>
                                                        <p class="font-bold">
                                                            {{ $submission->jenis_surat }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-toggle="detail{{ $submission->id }}">
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
                                                    <dl>
                                                        <h3 class="font-bold text-center mb-2">
                                                            Detail Surat
                                                        </h3>
                                                        @if ($submission->jenis_surat == 'Surat Keterangan Lulus')
                                                            @php
                                                                $skl = $suratKL
                                                                    ->where('id_pengajuan', $submission->id)
                                                                    ->first();
                                                            @endphp
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Nama Lengkap</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $skl->nama_lengkap }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                NRP</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $skl->nrp }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Tanggal Lulus</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $skl->tanggal_lulus }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Tanggal Pengajuan Surat</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $skl->pengajuan->tanggal_pengajuan }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Status</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                <p
                                                                    class="font-semibold text-base {{ $submission->status == 'Disetujui' ? 'text-blue-500' : ($submission->status == 'Menunggu Persetujuan' ? 'text-yellow-500' : ($submission->status == 'Selesai' ? 'text-green-500' : 'text-red-500')) }}">
                                                                    {{ $submission->status }}
                                                                </p>
                                                            </dd>
                                                        @elseif($submission->jenis_surat == 'Surat Pengantar Tugas MK')
                                                            @php
                                                                $stmk = $suratTMK
                                                                    ->where('id_pengajuan', $submission->id)
                                                                    ->first();
                                                            @endphp
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Tujuan Instansi</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $stmk->tujuan_instansi }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Data mahasiswa</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $stmk->data_mahasiswa }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Mata Kuliah</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $stmk->mataKuliah->kode }} -
                                                                {{ $stmk->mataKuliah->nama }}
                                                            </dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Tujuan</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $stmk->tujuan }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Topik</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $stmk->topik }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Tanggal Pengajuan Surat</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $stmk->pengajuan->tanggal_pengajuan }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Status</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                <p
                                                                    class="font-semibold text-base {{ $submission->status == 'Disetujui' ? 'text-blue-500' : ($submission->status == 'Menunggu Persetujuan' ? 'text-yellow-500' : ($submission->status == 'Selesai' ? 'text-green-500' : 'text-red-500')) }}">
                                                                    {{ $submission->status }}
                                                                </p>
                                                            </dd>
                                                        @elseif($submission->jenis_surat == 'Surat Keterangan Mahasiswa Aktif')
                                                            @php
                                                                $sma = $suratMA
                                                                    ->where('id_pengajuan', $submission->id)
                                                                    ->first();
                                                            @endphp
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Nama Lengkap</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $sma->nama_lengkap }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                NRP</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $sma->nrp }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Periode</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $sma->periode }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Alamat</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $sma->alamat }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Keperluan Pengajuan</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $sma->keperluan_pengajuan }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Tanggal Pengajuan Surat</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $sma->pengajuan->tanggal_pengajuan }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Status</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                <p
                                                                    class="font-semibold text-base {{ $submission->status == 'Disetujui' ? 'text-blue-500' : ($submission->status == 'Menunggu Persetujuan' ? 'text-yellow-500' : ($submission->status == 'Selesai' ? 'text-green-500' : 'text-red-500')) }}">
                                                                    {{ $submission->status }}
                                                                </p>
                                                            </dd>
                                                        @elseif($submission->jenis_surat == 'Laporan Hasil Studi')
                                                            @php
                                                                $lhs = $laporanHS
                                                                    ->where('id_pengajuan', $submission->id)
                                                                    ->first();
                                                            @endphp
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Nama Lengkap</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $lhs->nama_lengkap }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                NRP</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $lhs->nrp }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Keperluan Pembuatan</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $lhs->keperluan_pembuatan }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Tanggal Pengajuan Surat</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                {{ $lhs->pengajuan->tanggal_pengajuan }}</dd>
                                                            <dt
                                                                class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                                                Status</dt>
                                                            <dd
                                                                class="mb-4 font-light text-gray-600 sm:mb-5 dark:text-gray-400">
                                                                <p
                                                                    class="font-semibold text-base {{ $submission->status == 'Disetujui' ? 'text-blue-500' : ($submission->status == 'Menunggu Persetujuan' ? 'text-yellow-500' : ($submission->status == 'Selesai' ? 'text-green-500' : 'text-red-500')) }}">
                                                                    {{ $submission->status }}
                                                                </p>
                                                            </dd>
                                                        @endif
                                                    </dl>
                                                </dl>
                                                <div class="flex justify-between items-center">
                                                    @if ($submission->status != 'Disetujui' && $submission->status != 'Ditolak' && $submission->status != 'Selesai')
                                                        <form
                                                            action="{{ route('kaprodi-submissions-update', [$submission->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="value" value="Disetujui">
                                                            <button type="submit"
                                                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Setuju</button>
                                                        </form>

                                                        <form
                                                            action="{{ route('kaprodi-submissions-update', [$submission->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="value" value="Ditolak">
                                                            <button type="submit"
                                                                class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                                Tolak
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button type="button" disabled
                                                            class="focus:outline-none text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-700 opacity-50 cursor-not-allowed">Setuju</button>

                                                        <button type="button" disabled
                                                            class="inline-flex items-center text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-400 dark:hover:bg-gray-500 dark:focus:ring-gray-700 opacity-50 cursor-not-allowed">
                                                            Tolak
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                {{ $submissions->links() }}
            </div>
        </section>
    </main>
@endsection
