@extends('layouts.main')
@section('content')
    <div class="flex justify-center mb-10 mx-5 md:mx-0">
        <div class="w-full md:w-2/3 border shadow-sm py-5 px-8 rounded-md bg-white">
            <div class="mb-5">
                <div class="flex justify-between">
                    <p class="text-sm text-gray-600">{{ $topics->user->name }}</p>
                    <p class="text-sm text-gray-600">{{ $topics->created_at->diffForHumans() }}</p>
                </div>
                <h2 class="text-2xl font-semibold break-words whitespace-normal">{{ $topics->content }}</h2>
                <p class="overflow-hidden">{{ $topics->title }}</p>
                @if ($topics->image)
                    <div class="mt-5">
                        <img src="{{ asset('storage/' . $topics->image) }}" alt="{{ $topics->title }}"
                            class="w-full object-cover rounded-sm">
                    </div>
                @endif

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
@endsection
