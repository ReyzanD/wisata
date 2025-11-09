<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Nama:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $user->name }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Email:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $user->email }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Role:</h3>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role == 'admin' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Terdaftar Sejak:</h3>
                        <p class="text-gray-700 dark:text-gray-300">{{ $user->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>