<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Destinasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('destinations.update', $destination->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="name_232136" :value="__('Nama Destinasi')" />
                            <x-text-input id="name_232136" class="block mt-1 w-full" type="text" name="name_232136" :value="old('name_232136', $destination->name_232136)" required autofocus />
                            <x-input-error :messages="$errors->get('name_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="category_id_232136" :value="__('Kategori')" />
                            <select id="category_id_232136" name="category_id_232136" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id_232136', $destination->category_id_232136) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_232136 }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="location_232136" :value="__('Lokasi')" />
                            <x-text-input id="location_232136" class="block mt-1 w-full" type="text" name="location_232136" :value="old('location_232136', $destination->location_232136)" />
                            <x-input-error :messages="$errors->get('location_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="price_232136" :value="__('Harga (per orang)')" />
                            <x-text-input id="price_232136" class="block mt-1 w-full" type="number" name="price_232136" :value="old('price_232136', $destination->price_232136)" min="0" step="0.01" required />
                            <x-input-error :messages="$errors->get('price_232136')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Harga tiket masuk per orang dalam Rupiah</p>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="daily_capacity_232136" :value="__('Kapasitas Harian')" />
                            <x-text-input id="daily_capacity_232136" class="block mt-1 w-full" type="number" name="daily_capacity_232136" :value="old('daily_capacity_232136', $destination->daily_capacity_232136)" min="1" required />
                            <x-input-error :messages="$errors->get('daily_capacity_232136')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Jumlah maksimal pengunjung per hari</p>
                        </div>

                        @if($destination->image_232136)
                        <div class="mb-4">
                            <x-input-label :value="__('Gambar Saat Ini')" />
                            <img src="{{ asset('storage/destinations/' . $destination->image_232136) }}" alt="{{ $destination->name_232136 }}" class="mt-2 h-40 object-cover rounded">
                        </div>
                        @endif

                        <div class="mb-4">
                            <x-input-label for="image_232136" :value="__('Upload Gambar Baru')" />
                            <input id="image_232136" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="file" name="image_232136" accept="image/*" />
                            <x-input-error :messages="$errors->get('image_232136')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Max: 2MB (JPEG, PNG, JPG, GIF) - Kosongkan jika tidak ingin mengubah</p>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description_232136" :value="__('Deskripsi')" />
                            <textarea id="description_232136" name="description_232136" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description_232136', $destination->description_232136) }}</textarea>
                            <x-input-error :messages="$errors->get('description_232136')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('destinations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>