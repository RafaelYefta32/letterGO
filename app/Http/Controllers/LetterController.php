<?php

namespace App\Http\Controllers;

use App\Models\SuratKL;
use App\Models\SuratMA;
use App\Models\SuratTMK;
use App\Models\LaporanHS;
use App\Models\Pengajuan;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $submit = Pengajuan::where('nrp', Auth::user()->nik)->get();
        if (Auth::user()->role->nama == 'Mahasiswa'){
            $submit = Pengajuan::query();
            if (request()->has('search')) {
                $search = request('search');
                $submit = $submit->where(function ($query) use ($search) {
                    $query->where('jenis_surat', 'like', '%' . $search . '%')
                          ->orWhere('status', 'like', '%' . $search . '%');
                });
            }
    
            return view('mahasiswa.history')
                ->with('submits', $submit->where('nrp', Auth::user()->nik)->get())
                ->with('suratKL', SuratKL::all())
                ->with('suratMA', SuratMA::all())
                ->with('suratTMK', SuratTMK::all())
                ->with('laporanHS', LaporanHS::all());
        } else if (Auth::user()->role->nama == 'Kepala Program Studi'){
            
            $submission = Pengajuan::all();
            return view('kaprodi.pengajuan')
                ->with('submissions', $submission->filter(function ($item) {
                    return $item->mahasiswa->id_jurusan == Auth::user()->id_jurusan;
                }))
                ->with('suratKL', SuratKL::all())
                ->with('suratMA', SuratMA::all())
                ->with('suratTMK', SuratTMK::all())
                ->with('laporanHS', LaporanHS::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('mahasiswa.submit')
            ->with('courses', MataKuliah::where('id_jurusan', Auth::user()->id_jurusan)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validateData = validator($request->all(), [
            'nrp' => 'required|max:7',
            'jenis_surat' => 'required|string|max:35',
        ])->validate();

        $pengajuan = new Pengajuan($validateData);
        $pengajuan->status = "Menunggu Persetujuan";
        $pengajuan->tanggal_pengajuan = now();
        $pengajuan->save();

        if($request->jenis_surat == "Surat Keterangan Mahasiswa Aktif"){
            $validateSKMA = validator($request->all(), [
                'nama_lengkap' => 'required|string|max:100',
                'nrp' => 'required|string|max:7',
                'periode' => 'required|string|max:20',
                'alamat' => 'required|string|max:45',
                'keperluan_pengajuan' => 'required|string|max:255'
            ])->validate();

            $skma = new SuratMA($validateSKMA);
            $skma->id_pengajuan = $pengajuan->id;
            $skma->save();

        } else if ($request->jenis_surat == "Surat Keterangan Lulus"){
            $validateSKL = validator($request->all(), [
                'nama_lengkap' => 'required|string|max:100',
                'nrp' => 'required|string|max:7',
                'tanggal_lulus' => 'required',
            ])->validate();

            $skl = new SuratKL($validateSKL);
            $skl->id_pengajuan = $pengajuan->id;
            $skl->save();

        } else if ($request->jenis_surat == "Surat Pengantar Tugas MK"){
            $validateSKL = validator($request->all(), [
                'tujuan_instansi' => 'required|string|max:255',
                'periode' => 'required|string|max:20',
                'data_mahasiswa' => 'required|string|max:255',
                'tujuan' => 'required|string|max:255',
                'topik' => 'required|string|max:255',
            ])->validate();

            $stmk = new SuratTMK($validateSKL);
            $stmk->id_pengajuan = $pengajuan->id;
            $stmk->kode_mk = $request->kode_mk;
            $stmk->save();
        } else if ($request->jenis_surat == "Laporan Hasil Studi"){
            $validateLHS = validator($request->all(), [
                'nama_lengkap' => 'required|string|max:20',
                'nrp' => 'required|string|max:7',
                'keperluan_pembuatan' => 'required|string|max:255',
            ])->validate();

            $lhs = new LaporanHS($validateLHS);
            $lhs->id_pengajuan = $pengajuan->id;
            $lhs->save();
        } 

        return redirect(route('mahasiswa-history'))
            ->with('success', 'Berhasil Mengajukan Surat');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratTMK $suratTMK)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratTMK $suratTMK)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratTMK $suratTMK)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratTMK $suratTMK)
    {
        //
    }

    public function accept(Pengajuan $pengajuan) {
        $pengajuan->status = 'Disetujui';
        $pengajuan->tanggal_persetujuan = now();
        $pengajuan->kaprodi_nik = Auth::user()->nik;
        $pengajuan->save();
        return redirect()->route('kaprodi-submissions')->with('success', 'Surat telah disetujui');
    }
    
    public function reject(Pengajuan $pengajuan) {
        $pengajuan->status = 'Ditolak';
        $pengajuan->kaprodi_nik = Auth::user()->nik;
        $pengajuan->save();
        return redirect()->route('kaprodi-submissions')->with('reject', 'Surat telah ditolak');
    }
}
