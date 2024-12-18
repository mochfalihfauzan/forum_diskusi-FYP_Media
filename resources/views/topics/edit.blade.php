@extends('layouts.main')
@section('content')
    <div class="flex justify-center items-center h-screen mb-10">

        @if (Auth::user()->id == $topics->user_id || Auth::user()->role == 'admin')
            <div class="w-3/4 md:w-2/3 bg-white p-6 rounded-xl shadow-md border">
                @if (session('success'))
                    <div class="bg-green-500 text-white p-3 rounded-md shadow-sm mb-3">
                        {{ session('success') }}
                    </div>
                @endif
                <h1 class="text-2xl font-semibold text-gray-700">Edit Topik</h1>
                <form action="{{ route('topics.update', $topics->id) }}" method="POST" enctype="multipart/form-data"
                    class="mt-6">
                    @csrf
                    @method('PUT')
                    <input type="text" name="title" placeholder="Judul Topik"
                        class="w-full bg-gray-100 p-2 rounded-xl border border-gray-100 focus:outline-none focus:border-gray-300"
                        value="{{ old('title', $topics->title) }}">
                    @error('title')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                    <input type="hidden" name="oldImage" value="{{ $topics->image }}">

                    <input type="file" name="image"
                        class="w-full bg-gray-100 p-2 rounded-xl border border-gray-100 focus:outline-none focus:border-gray-300 mt-4">
                    @error('image')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                    <textarea name="content" placeholder="Konten Topik"
                        class="w-full bg-gray-100 p-2 rounded-xl border border-gray-100 focus:outline-none focus:border-gray-300 mt-4 max-h-96 min-h-20"
                        rows="4">{{ old('title', $topics->content) }}</textarea>
                    @error('content')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                    <button type="submit"
                        class="w-full bg-blue-700 text-white px-5 py-3 rounded-xl shadow-md mt-6 hover:bg-blue-800 hover:shadow-xl">Update
                        Topik</button>
                </form>
            </div>
        @else
            <div class="flex justify-center items-center w-full h-screen mb-10">
                <div class="w-3/4 md:w-2/3 bg-red-500 text-white p-6 rounded-xl shadow-md border">
                    <p class="text-center"><i class="fa-solid fa-triangle-exclamation mx-2"></i>Anda Tidak memiliki Akses<i
                            class="fa-solid fa-triangle-exclamation mx-2"></i></p>
                </div>
            </div>
        @endif
    </div>

@endsection
