<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Nama Kategori:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $category->name_232136 }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Destinasi dalam Kategori Ini:</h3>
                        @if($category->destinations->count() > 0)
                            <ul class="list-disc list-inside">
                                @foreach($category->destinations as $destination)
                                    <li class="text-gray-700 dark:text-gray-300">{{ $destination->name_232136 }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">Belum ada destinasi dalam kategori ini</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>