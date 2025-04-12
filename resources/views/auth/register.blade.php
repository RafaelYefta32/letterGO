<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0">
            <span>
            <div class="flex items-center justify-center">
                <img class="w-24 h-auto md:w-36 lg:w-32" src="{{ asset('img/logoLetter.png') }}"
                alt="logo">
                <h2 class="ml-3 text-center text-3xl/9 font-bold tracking-tight text-gray-800">LetterGO</h2>
            </div>
            </span>
            <div class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl text-center">
                        Admin Registration
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">NRP / NIK</label>
                            <input type="text" name="nik" id="nik"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder:text-gray-400"
                                placeholder="2073099" value="{{ old('nik') }}" required="" autocomplete="nik" autofocus maxlength="7">
                        </div>
                        <div>
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder:text-gray-400"
                                placeholder="John Doe" value="{{ old('nama') }}" required="" autocomplete="nama" autofocus maxlength="100">
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder:text-gray-400"
                                placeholder="john.doe@email.com" value="{{ old('email') }}" required="" autocomplete="email" maxlength="45">
                        </div>
                        <div>
                            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                            <input type="text" name="alamat" id="alamat"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder:text-gray-400"
                                placeholder="Jl. Mawar No.999" value="{{ old('alamat') }}" required="" autocomplete="alamat" maxlength="45">
                        </div>
                        <div>
                            <label for="periode" class="block mb-2 text-sm font-medium text-gray-900">Periode</label>
                            <input type="text" name="periode" id="periode"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder:text-gray-400"
                                placeholder="Ganjil 2030/2031" value="{{ old('periode') }}" required="" autocomplete="periode" maxlength="20">
                        </div>
                        <div>
                            <label for="file_input" class="block mb-2 text-sm font-medium text-gray-900">Profile Picture</label>
                            <input type="file" name="file_input" id="file_input"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder:text-gray-400"
                                accept="image/png,image/jpg,image/jpeg">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG
                                (MAX. 2 MB).</p>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder:text-gray-400"
                                required="" maxlength="100">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Password Confirmation</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-500 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder:text-gray-400"
                                required="" maxlength="100">
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign
                            Up</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
