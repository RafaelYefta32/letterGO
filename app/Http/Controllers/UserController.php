<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Jurusan;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAdmin()
    {
        $submit = User::query();
        if (request()->has('search')) {
            $search = request('search');
            $submit = $submit->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhereHas('role', function ($query) use ($search) {
                          $query->where('nama', 'like', '%' . $search . '%');
                      })
                      ->orWhereHas('jurusan', function ($query) use ($search) {
                          $query->where('nama', 'like', '%' . $search . '%');
                      });
            });
        }

        return view('admin.user')
        ->with('users', $submit->get())
        ->with('roles',Role::all())
        ->with('majors',Jurusan::all());
    }
    public function indexMo()
    {   
        $submit = User::query();
        if (request()->has('search')) {
            $search = request('search');
            $submit = $submit->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        return view('mo.students')
        ->with('students', $submit->where('id_role', 4)->where('id_jurusan', Auth::user()->id_jurusan)->get());

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
        if (Auth::user()->role->nama == 'Admin') {
            $validateData = validator($request->all(),[
                'nik' => 'required|string|max:7|unique:user,nik',
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:45|unique:user,email',
                'no_telepon' => 'required|string|max:15|',
                'alamat' => 'required|string|max:45|',
                'id_role' => 'required|int',
                'id_jurusan' => 'nullable|string',
                'password' => 'required|confirmed',
                'periode' => 'required|string|max:20|',
                'file_input' => 'nullable|image|mimes:svg,png,jpg,gif,jpeg',
            ])->validate();

            $user =  new User($validateData);

            $user->image = $this->uploadImage($validateData);

            $user->save();

            session()->flash('success', 'User berhasil ditambahkan');

            return redirect()->route('admin-user-crud');

        } elseif (Auth::user()->role->nama == 'Manager Operasional') {
            $validateData = validator($request->all(),[
                'nik' => 'required|string|max:7|unique:user,nik',
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:45|unique:user,email',
                'no_telepon' => 'required|string|max:15|',
                'alamat' => 'required|string|max:45|',
                'password' => 'required|confirmed',
                'periode' => 'required|string|max:20|',
                'file_input' => 'sometimes|image|mimes:svg,png,jpg,gif,jpeg',
            ])->validate();

            $user =  new User($validateData);
            $user->id_role = 4;

            $user->image = $this->uploadImage($validateData);

            $user->id_jurusan = Auth::user()->id_jurusan;
           
            $user->save();

            session()->flash('success', 'Mahasiswa berhasil ditambahkan');

            return redirect()->route('mo-students');
        }
           
    }

    private function uploadImage($validateData) {
        if (isset($validateData['file_input'])) {
            $image = $validateData['file_input'];
            $imageName = $validateData['nik'] . '.' . $image->getClientOriginalExtension(); 

            // Check if the image already exists
            $imagePath = public_path('profilePicture') . '/' . $imageName;
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the old image
            }

            $image->move(public_path('profilePicture'), $imageName);
            // Storage::disk('local')->put('/profilePicture/' . $imageName, File::get($image));
            return $imageName;

        } else {
            return 'defaultpp.jpg';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //

        $validateData = validator($request->all(),[
            'nik' => ['required','string','max:7', Rule::unique('user','nik')->ignore($user->nik,'nik')],
            'nama' => 'required|string|max:100',
            'email' => ['required','email','max:45', Rule::unique('user','email')->ignore($user->email, 'email')],
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:45|',
            'id_role' => 'required|int',
            'id_jurusan' => 'nullable|string',
            'password' => 'sometimes|confirmed',
            'periode' => 'sometimes|string|max:20|',
            'file_input' => 'nullable|image|mimes:svg,png,jpg,gif,jpeg',
        ])->validate();

        $user['nama'] = $validateData['nama'];
        $user['email'] = $validateData['email'];
        $user['no_telepon'] = $validateData['no_telepon'];
        $user['alamat'] = $validateData['alamat'];
        $user['password'] = Hash::make($validateData['password']);
        $user['periode'] = $validateData['periode'];

        $user->image = $this->uploadImage($validateData);

        $user->save();

        // if (Auth::user()->role->nama == 'Admin'){

        //     return redirect()->route('admin-user-crud')
        //         ->with('success', 'User Berhasil diupdate');
        // } else if (Auth::user()->role->nama == 'Manager Operasional'){
        //     return redirect()->route('mo-students')
        //         ->with('success', 'User Berhasil diupdate');
        // }
        return redirect()->back()
            ->with('success', 'Berhasil Mengupdate Profile');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
