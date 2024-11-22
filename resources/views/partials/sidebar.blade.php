<button class="mobile-menu fixed bg-slate-400 py-2 px-3 left-5 rounded md:hidden z-50 shadow-md"><i
        class="fa-solid fa-bars"></i></button>
<div class="w-1/4 hidden md:flex">
    <div class="bg-white min-h-96 w-1/5 mt-5 ml-16 shadow-md rounded-lg pb-32 left-0 py-5 min-h-1/3 fixed">
        <h1 class="text-2xl mt-3 px-6 font-semibold">Dashboard</h1>
        <div class="flex flex-col py-5">
            <a href="{{ route('dashboard-admin') }}" class="py-2 px-6 hover:bg-slate-300 font-medium"><i
                    class="fa-solid fa-house mr-3"></i>Home</a>
            <a href="{{ route('admin-topics') }}" class="py-2 px-6 hover:bg-slate-300 font-medium"><i
                    class="fa-solid fa-message mr-3"></i>Topik</a>
            <a href="{{ route('admin-user') }}" class="py-2 px-6 hover:bg-slate-300 font-medium"><i
                    class="fa-solid fa-users mr-3"></i>User Management</a>

        </div>
    </div>
</div>

{{-- Mobile Menu --}}
<div class="hidden sidebar-mobile fixed bg-white h-screen w-1/2 shadow-md left-0 pb-32 top-0 mt-14 py-20 md:hidden">
    <h1 class="text-2xl mt-3 px-6 font-semibold">Dashboard</h1>
    <div class="flex flex-col py-5">
        <a href="{{ route('dashboard-admin') }}" class="py-2 px-6 hover:bg-slate-300 font-medium"><i
                class="fa-solid fa-house mr-3"></i>Home</a>
        <a href="{{ route('admin-topics') }}" class="py-2 px-6 hover:bg-slate-300 font-medium"><i
                class="fa-solid fa-message mr-3"></i>Topik</a>
        <a href="{{ route('admin-user') }}" class="py-2 px-6 hover:bg-slate-300 font-medium"><i
                class="fa-solid fa-users mr-3"></i>User Management</a>

    </div>
</div>

@push('scripts')
    <script>
        const mobileMenu = document.querySelector('.mobile-menu');
        const sidebarMobile = document.querySelector('.sidebar-mobile');
        mobileMenu.addEventListener('click', () => {
            sidebarMobile.classList.toggle('hidden');
        })
    </script>
@endpush
