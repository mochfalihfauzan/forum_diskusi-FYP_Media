@extends('layouts.main')
@section('content')
    <div class="mx-5 md:mx-0">
        <div class="w-full md:w-3/4 mx-auto flex flex-col gap-3 mb-5">
            <h1 class="text-3xl font-semibold">Topik milik anda</h1>

            {{-- Search --}}
            <div class="flex justify-center mb-3">
                <form action="{{ route('dashboard') }}" method="GET" id="filterForm" class="flex w-full mx-3 md:w-2/3">
                    <input type="text" name="search" id="search"
                        class="px-5 w-10/12 md:w-9/12 rounded-s-full h-12 shadow-lg border" placeholder="Cari"
                        value="{{ request('search') }}" oninput="filterTable()">
                    <button type="submit"
                        class="bg-sky-600 w-3/12 md:w-2/12 hover:bg-sky-500 text-white px-2 py-3 rounded-e-full shadow-lg h-12 text-sm md:text-base">
                        <i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            @if (request('search'))
                <div class="flex justify-center mb-3 items-center">
                    <p>Menampilkan Pencarian "<span class="font-semibold">{{ request('search') }}</span>"</p>
                    <a href="{{ route('dashboard') }}" class="mx-2 py-1 px-2 bg-red-500 rounded-full"><i
                            class="fa-solid fa-xmark text-white"></i></a>

                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-500 text-white p-3 rounded-md shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if ($topics->isEmpty())
                <div class="w-full text-center border shadow rounded-lg py-3 px-5 bg-white">
                    <p class="text-lg font-semibold mb-3">Belum ada topik yang dibuat</p>
                    <div class="mb-3">
                        <a href="{{ route('topics.create') }}"
                            class="bg-sky-600 text-white py-2 px-5 rounded hover:bg-sky-800 shadow hover:shadow-lg font-semibold">+
                            Buat Topik</a>
                    </div>
                </div>
            @else
                <div class="lg:grid lg:grid-cols-2 gap-3">
                    @foreach ($topics as $topic)
                        <div class="border shadow rounded-lg py-3 px-5 bg-white flex flex-col justify-between mb-3 lg:mb-0">
                            <div class="min-h-40 flex-grow">
                                <a href="{{ route('topics.show', $topic->id) }}">
                                    <p class="text-lg font-semibold overflow-hidden">{{ $topic->title }}</p>
                                    <p class="text-base overflow-hidden">{{ $topic->content }}</p>
                                    @if ($topic->image)
                                        <img src="{{ asset('storage/' . $topic->image) }}" alt=""
                                            class="w-full object-cover max-h-60 mt-5 rounded-sm">
                                    @endif
                                </a>
                            </div>
                            <div class="h-20 flex flex-col justify-end">
                                <div class="flex justify-between items-center">
                                    <p class="text-xs text-slate-600 ">{{ $topic->created_at->diffForHumans() }}</p>
                                    <div class="flex gap-2 items-center">
                                        <a href="{{ route('topics.show', $topic->id) }}"><i
                                                class="fa-regular fa-comment text-lg"></i>
                                        </a>
                                        <button class="share-button" data-id="{{ $topic->id }}"><i
                                                class="fa-solid fa-share text-lg"></i></button>
                                    </div>
                                </div>
                                <div class="mt-3 flex gap-3">
                                    <form action="{{ route('topics.delete', $topic->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        {{-- tombol confirm delete --}}
                                        <button type="submit"
                                            onclick="return confirm('Apakah yakin ingin hapus topik?')"><i
                                                class="fa-solid fa-trash text-red-600"></i></button>
                                    </form>
                                    <a href="{{ route('topics.edit', $topic->id) }}"><i
                                            class="fa-solid fa-pen-to-square text-green-500"></i></a>
                                </div>
                            </div>
                        </div>
                        {{-- modal share topic --}}
                        <div data-id="{{ $topic->id }}"
                            class="hidden share-modal fixed w-full h-screen bg-slate-950 left-0 top-0 bg-opacity-50 ">
                            <div class="bg-white border p-5 fixed md:w-1/2 top-1/3 left-10 right-10 md:left-1/4">
                                <div class="mb-3 flex justify-between">
                                    <h3 class="text-xl">Bagikan Topik Ini</h3>
                                    <button class="close-share"><i class="fa-solid fa-xmark"></i></button>
                                </div>
                                <div class=" flex flex-col w-full">
                                    <input type="text" readonly class="url border w-full text-center rounded h-10 mb-3"
                                        value="{{ route('topics.show', $topic->id) }}">
                                    <button
                                        class="copy-button bg-slate-700 py-2 px-3 text-white rounded hover:bg-slate-900">Bagikan</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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
@endpush
