@extends('layouts.main')
@section('content')
    <div class="flex mt-5">
        @include('partials.sidebar')
        <div class="py-5 w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 ">
                        <h2 class="text-2xl font-semibold">{{ $title }}</h2>
                        {{-- Search --}}
                        <div class="flex justify-center my-3">
                            <form action="{{ route('admin-user') }}" method="GET" id="filterForm"
                                class="flex w-full mx-3 lg:w-2/3">
                                <input type="text" name="search" id="search"
                                    class="px-5 w-10/12 lg:w-9/12 rounded-s-full h-12 shadow-lg border" placeholder="Cari"
                                    value="{{ request('search') }}" oninput="filterTable()">
                                <button type="submit"
                                    class="bg-sky-600 w-3/12 lg:w-2/12 hover:bg-sky-500 text-white px-2 py-3 rounded-e-full shadow-lg h-12 text-xs lg:text-base">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                        @if (request('search'))
                            <div class="flex justify-center mb-3 items-center">
                                <p>Menampilkan Pencarian "<span class="font-semibold">{{ request('search') }}</span>"</p>
                                <a href="{{ route('admin-user') }}" class="mx-2 py-1 px-2 bg-red-500 rounded-full"><i
                                        class="fa-solid fa-xmark text-white"></i></a>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="bg-green-500 text-white p-3 rounded-md shadow-sm my-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="mt-5 overflow-x-auto p-3">
                            <div class="flex gap-3 my-2 border-2 w-fit p-1 rounded-full shadow-inner">
                                <button id="show-users"
                                    class="text-md font-semibold py-1 px-3 bg-sky-600 rounded-full text-white">User</button>
                                <button id="show-admins" class="text-md font-semibold py-1 px-3 rounded-full">Admin</button>
                            </div>
                            {{-- user --}}
                            <div id="users-table" class="overflow-x-auto">
                                <h2 class="text-2xl font-semibold mb-3">Users</h2>
                                <table class="border border-x-gray-400 w-full">
                                    <tr>
                                        <th class="border border-gray-400 w-1/12 p-3">No</th>
                                        <th class="border border-gray-400 w-3/12 p-3">Nama</th>
                                        <th class="border border-gray-400 w-4/12 p-3">Email</th>
                                        <th class="border border-gray-400 w-2/12 p-3">Role</th>
                                        <th class="border border-gray-400 w-2/12 p-3">Action</th>
                                    </tr>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="border border-gray-400 font-medium text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="border border-gray-400 px-3 py-2">{{ $user->name }}</td>
                                            <td class="border border-gray-400 px-3 py-2">{{ $user->email }}</td>
                                            <td class="border border-gray-400 px-3 py-2">{{ $user->role }}</td>
                                            <td class="border border-gray-400 px-3 py-2">
                                                <div class="flex gap-3 my-2 justify-center">
                                                    <button type="submit"
                                                        class="bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-700 hover:shadow-lg"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                            {{-- admin --}}
                            <div id="admins-table" class="overflow-x-auto hidden">
                                <h2 class="text-2xl font-semibold mb-3">Admins</h2>
                                <table class="border border-x-gray-400 w-full">
                                    <tr>
                                        <th class="border border-gray-400 w-1/12 p-3">No</th>
                                        <th class="border border-gray-400 w-3/12 p-3">Nama</th>
                                        <th class="border border-gray-400 w-4/12 p-3">Email</th>
                                        <th class="border border-gray-400 w-2/12 p-3">Role</th>
                                        <th class="border border-gray-400 w-2/12 p-3">Action</th>
                                    </tr>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td class="border border-gray-400 font-medium text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="border border-gray-400 px-3 py-2">{{ $admin->name }}</td>
                                            <td class="border border-gray-400 px-3 py-2">{{ $admin->email }}</td>
                                            <td class="border border-gray-400 px-3 py-2">{{ $admin->role }}</td>
                                            <td class="border border-gray-400 px-3 py-2">
                                                <div class="flex gap-3 my-2 justify-center">
                                                    <div><i class="fa-solid fa-lock"></i></div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('show-users').addEventListener('click', function() {
            document.getElementById('users-table').classList.remove('hidden');
            document.getElementById('admins-table').classList.add('hidden');
            this.classList.add('bg-sky-600', 'text-white');
            document.getElementById('show-admins').classList.remove('bg-sky-600', 'text-white');
        });

        document.getElementById('show-admins').addEventListener('click', function() {
            document.getElementById('admins-table').classList.remove('hidden');
            document.getElementById('users-table').classList.add('hidden');
            this.classList.add('bg-sky-600', 'text-white');
            document.getElementById('show-users').classList.remove('bg-sky-600', 'text-white');
        });
    </script>
    <script>
        document.querySelectorAll('.share-button').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const modal = document.querySelector(`.share-modal[data-id="${id}"]`);
                modal.classList.remove('hidden');
            })
        });

        document.querySelectorAll('.close-share').forEach(button => {
            button.addEventListener('click', () => {
                const modal = button.closest('.share-modal');
                modal.classList.add('hidden');
            });
        });
    </script>
    <script>
        document.querySelectorAll('.copy-button').forEach(button => {
            button.addEventListener('click', () => {
                const url = button.previousElementSibling.value;
                navigator.clipboard.writeText(url);
                alert('URL berhasil disalin');
            });
        });
    </script>
@endpush
