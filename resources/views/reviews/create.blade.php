<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Ulasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="user_name_232136" :value="__('Nama User')" />
                            <x-text-input id="user_name_232136" class="block mt-1 w-full" type="text" name="user_name_232136" :value="old('user_name_232136')" required autofocus />
                            <x-input-error :messages="$errors->get('user_name_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="destination_id_232136" :value="__('Destinasi')" />
                            <select id="destination_id_232136" name="destination_id_232136" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Pilih Destinasi</option>
                                @foreach($destinations as $destination)
                                    <option value="{{ $destination->id }}" {{ old('destination_id_232136') == $destination->id ? 'selected' : '' }}>
                                        {{ $destination->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('destination_id_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="rating_232136" :value="__('Rating (1-5)')" />
                            <select id="rating_232136" name="rating_232136" required class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Pilih Rating</option>
                                <option value="1" {{ old('rating_232136') == 1 ? 'selected' : '' }}> 1</option>
                                <option value="2" {{ old('rating_232136') == 2 ? 'selected' : '' }}> 2</option>
                                <option value="3" {{ old('rating_232136') == 3 ? 'selected' : '' }}> 3</option>
                                <option value="4" {{ old('rating_232136') == 4 ? 'selected' : '' }}> 4</option>
                                <option value="5" {{ old('rating_232136') == 5 ? 'selected' : '' }}> 5</option>
                            </select>
                            <x-input-error :messages="$errors->get('rating_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="comment_232136" :value="__('Komentar')" />
                            <textarea id="comment_232136" name="comment_232136" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('comment_232136') }}</textarea>
                            <x-input-error :messages="$errors->get('comment_232136')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('reviews.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>