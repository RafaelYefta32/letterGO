<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        return view('admin.dashboard')
            ->with('latestUserList', User::latest()->take(5)->get())
            ->with('totalNewUser', User::whereYear('created_at', date('Y'))->count())
            ->with('totalUser', User::count())
            ->with('totalMajor', MataKuliah::count());
    }

    public function indexMo()
    {
        return view('mo.dashboard')
            ->with('totalStudent', User::where('id_role', 4)->where('id_jurusan', Auth::user()->id_jurusan)->count())
            ->with('totalMataKuliah', MataKuliah::where('id_jurusan', Auth::user()->id_jurusan)->count())
            ->with('totalLetter', Pengajuan::where('status', 'Disetujui')
                ->whereHas('mahasiswa', function ($query) {
                    $query->where('id_jurusan', Auth::user()->id_jurusan);
                })->count())
                ->with('totalLetterMA', Pengajuan::where('jenis_surat', 'Surat Keterangan Mahasiswa Aktif')
                ->whereHas('mahasiswa', function ($query) {
                    $query->where('id_jurusan', Auth::user()->id_jurusan);
                })->count())
                ->with('totalLetterKL', Pengajuan::where('jenis_surat', 'Surat Keterangan Lulus')
                ->whereHas('mahasiswa', function ($query) {
                    $query->where('id_jurusan', Auth::user()->id_jurusan);
                })->count())
                ->with('totalLetterTMK', Pengajuan::where('jenis_surat', 'Surat Pengantar Tugas MK')
                ->whereHas('mahasiswa', function ($query) {
                    $query->where('id_jurusan', Auth::user()->id_jurusan);
                })->count())
                ->with('totalLetterHS', Pengajuan::where('jenis_surat', 'Laporan Hasil Studi')
                ->whereHas('mahasiswa', function ($query) {
                    $query->where('id_jurusan', Auth::user()->id_jurusan);
                })->count())
                ->with('latestLetterList', Pengajuan::whereHas('mahasiswa', function ($query) {
                        $query->where('id_jurusan', Auth::user()->id_jurusan);
                    })->latest('tanggal_persetujuan')->take(5)->get())
                ->with('latestStudentList', User::where('id_jurusan', Auth::user()->id_jurusan)->latest()->take(5)->get());
    }

    public function indexKaprodi() {
        return view('kaprodi.dashboard')
            ->with('totalSuratMenunggu', Pengajuan::where('status','Menunggu Persetujuan')->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratDisetujui', Pengajuan::where('status','Disetujui')->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratDitolak', Pengajuan::where('status','Ditolak')->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count() )
            ->with('totalLetterMA', Pengajuan::where('jenis_surat', 'Surat Keterangan Mahasiswa Aktif')
            ->whereHas('mahasiswa', function ($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalLetterKL', Pengajuan::where('jenis_surat', 'Surat Keterangan Lulus')
            ->whereHas('mahasiswa', function ($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalLetterTMK', Pengajuan::where('jenis_surat', 'Surat Pengantar Tugas MK')
            ->whereHas('mahasiswa', function ($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalLetterHS', Pengajuan::where('jenis_surat', 'Laporan Hasil Studi')
            ->whereHas('mahasiswa', function ($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratJan', Pengajuan::whereMonth('tanggal_pengajuan', 1)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratFeb', Pengajuan::whereMonth('tanggal_pengajuan', 2)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratMar', Pengajuan::whereMonth('tanggal_pengajuan', 3)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratApr', Pengajuan::whereMonth('tanggal_pengajuan', 4)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratMay', Pengajuan::whereMonth('tanggal_pengajuan', 5)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratJun', Pengajuan::whereMonth('tanggal_pengajuan', 6)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratJul', Pengajuan::whereMonth('tanggal_pengajuan', 7)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratAug', Pengajuan::whereMonth('tanggal_pengajuan', 8)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratSep', Pengajuan::whereMonth('tanggal_pengajuan', 9)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratOkt', Pengajuan::whereMonth('tanggal_pengajuan', 10)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratNov', Pengajuan::whereMonth('tanggal_pengajuan', 11)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('totalSuratDes', Pengajuan::whereMonth('tanggal_pengajuan', 12)->whereYear('tanggal_pengajuan', date('Y'))->whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->count())
            ->with('latestLetterList', Pengajuan::whereHas('mahasiswa', function($query) {
                $query->where('id_jurusan', Auth::user()->id_jurusan);
            })->latest('tanggal_pengajuan')->take(5)->get());

    }
}
