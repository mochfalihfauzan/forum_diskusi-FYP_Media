<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex mt-16">
        @include('partials.sidebar')
        <div class="py-5 w-4/5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 ">
                        <h2 class="text-xl font-semibold">Halo, {{ Auth::user()->name }}</h2>
                        <div class="flex flex-col gap-3 my-5">
                            <div class="flex w-full gap-5">
                                <div class="border w-1/3 px-5 py-3 rounded-lg bg-sky-600 h-24 text-white">
                                    <p class="text-2xl">{{ $topics->count() }} Topik</p>
                                </div>
                                <div class="border w-1/3 px-5 py-3 rounded-lg bg-green-600 h-24 text-white">
                                    <p class="text-2xl">{{ $topics->count() }} Topik</p>
                                </div>
                                <div class="border w-1/3 px-5 py-3 rounded-lg bg-red-600 h-24 text-white">
                                    <p class="text-2xl">{{ $topics->count() }} Topik</p>
                                </div>
                            </div>

                            @foreach ($topics as $topic)
                                <div class="border w-1/3 min-h-40 shadow rounded-lg py-3 px-5">
                                    <div class="min-h-40">
                                        <p class="text-lg font-semibold">{{ $topic->title }}</p>
                                        <p class="text-base">{{ $topic->content }}</p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <p class="text-xs text-slate-600 ">3 jam yang lalu</p>
                                        <div>
                                            <i class="fa-regular fa-comment"></i>
                                            <i class="fa-regular fa-heart"></i>
                                            <i class="fa-solid fa-share"></i>
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

</x-app-layout>
