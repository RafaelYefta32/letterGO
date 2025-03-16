<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\Jurusan;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mo.course')
        ->with('courses', MataKuliah::all())
        ->with('majors',Jurusan::all());
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
        $validateData = validator($request->all(),[
            'kode' => 'required|string|max:12',
            'nama' => 'required|string|max:100',
            'sks' => 'required|int|min:1',
            'id_jurusan' => 'required|string'
        ])->validate();

        $mata_kuliah = new MataKuliah($validateData);
        $mata_kuliah->save();

        session()->flash('success', 'Mata Kuliah berhasil ditambahkan');

        return redirect()->route('mo-course');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $mataKuliah)
    {
        //
    }
}
