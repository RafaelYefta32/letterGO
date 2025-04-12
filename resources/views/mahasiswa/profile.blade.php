@extends('layouts.app')

@section('content')
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 mt-2">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                                class="rounded-circle mt-5" width="150px"
                                src="{{ asset('/storage/profilePicture/' . Auth::user()->image) }}"><span
                                class="font-weight-bold">{{ Auth::user()->nama }}</span><span
                                class="text-black-50">{{ Auth::user()->role->nama }} -
                                {{ Auth::user()->jurusan->nama }}</span><span>
                            </span></div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <h2 class="text-center font-bold text-xl">Profile Settings</h2>
                            </div>
                            <div class="row mt-3">
                                <form class="max-w-sm mx-auto" method="POST"
                                    action="{{ route('profile-user-update', Auth::user()->nik) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-2">
                                        <label for="nik"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                                        <input type="text" id="nik" name="nik"
                                            class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" value="{{ Auth::user()->nik }}" readonly />
                                    </div>
                                    <div class="mb-2">
                                        <label for="nama"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                        <input type="text" id="nama" name="nama"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" autocomplete="off" maxlength="100"
                                            value="{{ Auth::user()->nama }}" required autofocus />
                                    </div>
                                    <div class="mb-2">
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" autocomplete="off" maxlength="45"
                                            value="{{ Auth::user()->email }}" required />
                                    </div>
                                    <div class="mb-2">
                                        <label for="alamat"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                        <input type="text" id="alamat" name="alamat"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" autocomplete="off" maxlength="45"
                                            value="{{ Auth::user()->alamat }}" required />
                                    </div>
                                    <div class="mb-2" hidden>
                                        <label for="id_jurusan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jurusan</label>
                                        <input type="text" id="id_jurusan" name="id_jurusan"
                                            class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" value="{{ Auth::user()->id_jurusan }}" readonly />
                                    </div>
                                    <div class="mb-2" hidden>
                                        <label for="id_role"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                        <input type="text" id="id_role" name="id_role"
                                            class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" value="{{ Auth::user()->id_role }}" readonly />
                                    </div>
                                    <div class="mb-2">
                                        <label for="periode"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periode</label>
                                        <input type="text" id="periode" name="periode"
                                            class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" autocomplete="off" maxlength="20"
                                            value="{{ Auth::user()->periode }}" readonly />
                                    </div>
                                    <div class="mb-2">
                                        <label for="status"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                        <input type="text" id="status" name="status"
                                            class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="" autocomplete="off" maxlength="20"
                                            value="{{ Auth::user()->status }}" readonly />
                                    </div>
                                    <div class="mb-2">
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                                            Password</label>
                                        <input type="password" name="password" id="password"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="*****" autocomplete="off" maxlength="100">
                                    </div>
                                    <div class="mb-2">
                                        <label for="password_confirmation"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password
                                            Confirmation</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 placeholder-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="*****" autocomplete="off" maxlength="100">
                                    </div>
                                    <div class="mb-2">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            for="file_input">Profile Picture</label>
                                        <input
                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            id="file_input" name="file_input" type="file"
                                            accept=".svg, .png, .jpg, .gif, .jpeg">
                                        <p class="mt-1 text-sm text-gray-400 dark:text-gray-300" id="file_input_help">SVG,
                                            PNG, JPG or GIF</p>
                                    </div>
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save
                                        Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
