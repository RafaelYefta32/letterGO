<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $submit = Jurusan::query();
        if (request()->has('search')) {
            $search = request('search');
            $submit = $submit->where(function ($query) use ($search) {
                $query->where('kode', 'like', '%' . $search . '%')
                      ->orWhere('nama', 'like', '%' . $search . '%');
            });
        }

        return view('admin.major')->with('majors',$submit->paginate(5));
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
        $validateData = validator($request->all(), [
            'kode' => 'required|string|max:2|unique:jurusan,kode',
            'nama' => 'required|string|max:18|unique:jurusan,nama'
        ])->validate();

        $jurusan = new Jurusan($validateData);
        $jurusan->save();
        
        session()->flash('success', 'Jurusan berhasil ditambahkan!');

        return redirect()->route('admin-major');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validateData = validator($request->all(), [
            'kode' => ['required','string','max:2',Rule::unique('jurusan', 'kode')->ignore($jurusan->kode,'kode')],
            'nama' => ['required','string','max:18',Rule::unique('jurusan', 'nama')->ignore($jurusan->nama,'nama')]
        ])->validate();

        $jurusan->nama = $validateData['nama'];
        $jurusan->save();
        
        session()->flash('success', 'Jurusan berhasil diupdate!');

        return redirect()->route('admin-major');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        //
    }
}
