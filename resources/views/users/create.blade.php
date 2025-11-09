<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="name_232136" :value="__('Nama')" />
                            <x-text-input id="name_232136" class="block mt-1 w-full" type="text" name="name_232136" :value="old('name_232136')" required autofocus />
                            <x-input-error :messages="$errors->get('name_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email_232136" :value="__('Email')" />
                            <x-text-input id="email_232136" class="block mt-1 w-full" type="email" name="email_232136" :value="old('email_232136')" required />
                            <x-input-error :messages="$errors->get('email_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="password_232136" :value="__('Password')" />
                            <x-text-input id="password_232136" class="block mt-1 w-full" type="password" name="password_232136" required />
                            <x-input-error :messages="$errors->get('password_232136')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="role" :value="__('Role')" />
                            <select id="role" name="role" required class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
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