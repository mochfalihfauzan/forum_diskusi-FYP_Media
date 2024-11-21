@extends('layouts.main')
@section('content')
    <div class="flex mt-5">
        @include('partials.sidebar')
        <div class="py-5 w-full">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 ">
                        <h2 class="text-2xl font-semibold">Halo, {{ Auth::user()->name }}</h2>
                        <div class="flex flex-col gap-3 my-5">
                            <div class="flex w-full gap-5 mb-5">
                                <div class="border w-1/3 px-5 py-3 rounded-lg bg-sky-600 h-24 text-white">
                                    <p class="text-2xl">{{ $topics->count() }} Topik</p>
                                </div>
                                <div class="border w-1/3 px-5 py-3 rounded-lg bg-green-600 h-24 text-white">
                                    <p class="text-2xl">{{ $users->count() }} User</p>
                                </div>
                                <div class="border w-1/3 px-5 py-3 rounded-lg bg-red-600 h-24 text-white">
                                    <p class="text-xl">{{ $formatedDate }}</p>
                                </div>
                            </div>

                            <h2 class="text-xl font-semibold">Topik terbaru</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach ($topics as $topic)
                                    <div class="border shadow rounded-lg py-3 px-5 bg-white flex flex-col justify-between">
                                        <a href="{{ route('topics.show', $topic->id) }}">
                                            <div class="flex-grow min-h-40">
                                                <p class="text-lg font-semibold">{{ $topic->title }}</p>
                                                <p class="text-base">{{ $topic->content }}</p>
                                                @if ($topic->image)
                                                    <img src="{{ asset('storage/' . $topic->image) }}"
                                                        alt="{{ $topic->title }}" class="rounded my-2">
                                                @endif
                                            </div>
                                        </a>
                                        <div class="w-full flex justify-between items-center mt-3">
                                            <p class="text-xs text-slate-600 ">{{ $topic->created_at->diffForHumans() }}
                                            </p>
                                            <div class="flex gap-2 items-center">
                                                <a href="{{ route('topics.show', $topic->id) }}"><i
                                                        class="fa-regular fa-comment"></i></a>
                                                <button class="share-button" data-id="{{ $topic->id }}"><i
                                                        class="fa-solid fa-share"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- modal share topic --}}
                                    <div data-id="{{ $topic->id }}"
                                        class="share-modal fixed w-full h-screen hidden bg-slate-950 left-0 top-0 bg-opacity-50 ">
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
        // copy url
        document.querySelectorAll('.copy-button').forEach(button => {
            button.addEventListener('click', () => {
                const url = button.previousElementSibling.value;
                navigator.clipboard.writeText(url);
                alert('URL berhasil disalin');
            });
        });
    </script>
@endpush
