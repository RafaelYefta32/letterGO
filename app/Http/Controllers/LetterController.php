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
use File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Events\LetterUpdate;
use Twilio\Rest\Client;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\LetterMail;

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
            } else if (request()->has('status')){
                $search = request('status');
                if($search != "All"){
                    $submit = $submit->where(function ($query) use ($search) {
                        $query->where('status', 'like', '%' . $search . '%');
                    });
                }
            }
    
            return view('mahasiswa.history')
                ->with('submits', $submit->where('nrp', Auth::user()->nik)->paginate(5))
                ->with('suratKL', SuratKL::all())
                ->with('suratMA', SuratMA::all())
                ->with('suratTMK', SuratTMK::all())
                ->with('laporanHS', LaporanHS::all());
        } else if (Auth::user()->role->nama == 'Kepala Program Studi'){

            $submit = Pengajuan::query();
            if (request()->has('search')) {
                $search = request('search');
                $submit = $submit->where(function ($query) use ($search) {
                    $query->where('jenis_surat', 'like', '%' . $search . '%')
                          ->orWhere('nrp', 'like', '%' . $search . '%');
                });
            } else if (request()->has('status')){
                $search = request('status');
                if($search != "All"){
                    $submit = $submit->where(function ($query) use ($search) {
                        $query->where('status', 'like', '%' . $search . '%');
                    });
                }
            }

            return view('kaprodi.pengajuan')
                ->with('submissions', $submit->whereHas('mahasiswa', function ($query) {
                    $query->where('id_jurusan', Auth::user()->id_jurusan);
                })->paginate(5))
                ->with('suratKL', SuratKL::all())
                ->with('suratMA', SuratMA::all())
                ->with('suratTMK', SuratTMK::all())
                ->with('laporanHS', LaporanHS::all());
        } else if (Auth::user()->role->nama == 'Manager Operasional'){
            // dd(request()->search);
            $submit = Pengajuan::query();
            if (request()->has('search')) {
                $search = request('search');
                $submit = $submit->where(function ($query) use ($search) {
                    $query->where('jenis_surat', 'like', '%' . $search . '%')
                          ->orWhere('nrp', 'like', '%' . $search . '%');
                });
            } else if (request()->has('status')){
                $search = request('status');
                if($search != "All"){
                    $submit = $submit->where(function ($query) use ($search) {
                        $query->where('status', 'like', '%' . $search . '%');
                    });
                }

                return view('mo.letter')
                ->with('submissions', $submit->whereHas('mahasiswa', function ($query) {
                        $query->where('id_jurusan', Auth::user()->id_jurusan);
                    })->paginate(5))
                ->with('suratKL', SuratKL::all())
                ->with('suratMA', SuratMA::all())
                ->with('suratTMK', SuratTMK::all())
                ->with('laporanHS', LaporanHS::all());
                
            } else {
                return view('mo.letter')
                ->with('submissions', $submit->whereHas('mahasiswa', function ($query) {
                        $query->where('id_jurusan', Auth::user()->id_jurusan);
                    })->Where('status', 'Disetujui')->paginate(5))
                ->with('suratKL', SuratKL::all())
                ->with('suratMA', SuratMA::all())
                ->with('suratTMK', SuratTMK::all())
                ->with('laporanHS', LaporanHS::all());
            }

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
        $pengajuan->tanggal_pengajuan = now()->timezone('Asia/Jakarta');
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
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
        $pengajuan->status = $request->value;
        $pengajuan->tanggal_persetujuan = now()->timezone('Asia/Jakarta');
        $pengajuan->kaprodi_nik = Auth::user()->nik;
        $pengajuan->save();

        if($request->value == 'Disetujui'){

            return redirect()->route('kaprodi-submissions')->with('success', 'Surat telah disetujui');
        } else {
            return redirect()->route('kaprodi-submissions')->with('reject', 'Surat telah ditolak');
        }
    }

    public function uploadLetter(Request $request, Pengajuan $pengajuan){
        $validateData = validator($request->all(),[
            'title' => 'required|string|max:100',
            'file_input' => 'sometimes|file|mimes:pdf,docx,doc|max:10240',
        ])->validate();

        $file = $validateData['file_input'];
        $fileName = $validateData['title'] . '.' . $file->getClientOriginalExtension(); 

        // Check if the file already exists
        $filePath = storage_path('app/private/fileLetter') . '/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the old image
        } else {
            $file->storeAs('fileLetter', $fileName);
        }

        $pengajuan['file_surat'] = $fileName;
        $pengajuan['status'] = 'Selesai';
        $pengajuan['tanggal_upload'] = now()->timezone('Asia/Jakarta');
        $pengajuan['mo_nik'] = Auth::user()->nik;

        $pengajuan->save();

        // Kirim Notifikasi via Gmail
        Mail::to($pengajuan->mahasiswa->email)->send(new LetterMail($pengajuan));

        return redirect()->back()->with('success', 'File berhasil diupload');

    }

    public function downloadLetter($fileSurat){
        $fileName = $fileSurat;
        $filePath = Storage::disk('local')->path('fileLetter/' . $fileName);
        $content = file_get_contents($filePath);

        if (file_exists($filePath)) {
            return response($content)->withHeaders([
                'Content-Type' => mime_content_type($filePath),
            ]);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        // dd($pengajuan->jenis_surat);
        if ($pengajuan->jenis_surat == "Surat Keterangan Mahasiswa Aktif"){
            $surat = SuratMA::where('id_pengajuan', $pengajuan->id)->first();
            $surat->delete();
        } else if ($pengajuan->jenis_surat == "Surat Keterangan Lulus"){
            $surat = SuratKL::where('id_pengajuan', $pengajuan->id)->first();
            $surat->delete();
        } else if ($pengajuan->jenis_surat == "Surat Pengantar Tugas MK"){
            $surat = SuratTMK::where('id_pengajuan', $pengajuan->id)->first();
            $surat->delete();
        } else if ($pengajuan->jenis_surat == "Laporan Hasil Studi"){
            $surat = LaporanHS::where('id_pengajuan', $pengajuan->id)->first();
            $surat->delete();
        }
        $pengajuan->delete();
        return redirect(route('mahasiswa-history'))->with('success', 'Pengajuan berhasil dibatalkan');
    }

}
