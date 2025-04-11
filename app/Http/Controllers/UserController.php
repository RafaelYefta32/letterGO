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
                      ->orWhere('nik', 'like', '%' . $search . '%')
                      ->orWhereHas('jurusan', function ($query) use ($search) {
                          $query->where('nama', 'like', '%' . $search . '%');
                      });
            });
        } else if (request()->has('status')){
            $search = request('status');
            if ($search != "All"){
                $submit = $submit->where(function ($query) use ($search) {
                    $query->where('status', 'like', '%' . $search . '%');
                });
            }
        } else if (request()->has('role')){
            $search = request('role');
            if ($search != "All"){
                $submit = $submit->where(function ($query) use ($search) {
                    $query->where('id_role', 'like', '%' . $search . '%');
                });
            }
        }

        return view('admin.user')
        ->with('users', $submit->paginate(5))
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
        } else if (request()->has('status')){
            $search = request('status');
            if ($search != "All"){
                $submit = $submit->where(function ($query) use ($search) {
                    $query->where('status', 'like', '%' . $search . '%');
                });
            }
        }

        return view('mo.students')
        ->with('students', $submit->where('id_role', 4)->where('id_jurusan', Auth::user()->id_jurusan)->paginate(5));

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
                'alamat' => 'required|string|max:45|',
                'id_role' => 'required|int',
                'id_jurusan' => 'nullable|string',
                'password' => 'required|confirmed',
                'periode' => 'required|string|max:20|',
                'status' => 'required|string|max:20|',
                'file_input' => 'nullable|image|mimes:svg,png,jpg,gif,jpeg',
            ])->validate();
            
            
            if(($validateData['id_role'] == 3 || $validateData['id_role'] == 2) && $validateData['status'] == 'Aktif'){
                $kpr = User::where('id_jurusan', $validateData['id_jurusan'])
                       ->where('status', 'Aktif')
                       ->where('id_role', $validateData['id_role']);
                if($kpr->exists()){
                    return back()->withErrors('Tidak Dapat Menambahkan User Baru.');
                }
            }

            $user =  new User($validateData);

            if ($request->hasFile('file_input')) {
                $file = $request->file('file_input');
                $newFileName = $validateData['nik'] . '.' . $file->getClientOriginalExtension();
                $file->storeAs('profilePicture', $newFileName, 'public');
                $user['image'] = $newFileName;
            } else {
                $user['image'] = 'defaultpp.jpg';
            }

            $user->save();

            session()->flash('success', 'User berhasil ditambahkan');

            return redirect()->route('admin-user-crud');

        } elseif (Auth::user()->role->nama == 'Manager Operasional') {
            $validateData = validator($request->all(),[
                'nik' => 'required|string|max:7|unique:user,nik',
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:45|unique:user,email',
                'alamat' => 'required|string|max:45|',
                'password' => 'required|confirmed',
                'periode' => 'required|string|max:20|',
                'status' => 'required|string|max:20|',
                'file_input' => 'sometimes|image|mimes:svg,png,jpg,gif,jpeg',
            ])->validate();

            $user =  new User($validateData);
            $user->id_role = 4;

            if ($request->hasFile('file_input')) {
                $file = $request->file('file_input');
                $newFileName = $validateData['nik'] . '.' . $file->getClientOriginalExtension();
                $file->storeAs('profilePicture', $newFileName, 'public');
                $user['image'] = $newFileName;
            } else {
                $user['image'] = 'defaultpp.jpg';
            }

            $user->id_jurusan = Auth::user()->id_jurusan;
           
            $user->save();

            session()->flash('success', 'Mahasiswa berhasil ditambahkan');

            return redirect()->route('mo-students');
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

        $validateData = validator($request->all(),[
            'nik' => ['required','string','max:7', Rule::unique('user','nik')->ignore($user->nik,'nik')],
            'nama' => 'required|string|max:100',
            'email' => ['required','email','max:45', Rule::unique('user','email')->ignore($user->email, 'email')],
            'alamat' => 'required|string|max:45|',
            'id_role' => 'required|int',
            'id_jurusan' => 'nullable|string',
            'password' => 'sometimes|confirmed',
            'periode' => 'sometimes|string|max:20|',
            'status' => 'required|string|max:20|',
            'file_input' => 'nullable|image|mimes:png,jpg,jpeg',
        ])->validate();

        if(($validateData['id_role'] == 3 || $validateData['id_role'] == 2) && $validateData['status'] == 'Aktif'){
            $kpr = User::where('id_jurusan', $validateData['id_jurusan'])
                   ->where('status', 'Aktif')
                   ->where('id_role', $validateData['id_role'])
                   ->where('nik', '!=', $validateData['nik']);
            if($kpr->exists()){
                return back()->withErrors('Tidak Dapat Menambahkan User Baru.');
            }
        }

        $user['nama'] = $validateData['nama'];
        $user['email'] = $validateData['email'];
        $user['alamat'] = $validateData['alamat'];
        $user['password'] = Hash::make($validateData['password']);
        $user['periode'] = $validateData['periode'];
        $user['status'] = $validateData['status'];

        if ($request->hasFile('file_input')) {
            $file = $request->file('file_input');
            $newFileName = $validateData['nik'] . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profilePicture', $newFileName, 'public');
            $user['image'] = $newFileName;
        } else {
            $user['image'] = 'defaultpp.jpg';
        }

        $user->save();

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
