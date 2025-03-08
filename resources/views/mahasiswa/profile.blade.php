@extends('layouts.app')

@section('content')
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-8">
        <div class="mx-auto max-w-screen-lg px-4 2xl:px-0 mt-5">
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl md:mb-6">General overview</h2>

            <div class="py-4 md:py-8">
                {{-- @include('Components/alerts/alert') --}}
                <div class="mb-4 grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
                    <div class="space-y-4">
                        <div class="flex space-x-4">
                            <img class="h-16 w-16 rounded-lg" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="Helene avatar" />
                            <div>
                                <span
                                    class="mb-2 inline-block rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                    Mahasiswa</span>
                                <h2
                                    class="flex items-center text-xl font-bold leading-none text-gray-900 dark:text-white sm:text-2xl">
                                    Rafael</h2>
                            </div>
                        </div>
                        <dl class="">
                            <dt class="font-semibold text-gray-900 dark:text-white">Email Address</dt>
                            <dd class="text-gray-500 dark:text-gray-400">email</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold text-gray-900 dark:text-white">Alamat</dt>
                            <dd class="text-gray-500 dark:text-gray-400">Jl bakjer</dd>
                        </dl>
                    </div>
                    <div class="space-y-4">
                        {{-- <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Favorite pick-up point</dt>
                        <dd class="flex items-center gap-1 text-gray-500 dark:text-gray-400">
                            <svg class="hidden h-5 w-5 shrink-0 text-gray-400 dark:text-gray-500 lg:inline"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 12c.263 0 .524-.06.767-.175a2 2 0 0 0 .65-.491c.186-.21.333-.46.433-.734.1-.274.15-.568.15-.864a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 12 9.736a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 16 9.736c0 .295.052.588.152.861s.248.521.434.73a2 2 0 0 0 .649.488 1.809 1.809 0 0 0 1.53 0 2.03 2.03 0 0 0 .65-.488c.185-.209.332-.457.433-.73.1-.273.152-.566.152-.861 0-.974-1.108-3.85-1.618-5.121A.983.983 0 0 0 17.466 4H6.456a.986.986 0 0 0-.93.645C5.045 5.962 4 8.905 4 9.736c.023.59.241 1.148.611 1.567.37.418.865.667 1.389.697Zm0 0c.328 0 .651-.091.94-.266A2.1 2.1 0 0 0 7.66 11h.681a2.1 2.1 0 0 0 .718.734c.29.175.613.266.942.266.328 0 .651-.091.94-.266.29-.174.537-.427.719-.734h.681a2.1 2.1 0 0 0 .719.734c.289.175.612.266.94.266.329 0 .652-.091.942-.266.29-.174.536-.427.718-.734h.681c.183.307.43.56.719.734.29.174.613.266.941.266a1.819 1.819 0 0 0 1.06-.351M6 12a1.766 1.766 0 0 1-1.163-.476M5 12v7a1 1 0 0 0 1 1h2v-5h3v5h7a1 1 0 0 0 1-1v-7m-5 3v2h2v-2h-2Z" />
                            </svg>
                            Herald Square, 2, New York, United States of America
                        </dd>
                    </dl>
                    <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">My Companies</dt>
                        <dd class="text-gray-500 dark:text-gray-400">FLOWBITE LLC, Fiscal code: 18673557</dd>
                    </dl>
                    <dl>
                        <dt class="mb-1 font-semibold text-gray-900 dark:text-white">Payment Methods</dt>
                        <dd class="flex items-center space-x-4 text-gray-500 dark:text-gray-400">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-700">
                                <img class="h-4 w-auto dark:hidden"
                                    src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa.svg"
                                    alt="" />
                                <img class="hidden h-4 w-auto dark:flex"
                                    src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa-dark.svg"
                                    alt="" />
                            </div>
                            <div>
                                <div class="text-sm">
                                    <p class="mb-0.5 font-medium text-gray-900 dark:text-white">Visa ending in 7658</p>
                                    <p class="font-normal text-gray-500 dark:text-gray-400">Expiry 10/2024</p>
                                </div>
                            </div>
                        </dd>
                    </dl> --}}
                    </div>
                </div>
                <button type="button" data-modal-target="accountInformationModal2"
                    data-modal-toggle="accountInformationModal2"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:w-auto">
                    <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z">
                        </path>
                    </svg>
                    Edit your data
                </button>
            </div>
        </div>

        <!-- Account Information Modal -->
        <div id="accountInformationModal2" tabindex="-1" aria-hidden="true"
            class="max-h-auto fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden antialiased md:inset-0">
            <div class="max-h-auto relative max-h-full w-full max-w-lg p-4">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                    <!-- Modal header -->
                    <div
                        class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Account Information</h3>
                        <button type="button"
                            class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="accountInformationModal2">
                            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    {{-- <form class="p-4 md:p-5" method="POST" action="{{ route('profile.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <input type="text" id="id" name="id"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                value="{{ Auth::user()->id }}" hidden />
                            <div class="col-span-2">
                                <label for="pick-up-point-input"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> New Name
                                </label>
                                <input type="text" id="name" name="name"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="John Doe..." value="{{ Auth::user()->name }}" />
                            </div>

                            <div class="col-span-2">
                                <label for="email_info_modal"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> New Email
                                </label>
                                <input type="text" id="email" name="email"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                                    placeholder="John.doe@gmail.com" value="{{ Auth::user()->email }}" />
                            </div>

                            <div class="col-span-2">
                                <label for="phone_number" class="block text-sm/6 font-medium text-gray-900">New Phone
                                    number</label>
                                <div class="mt-2">
                                    <input type="number" name="phone_number" id="phone_number"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                        placeholder="081234567" value="{{ Auth::user()->phone_number }}" minlength="12"
                                        maxlength="15">
                                </div>
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="profile_picture">Upload Profile Picture</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="file_input_help" id="profile_picture" type="file"
                                    name="profile_picture">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG,
                                    JPG or GIF (MAX.
                                    800x400px).</p>
                            </div>

                        </div>
                        <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
                            <button type="submit"
                                class="me-2 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Save
                                Profile</button>
                            <button type="button" data-modal-toggle="accountInformationModal2"
                                class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Cancel</button>
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>

    </section>
@endsection
