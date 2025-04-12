
<nav class="bg-cyan-900 fixed-top right-0 left-0 z-1" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button" @click="isOpen = !isOpen"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-cyan-200 hover:bg-cyan-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!--
              Icon when menu is closed.
              Menu open: "hidden", Menu closed: "block"
            -->
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                        data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
              Icon when menu is open.
  
              Menu open: "block", Menu closed: "hidden"
            -->
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                        data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex shrink-0 items-center ml-2">
                <img class="w-16 h-auto md:w-20 lg:w-18" src="{{ asset('img/logoLetter.png') }}" alt="Logo">
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-center ml-5">
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-cyan-900 text-white", Default: "text-cyan-200 hover:bg-cyan-700 hover:text-white" -->
                        <x-nav-link href="/home" :active="request()->is('home')">Home</x-nav-link>

                        <x-nav-link href="{{ route('mahasiswa-submit') }}" :active="request()->is('submit')">Submit Letter</x-nav-link>

                        <x-nav-link href="{{ route('mahasiswa-history') }}" :active="request()->is('history')">History</x-nav-link>

                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                @php
                    use App\Models\Pengajuan;

                    $jml = Pengajuan::where('nrp', Auth::user()->nik)
                        ->where('status', '!=', 'Menunggu Persetujuan')
                        ->count();
                @endphp
                <button type="button" data-dropdown-toggle="notification-dropdown"
                    class="relative p-2 mr-1 text-cyan-200 rounded-lg hover:text-white hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300">
                    <span class="sr-only">View notifications</span>
                    <!-- Bell icon -->
                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                        </path>
                    </svg>
                    @if ($jml > 0)
                        <span
                            class="absolute top-1 right-1 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-600 rounded-full">
                            {{ $jml }}
                        </span>
                    @endif
                </button>


                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div>
                        <button type="button" @click="isOpen = !isOpen"
                            class="relative flex rounded-full bg-cyan-900 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-cyan-900"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            {{-- <img class="size-8 rounded-full" src="{{ asset('profilePicture/' . Auth::user()->Image) }}"
                                alt=""> --}}
                            <img class="size-8 rounded-full" src="{{ asset('/storage/profilePicture/'.Auth::user()->image) }}"
                                alt="">

                            <div class="flex flex-col items-start">
                                <p class="text-sm text-white px-2">{{ Auth::user()->nama }}</p>
                                {{-- <p class="text-sm text-white px-2">{{ Auth::user()->name }}</p> --}}
                                <p class="text-xs text-white px-2">Mahasiswa</p>
                            </div>
                        </button>
                    </div>

                    <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-cyan-100 outline-none", Not Active: "" -->
                        <a href="/profile" class="block px-4 py-2 text-sm text-cyan-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-0">Your Profile</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-cyan-700" role="menuitem"
                            tabindex="-1" id="user-menu-item-2">Sign out</a>
                    </div>
                </div>

                <!-- Notif Dropdown -->
                <div class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white divide-y divide-cyan-100 shadow-lg rounded-xl"
                    id="notification-dropdown">
                    <div class="block py-2 px-4 text-base font-medium text-center text-cyan-700 bg-cyan-50">
                        Notifications
                    </div>
                    @php

                        $notif = Pengajuan::where('nrp', Auth::user()->nik)
                            ->where('status', '!=', 'Menunggu Persetujuan')
                            ->latest('updated_at')
                            ->take(5)
                            ->get();
                    @endphp
                    <div>
                        @foreach ($notif as $item)
                            <a href="{{ route('mahasiswa-history') }}"
                                class="flex py-3 px-4 border-b hover:bg-cyan-100">
                                <div class="flex-shrink-0">
                                    @if ($item->status == 'Selesai')
                                        <img class="w-11 h-11 rounded-full"
                                            src="{{ asset('storage/profilePicture/' . $item->mo->image) }}"
                                            alt="Bonnie Green avatar" />
                                    @else
                                        <img class="w-11 h-11 rounded-full"
                                            src="{{ asset('storage/profilePicture/' . $item->kaprodi->image) }}"
                                            alt="Bonnie Green avatar" />
                                    @endif
                                </div>
                                <div class="pl-3 w-full">
                                    <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                                        <span class="font-semibold text-gray-900 dark:text-white">Pengajuan
                                            {{ $item->jenis_surat }} telah {{ $item->status }} </br></span>
                                        @if ($item->status == 'Selesai')
                                            {{ $item->mo->nama }}
                                        @else
                                            {{ $item->kaprodi->nama }}
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <a href="/Contact/contact"
                        class="block py-2 text-md font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-600 dark:text-white dark:hover:underline">
                        <div class="inline-flex items-center">
                            <svg aria-hidden="true" class="mr-2 w-4 h-4 text-gray-500 dark:text-gray-400"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            View all
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                aria-current="page">Dashboard</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
            <a href="#"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
        </div>
    </div>
</nav>
