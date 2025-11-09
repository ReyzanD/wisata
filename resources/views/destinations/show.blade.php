<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Destinasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Nama Destinasi:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $destination->name_232136 }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Kategori:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $destination->category->name_232136 ?? '-' }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Lokasi:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $destination->location_232136 ?? '-' }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Deskripsi:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $destination->description_232136 ?? '-' }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Galeri ({{ $destination->galleries->count() }}):</h3>
                        @if($destination->galleries->count() > 0)
                            <div class="grid grid-cols-3 gap-4 mt-2">
                                @foreach($destination->galleries as $gallery)
                                    <div class="border rounded p-2">
                                        <p class="text-sm">{{ $gallery->title_232136 }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">Belum ada galeri</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Review ({{ $destination->reviews->count() }}):</h3>
                        @if($destination->reviews->count() > 0)
                            <ul class="list-disc list-inside">
                                @foreach($destination->reviews as $review)
                                    <li class="text-gray-700 dark:text-gray-300">
                                        Rating: {{ $review->rating_232136 }}/5 - {{ $review->comment_232136 }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">Belum ada review</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('destinations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>