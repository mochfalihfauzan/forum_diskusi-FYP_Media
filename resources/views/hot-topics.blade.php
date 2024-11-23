@extends('layouts.main')
@section('content')
    <div class="w-full md:w-3/4 flex flex-col gap-3 mb-5 mx-auto">
        <h1 class="mx-5 md:mx-0 text-3xl font-semibold">{{ $title }} 🔥</h1>

        {{-- Search --}}
        <div class="flex justify-center mb-3">
            <form action="{{ route('hot-topics') }}" method="GET" id="filterForm" class="flex w-full mx-3 md:w-2/3">
                <input type="text" name="search" id="search"
                    class="px-5 w-10/12 md:w-9/12 rounded-s-full h-12 shadow-lg" placeholder="Cari"
                    value="{{ request('search') }}" oninput="filterTable()">
                <button type="submit"
                    class="bg-sky-600 w-3/12 md:w-2/12 hover:bg-sky-500 text-white px-4 py-3 rounded-e-full shadow-lg h-12 text-sm md:text-base">Cari
                    <i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        @if (request('search'))
            <div class="flex justify-center mb-3 items-center">
                <p>Menampilkan Pencarian "<span class="font-semibold">{{ request('search') }}</span>"</p>
                <a href="{{ route('hot-topics') }}" class="mx-2 py-1 px-2 bg-red-500 rounded-full"><i
                        class="fa-solid fa-xmark text-white"></i></a>

            </div>
        @endif


        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded-md shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @foreach ($topics as $item)
            <div class="mx-5 md:mx-0 border shadow-sm py-5 px-8 rounded-md bg-white">
                <div class="flex justify-between">
                    <div class="flex">
                        <p class="text-sm text-gray-600">{{ $item->user->name }}</p>
                    </div>
                    <p class="text-sm text-gray-600">{{ $item->created_at->diffForHumans() }}</p>
                </div>
                <a href="{{ route('topics.show', $item->id) }}">
                    <div>
                        <h2 class="text-xl font-semibold overflow-hidden break-words whitespace-normal">{{ $item->content }}
                        </h2>
                        <p class="overflow-hidden">{{ $item->title }}</p>
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                class="w-full h-80 object-cover mt-5 rounded-sm">
                        @endif

                    </div>
                </a>
                <div class="flex gap-3 mt-5 items-center">
                    <a href="{{ route('topics.show', $item->id) }}">
                        <i class="fa-regular fa-comment text-lg"></i><span
                            class="text-xs ml-1">{{ $comments->where('topic_id', $item->id)->count() }}</span>
                    </a>
                    <button class="share-button" data-id="{{ $item->id }}"><i
                            class="fa-solid fa-share text-lg"></i></button>
                    <button class="menu-button" data-id="{{ $item->id }}"><i
                            class="fa-solid fa-ellipsis-vertical p-3 text-lg"></i></button>
                    <div class="menu-list hidden absolute bg-slate-300 rounded-sm shadow-sm ml-32 mb-10 opacity-90"
                        data-id="{{ $item->id }}">
                        <div class="flex flex-col">
                            @if ($item->user_id == auth()->id())
                                <a href="{{ route('topics.edit', $item->id) }}"
                                    class="py-2 px-3 hover:bg-slate-400">Edit</a>
                                <hr>
                            @endif
                            <a href="{{ route('topics.show', $item->id) }}"
                                class="py-2 px-3 hover:bg-slate-400">Komentar</a>
                            <hr>
                            <button class="share-button py-2 px-3 text-start hover:bg-slate-400"
                                data-id="{{ $item->id }}">Bagikan</button>

                        </div>
                    </div>
                </div>
            </div>
            {{-- modal share topic --}}
            <div data-id="{{ $item->id }}"
                class="share-modal fixed w-full h-screen hidden bg-slate-950 left-0 top-0 bg-opacity-50 ">
                <div class="bg-white border p-5 fixed md:w-1/2 top-1/3 left-10 right-10 md:left-1/4">
                    <div class="mb-3 flex justify-between">
                        <h3 class="text-xl">Bagikan Topik Ini</h3>
                        <button class="close-share"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class=" flex flex-col w-full">
                        <input type="text" readonly class="url border w-full text-center rounded h-10 mb-3"
                            value="{{ route('topics.show', $item->id) }}">
                        <button
                            class="copy-button bg-slate-700 py-2 px-3 text-white rounded hover:bg-slate-900">Bagikan</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.menu-button').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const menuList = document.querySelector(`.menu-list[data-id="${id}"]`);
                menuList.classList.toggle('hidden');
            });
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
