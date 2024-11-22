<nav class="bg-gray-800 sticky w-full top-0 z-50">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!--
              Icon when menu is closed.
  
              Menu open: "hidden", Menu closed: "block"
            -->
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
              Icon when menu is open.
  
              Menu open: "block", Menu closed: "hidden"
            -->
                    <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <a href="/">
                        {{-- <img class="h-8 w-auto"
                            src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500"
                            alt="Your Company"> --}}
                        <p class="text-white text-2xl font-semibold">Forum Diskusi</p>
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="{{ route('home') }}"
                            class="rounded-md px-3 py-2 text-sm hover:bg-gray-700 font-medium text-white"
                            aria-current="page">Beranda</a>
                        <a href="{{ route('hot-topics') }}"
                            class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-700 hover:text-white">
                            Topik Populer</a>
                        <a href="{{ route('topics.create') }}"
                            class="text-white text-sm font-medium bg-slate-500 px-3 py-2 rounded shadow-xl hover:bg-slate-600"><i
                                class="fa-solid fa-pencil mr-2"></i>Buat
                            Topik</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                <!-- Profile dropdown -->

                <div class="relative ml-3">
                    @if (Auth::user())
                        <div>
                            <button id="button-profile" type="button"
                                class="relative flex items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>

                                <p class="hidden md:flex text-white mr-3 py-2 font-semibold">{{ Auth::user()->name }}
                                </p>
                                <i class="fa-solid fa-chevron-down text-gray-400"></i>
                            </button>
                            <div id="user-menu"
                                class="hidden absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1">
                                <!-- Active: "bg-gray-100 outline-none", Not Active: "" -->
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700"
                                    role="menuitem" tabindex="-1" id="user-menu-item-0">My Posts</a>
                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('dashboard-admin') }}"
                                        class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                        id="user-menu-item-0">Dashboard Admin</a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700"
                                    role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="user-menu-item-2">Sign out</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="rounded-md text-sm bg-gray-900 px-3 py-2 font-semibold text-white hover:bg-slate-500">Login
                                <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                    @endif
                </div>





                <!--
              Dropdown menu, show/hide based on menu state.
  
              Entering: "transition ease-out duration-100"
                From: "transform opacity-0 scale-95"
                To: "transform opacity-100 scale-100"
              Leaving: "transition ease-in duration-75"
                From: "transform opacity-100 scale-100"
                To: "transform opacity-0 scale-95"
            -->

            </div>
        </div>
    </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="/"
                class="block rounded-md text-gray-300 px-3 py-2 text-base font-medium hover:text-white hover:bg-gray-700"
                aria-current="page">Beranda</a>
            <a href="{{ route('hot-topics') }}"
                class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Topik
                Populer</a>
            <a href="{{ route('topics.create') }}"
                class="block rounded-md px-3 py-2 text-base font-medium bg-slate-500 text-white text-center hover:bg-slate-600 hover:text-white shadow-xl"><i
                    class="fa-solid fa-pencil mr-2"></i>Buat
                Topik</a>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        const buttonProfile = document.getElementById('button-profile');
        const userMenuItems = document.querySelector('#user-menu');
        buttonProfile.addEventListener('click', () => {
            const expanded = buttonProfile.getAttribute('aria-expanded') === 'true' || false;
            buttonProfile.setAttribute('aria-expanded', !expanded);
            userMenuItems.classList.toggle('hidden');
        });
    </script>
    <script>
        const button = document.querySelector('button[aria-controls="mobile-menu"]');
        const menu = document.getElementById('mobile-menu');

        button.addEventListener('click', () => {
            const expanded = button.getAttribute('aria-expanded') === 'true' || false;
            button.setAttribute('aria-expanded', !expanded);
            menu.classList.toggle('hidden');
        });
    </script>
@endpush
