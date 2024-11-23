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
                        <div class="mt-5 overflow-x-auto">
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
                                        <td class="border border-gray-400 font-medium text-center">{{ $loop->iteration }}
                                        </td>
                                        <td class="border border-gray-400 px-3 py-2">{{ $user->name }}</td>
                                        <td class="border border-gray-400 px-3 py-2">{{ $user->email }}</td>
                                        <td class="border border-gray-400 px-3 py-2">{{ $user->role }}</td>
                                        <td class="border border-gray-400 px-3 py-2">
                                            <div class="flex gap-3 my-2 justify-center">
                                                @if ($user->role !== 'admin')
                                                    <form action="{{ route('user.delete', $user->id) }}" method="POST"
                                                        class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-700 hover:shadow-lg"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Delete</button>
                                                    </form>
                                                @else
                                                    <div><i class="fa-solid fa-lock"></i></div>
                                                @endif
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
@endsection

@push('scripts')
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
