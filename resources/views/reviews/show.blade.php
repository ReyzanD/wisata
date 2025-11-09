<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Ulasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Nama User:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $review->user_name_232136 }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Destinasi:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $review->destination->name_232136 ?? '-' }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Rating:</h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            <span class="text-yellow-500 text-2xl">{{ str_repeat('⭐', $review->rating_232136) }}</span>
                            <span class="ml-2">({{ $review->rating_232136 }}/5)</span>
                        </p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Komentar:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $review->comment_232136 ?? '-' }}</p>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('reviews.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>