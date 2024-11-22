@extends('layouts.main')
@section('content')
    <div class="flex justify-center mb-10 mx-5 md:mx-0">
        <div class="w-full md:w-2/3 border shadow-sm py-5 px-8 rounded-md bg-white">
            <div class="mb-3">
                <div class="flex justify-between">
                    <p class="text-sm text-gray-600">{{ $topics->user->name }}</p>
                    <p class="text-sm text-gray-600">{{ $topics->created_at->diffForHumans() }}</p>
                </div>
                <h2 class="text-2xl font-semibold break-words whitespace-normal">{{ $topics->title }}</h2>
                <p class="overflow-hidden">{{ $topics->content }}</p>
                @if ($topics->image)
                    <div class="mt-5">
                        <img src="{{ asset('storage/' . $topics->image) }}" alt="{{ $topics->title }}"
                            class="w-full object-cover rounded-sm">
                    </div>
                @endif
            </div>
            <div class="mb-5">
                <button
                    class="share-button border border-slate-600 hover:border-slate-950 hover:shadow-lg text-slate-600 hover:text-slate-950 w-fit py-2 px-3 rounded-xl"
                    data-id="{{ $topics->id }}"><i
                        class="fa-solid fa-share text-slate-600 text-lg mr-3"></i>Bagikan</button>
            </div>
            <hr>

            <div class="mt-5">
                <h3 class="text-lg font-medium">Komentar ({{ $comments->count() }})</h3>
                <div class="mb-5">
                    <form action="/comments/{{ $topics->id }}" method="POST">
                        @csrf
                        <textarea name="content" id="comment" cols="30" rows="3"
                            class="w-full bg-gray-100 p-2 rounded-xl border border-gray-100 focus:outline-none focus:border-gray-300 mt-4"
                            placeholder="Tulis komentar..."></textarea>
                        <button type="submit"
                            class="bg-blue-700 text-white px-4 py-2 rounded-md shadow-md mt-2 hover:bg-blue-800 hover:shadow-xl">Kirim</button>
                    </form>
                </div>
                <hr>
                @if ($comments->count() == 0)
                    <div class="flex justify-center my-3">
                        <p class="text-slate-500">Belum ada komentar</p>
                    </div>
                @else
                    @foreach ($comments as $comment)
                        <div class="my-3">
                            <div class="flex items-center gap-2">
                                <h3 class="font-medium">{{ $comment->user->name }}</h3> <small>|</small>
                                <p class="text-xs text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                            <p>{{ $comment->content }}</p>

                        </div>
                        <hr>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- modal share topic --}}
    <div data-id="{{ $topics->id }}"
        class="share-modal fixed w-full h-screen hidden bg-slate-950 left-0 top-0 bg-opacity-50 ">
        <div class="bg-white border p-5 fixed md:w-1/2 top-1/3 left-10 right-10 md:left-1/4">
            <div class="mb-3 flex justify-between">
                <h3 class="text-xl">Bagikan Topik Ini</h3>
                <button class="close-share"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class=" flex flex-col w-full">
                <input type="text" readonly class="url border w-full text-center rounded h-10 mb-3"
                    value="{{ route('topics.show', $topics->id) }}">
                <button class="copy-button bg-slate-700 py-2 px-3 text-white rounded hover:bg-slate-900">Bagikan</button>
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
