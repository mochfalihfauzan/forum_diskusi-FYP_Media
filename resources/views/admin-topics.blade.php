@extends('layouts.main')
@section('content')
    <div class="flex mt-5">
        @include('partials.sidebar')
        <div class="py-5 w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 ">
                        <h2 class="text-2xl font-semibold">Topik Management</h2>
                        {{-- Search --}}
                        <div class="flex justify-center my-3">
                            <form action="{{ route('admin-topics') }}" method="GET" id="filterForm"
                                class="flex w-full mx-3 md:w-2/3">
                                <input type="text" name="search" id="search"
                                    class="px-5 w-10/12 lg:w-9/12 rounded-s-full h-12 shadow-lg border" placeholder="Cari"
                                    value="{{ request('search') }}" oninput="filterTable()">
                                <button type="submit"
                                    class="bg-sky-600 w-3/12 lg:w-2/12 hover:bg-sky-500 text-white px-2 py-3 rounded-e-full shadow-lg h-12 text-xs lg:text-base">
                                    <i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>

                        @if (request('search'))
                            <div class="flex justify-center mb-3 items-center">
                                <p>Menampilkan Pencarian "<span class="font-semibold">{{ request('search') }}</span>"</p>
                                <a href="{{ route('admin-topics') }}" class="mx-2 py-1 px-2 bg-red-500 rounded-full"><i
                                        class="fa-solid fa-xmark text-white"></i></a>

                            </div>
                        @endif
                        <div class="flex flex-col gap-3 my-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach ($topics as $topic)
                                    <div>
                                        <div
                                            class="border shadow rounded-t-lg py-3 px-5 bg-white flex flex-col justify-between h-80">
                                            <div class="overflow-hidden">
                                                <a href="{{ route('topics.show', $topic->id) }}">
                                                    <div class="flex-grow min-h-40">
                                                        <p class="text-lg font-semibold">{{ $topic->title }}</p>
                                                        <p class="text-base">{{ $topic->content }}</p>
                                                        <p class="text-sm text-gray-500">By {{ $topic->user->name }}</p>
                                                        @if ($topic->image)
                                                            <img src="{{ asset('storage/' . $topic->image) }}"
                                                                alt="{{ $topic->title }}" class="rounded my-2">
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="w-full flex justify-between items-center mt-3">
                                                <p class="text-xs text-slate-600 ">
                                                    {{ $topic->created_at->diffForHumans() }}
                                                </p>
                                                <div class="flex gap-2 items-center">
                                                    <a href="{{ route('topics.show', $topic->id) }}"><i
                                                            class="fa-regular fa-comment"></i></a>
                                                    <button class="share-button" data-id="{{ $topic->id }}"><i
                                                            class="fa-solid fa-share"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <form action="{{ route('topics.delete', $topic->id) }}" method="POST"
                                                class="bg-red-500 py-2 w-full text-center rounded-bl-lg hover:bg-red-700 hover:shadow-lg">
                                                @csrf
                                                @method('DELETE')
                                                {{-- tombol confirm delete --}}
                                                <button type="submit"
                                                    onclick="return confirm('Apakah yakin ingin hapus topik?')"
                                                    class="w-full"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                            <a href="{{ route('topics.edit', $topic->id) }}"
                                                class="bg-green-400 py-2 w-full text-center rounded-br-lg hover:bg-green-600 hover:shadow-lg">
                                                <i class="fa-solid fa-pen-to-square"></i> </a>
                                        </div>
                                    </div>
                                    {{-- modal share topic --}}
                                    <div data-id="{{ $topic->id }}"
                                        class="share-modal fixed w-full h-screen hidden bg-slate-950 left-0 top-0 bg-opacity-50">
                                        <div
                                            class="bg-white border p-5 fixed md:w-1/2 top-1/3 left-10 right-10 md:left-1/4">
                                            <div class="mb-3 flex justify-between">
                                                <h3 class="text-xl">Bagikan Topik Ini</h3>
                                                <button class="close-share"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                            <div class=" flex flex-col w-full">
                                                <input type="text" readonly
                                                    class="url border w-full text-center rounded h-10 mb-3"
                                                    value="{{ route('topics.show', $topic->id) }}">
                                                <button
                                                    class="copy-button bg-slate-700 py-2 px-3 text-white rounded hover:bg-slate-900">Bagikan</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
