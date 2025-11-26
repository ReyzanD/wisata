<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            Daftar Booking ({{ $bookings->total() }})
                        </h3>
                    </div>

                    @if($bookings->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Kode Booking
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Pengguna
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Destinasi
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Tanggal Kunjungan
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Jumlah
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($bookings as $booking)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-mono font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $booking->booking_code_232136 }}
                                            </span>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $booking->created_at->format('d M Y') }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $booking->user->name_232136 }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $booking->user->email_232136 }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                                {{ $booking->destination->name_232136 }}
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $booking->destination->location_232136 }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $booking->visit_date_232136->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $booking->number_of_people_232136 }} orang
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $booking->getStatusBadgeClass() }}">
                                                {{ $booking->getStatusText() }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center space-x-2" x-data="{ open: false }">
                                                <button @click="open = !open" class="text-blue-600 hover:text-blue-900 dark:text-blue-400">
                                                    Ubah Status
                                                </button>
                                                
                                                <div x-show="open" 
                                                     @click.away="open = false"
                                                     x-transition
                                                     class="absolute mt-2 bg-white dark:bg-gray-700 rounded-lg shadow-lg p-2 z-10">
                                                    <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->id) }}">
                                                        @csrf
                                                        <select name="status_232136" 
                                                                class="block w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-800 dark:text-gray-100"
                                                                onchange="this.form.submit()">
                                                            <option value="pending" {{ $booking->status_232136 == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                                            <option value="confirmed" {{ $booking->status_232136 == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                                            <option value="cancelled" {{ $booking->status_232136 == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                                        </select>
                                                    </form>
                                                </div>

                                                @if($booking->special_requests_232136)
                                                <button @click="$dispatch('open-modal', { content: '{{ addslashes($booking->special_requests_232136) }}' })" 
                                                        class="text-gray-600 hover:text-gray-900 dark:text-gray-400"
                                                        title="Lihat Permintaan Khusus">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">📅</div>
                            <p class="text-gray-500 dark:text-gray-400">Belum ada booking</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-yellow-100 dark:bg-yellow-900 rounded-lg shadow p-6">
                    <h4 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Menunggu Konfirmasi</h4>
                    <p class="text-3xl font-bold text-yellow-900 dark:text-yellow-100 mt-2">
                        {{ $bookings->where('status_232136', 'pending')->count() }}
                    </p>
                </div>
                
                <div class="bg-green-100 dark:bg-green-900 rounded-lg shadow p-6">
                    <h4 class="text-sm font-medium text-green-800 dark:text-green-200">Dikonfirmasi</h4>
                    <p class="text-3xl font-bold text-green-900 dark:text-green-100 mt-2">
                        {{ $bookings->where('status_232136', 'confirmed')->count() }}
                    </p>
                </div>
                
                <div class="bg-red-100 dark:bg-red-900 rounded-lg shadow p-6">
                    <h4 class="text-sm font-medium text-red-800 dark:text-red-200">Dibatalkan</h4>
                    <p class="text-3xl font-bold text-red-900 dark:text-red-100 mt-2">
                        {{ $bookings->where('status_232136', 'cancelled')->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
