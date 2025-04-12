<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validateData = validator($request->all(),[
            'nik' => 'required|string|max:7|unique:user,nik',
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:45|unique:user,email',
            'alamat' => 'required|string|max:45|',
            'periode' => 'required|string|max:20|',
            'file_input' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'password' => 'required|confirmed',
        ])->validate();

        $user =  new User($validateData);
        
        if ($request->hasFile('file_input')) {
            $file = $request->file('file_input');
            $newFileName = $validateData['nik'] . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profilePicture', $newFileName, 'public');
            $user['image'] = $newFileName;
        } else {
            $user['image'] = 'defaultpp.jpg';
        }

        $user['id_role'] = 1;
        $user['id_jurusan'] = null;
        $user['status'] = 'Aktif';

        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('admin-dashboard', absolute: false));
    }
}
