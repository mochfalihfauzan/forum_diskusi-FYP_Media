@extends('layouts.main')
@section('content')
    <div class="flex justify-center items-center h-screen mb-10">
        <div class="w-3/4 md:w-2/3 bg-white p-6 rounded-xl shadow-md border">
            <h1 class="text-2xl font-semibold text-gray-700">Buat Topik Baru</h1>
            <form action="{{ route('topics.store') }}" method="POST" class="mt-6" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" placeholder="Judul Topik"
                    class="w-full bg-gray-100 p-2 rounded-xl border border-gray-100 focus:outline-none focus:border-gray-300"
                    required>
                @error('title')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
                <input type="file" name="image"
                    class="w-full bg-gray-100 p-2 rounded-xl border border-gray-100 focus:outline-none focus:border-gray-300 mt-4">
                <textarea name="content" placeholder="Konten Topik"
                    class="w-full bg-gray-100 p-2 rounded-xl border border-gray-100 focus:outline-none focus:border-gray-300 mt-4 max-h-96 min-h-20"
                    rows="4" required></textarea>
                @error('title')
                    <div class="text-sm text-red-400">{{ $message }}</div>
                @enderror
                <button type="submit"
                    class="w-full bg-blue-700 text-white px-5 py-3 rounded-xl shadow-md mt-6 hover:bg-blue-800 hover:shadow-xl">Buat
                    Topik</button>
            </form>
        </div>
    </div>
@endsection
