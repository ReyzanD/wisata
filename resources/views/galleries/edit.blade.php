<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('galleries.update', $gallery->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="title_232136" :value="__('Judul')" />
                            <x-text-input id="title_232136" class="block mt-1 w-full" type="text" name="title_232136" :value="old('title_232136', $gallery->title_232136)" required autofocus />
                            <x-input-error :messages="$errors->get('title_232136')" class="mt-2" />
                        </div>

                        @if($gallery->image_232136)
                        <div class="mb-4">
                            <x-input-label :value="__('Gambar Saat Ini')" />
                            <img src="{{ asset('storage/galleries/' . $gallery->image_232136) }}" alt="{{ $gallery->title_232136 }}" class="mt-2 h-40 object-cover rounded">
                        </div>
                        @endif

                        <div class="mb-4">
                            <x-input-label for="image_232136" :value="__('Upload Gambar Baru')" />
                            <input id="image_232136" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="file" name="image_232136" accept="image/*" />
                            <x-input-error :messages="$errors->get('image_232136')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Max: 2MB (JPEG, PNG, JPG, GIF) - Kosongkan jika tidak ingin mengubah</p>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="url_232136" :value="__('Atau URL Gambar (Opsional)')" />
                            <x-text-input id="url_232136" class="block mt-1 w-full" type="url" name="url_232136" :value="old('url_232136', $gallery->url_232136)" />
                            <x-input-error :messages="$errors->get('url_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="destination_id_232136" :value="__('Destinasi')" />
                            <select id="destination_id_232136" name="destination_id_232136" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Pilih Destinasi</option>
                                @foreach($destinations as $destination)
                                    <option value="{{ $destination->id }}" {{ old('destination_id_232136', $gallery->destination_id_232136) == $destination->id ? 'selected' : '' }}>
                                        {{ $destination->name_232136 }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('destination_id_232136')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('galleries.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
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