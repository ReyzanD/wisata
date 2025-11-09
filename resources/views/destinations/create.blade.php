<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Destinasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('destinations.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name_232136" :value="__('Nama Destinasi')" />
                            <x-text-input id="name_232136" class="block mt-1 w-full" type="text" name="name_232136" :value="old('name_232136')" required autofocus />
                            <x-input-error :messages="$errors->get('name_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="category_id_232136" :value="__('Kategori')" />
                            <select id="category_id_232136" name="category_id_232136" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id_232136') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_232136 }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="location_232136" :value="__('Lokasi')" />
                            <x-text-input id="location_232136" class="block mt-1 w-full" type="text" name="location_232136" :value="old('location_232136')" />
                            <x-input-error :messages="$errors->get('location_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="image_232136" :value="__('Gambar Utama')" />
                            <input id="image_232136" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="file" name="image_232136" accept="image/*" />
                            <x-input-error :messages="$errors->get('image_232136')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Max: 2MB (JPEG, PNG, JPG, GIF)</p>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description_232136" :value="__('Deskripsi')" />
                            <textarea id="description_232136" name="description_232136" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description_232136') }}</textarea>
                            <x-input-error :messages="$errors->get('description_232136')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('destinations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
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