<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = MataKuliah::query();

        if (request()->has('search')) {
            $search = request('search');
            $courses = $courses->where(function ($query) use ($search) {
                $query->where('kode', 'like', '%' . $search . '%')
                        ->orWhere('nama', 'like', '%' . $search . '%');
            });
        }

        if(Auth::user()->id_role == 1){
            if(request()->has('jurusan')){
                $search = request('jurusan');
                if($search != 'All'){
                    $courses = $courses->where(function ($query) use ($search) {
                               $query->where('id_jurusan', 'like', '%' . $search . '%');
                    });
                }
            }

            $majors = Jurusan::all();

            return view('admin.course')
            ->with('courses', $courses->paginate(5))
            ->with('majors', $majors);

        } else {

            return view('mo.course')
            ->with('courses', $courses->where('id_jurusan', Auth::user()->id_jurusan)->paginate(5));
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->id_role == 1){
            $validateData = validator($request->all(),[
                'kode' => 'required|string|max:12|unique:mata_kuliah,kode',
                'nama' => 'required|string|max:100|unique:mata_kuliah,nama',
                'sks' => 'required|int|min:1',
                'id_jurusan' => 'required|int|min:1',
            ])->validate();
    
            $mata_kuliah = new MataKuliah($validateData);
            $mata_kuliah->save();
    
            session()->flash('success', 'Mata Kuliah berhasil ditambahkan');
    
            return redirect()->route('admin-course');
        } else {

            $validateData = validator($request->all(),[
                'kode' => 'required|string|max:12|unique:mata_kuliah,kode',
                'nama' => 'required|string|max:100|unique:mata_kuliah,nama',
                'sks' => 'required|int|min:1',
            ])->validate();
    
            $mata_kuliah = new MataKuliah($validateData);
            $mata_kuliah->id_jurusan = Auth::user()->id_jurusan;
            $mata_kuliah->save();
    
            session()->flash('success', 'Mata Kuliah berhasil ditambahkan');
    
            return redirect()->route('mo-course');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $validateData = validator($request->all(),[
            'kode' => ['required','string','max:12', Rule::unique('mata_kuliah','kode')->ignore($mataKuliah->kode, 'kode')],
            'nama' => ['required','string','max:100', Rule::unique('mata_kuliah','nama')->ignore($mataKuliah->nama, 'nama')],
            'sks' => 'required|int|min:1',
        ])->validate();

        $mataKuliah->nama = $validateData['nama'];
        $mataKuliah->sks = $validateData['sks'];
        $mataKuliah->save();

        session()->flash('success', 'Mata Kuliah berhasil diupdate');

        return redirect()->route('mo-course');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $mataKuliah)
    {
        //
    }
}
