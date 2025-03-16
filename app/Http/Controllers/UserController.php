<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAdmin()
    {
        return view('admin.user')
        ->with('users', User::all())
        ->with('roles',Role::all())
        ->with('majors',Jurusan::all());
    }
    public function indexMo()
    {
        return view('mo.students')
        ->with('students',User::where('id_role',4)->get())
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
        if (Auth::user()->role->nama == 'Admin') {
            $validateData = validator($request->all(),[
                'nik' => 'required|string|max:7|unique:user,nik',
                'nama' => 'required|string|max:100|unique:user,nama',
                'email' => 'required|email|max:45|unique:user,email',
                'alamat' => 'required|string|max:45|',
                'id_role' => 'required|int',
                'id_jurusan' => 'required|string',
                'password' => 'required|confirmed',
                'periode' => 'required|string|max:20|',
                'file_input' => 'nullable|image|mimes:svg,png,jpg,gif|dimensions:max_width=800,max_height=400',
            ])->validate();

            $user =  new User($validateData);

            $user->image = $this->uploadImage($validateData);

            $user->save();

            session()->flash('success', 'User berhasil ditambahkan');

            return redirect()->route('admin-user-crud');

        } elseif (Auth::user()->role->nama == 'Manager Operasional') {
            

            $validateData = validator($request->all(),[
                'nik' => 'required|string|max:7|unique:user,nik',
                'nama' => 'required|string|max:100|unique:user,nama',
                'email' => 'required|email|max:45|unique:user,email',
                'alamat' => 'required|string|max:45|',
                'id_jurusan' => 'required|string',
                'password' => 'required|confirmed',
                'periode' => 'required|string|max:20|',
                'file_input' => 'nullable|image|mimes:svg,png,jpg,gif|dimensions:max_width=800,max_height=400',
            ])->validate();

            $user =  new User($validateData);
            $user->id_role = 4;

            $user->image = $this->uploadImage($validateData);
           
            $user->save();

            return redirect()->route('mo-students');
        }
           
    }

    private function uploadImage($validateData) {
        if (isset($validateData['file_input'])) {
            $image = $validateData['file_input'];

            $imageName =  $validateData['nik'] . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path('profilePicture'), $imageName);
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
