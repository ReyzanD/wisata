<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Judul:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $gallery->title_232136 }}</p>
                    </div>

                    @if($gallery->image_232136)
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Gambar:</h3>
                        <p class="text-gray-700 dark:text-gray-300">File: {{ $gallery->image_232136 }}</p>
                    </div>
                    @endif

                    @if($gallery->url_232136)
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">URL:</h3>
                        <a href="{{ $gallery->url_232136 }}" target="_blank" class="text-blue-500 hover:underline">{{ $gallery->url_232136 }}</a>
                    </div>
                    @endif

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Destinasi:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $gallery->destination->name_232136 ?? '-' }}</p>
                    </div>

                    @if($gallery->getImageUrl())
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Preview Gambar:</h3>
                        <img src="{{ $gallery->getImageUrl() }}" alt="{{ $gallery->title_232136 }}" class="mt-2 max-w-md rounded shadow">
                    </div>
                    @endif

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('galleries.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>