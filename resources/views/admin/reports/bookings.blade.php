<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Booking & Pendapatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Filter Laporan</h3>
                        <form method="GET" action="{{ route('admin.reports.bookings') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="{{ $filters['start_date'] }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Selesai</label>
                                <input type="date" name="end_date" value="{{ $filters['end_date'] }}" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Destinasi</label>
                                <select name="destination_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
                                    <option value="">Semua Destinasi</option>
                                    @foreach($destinations as $destination)
                                        <option value="{{ $destination->id }}" {{ $filters['destination_id'] == $destination->id ? 'selected' : '' }}>
                                            {{ $destination->name_232136 }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-800 disabled:opacity-25 transition">
                                    Terapkan
                                </button>
                                <a href="{{ route('admin.reports.bookings.print', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-800 disabled:opacity-25 transition">
                                    Export PDF
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-blue-50 dark:bg-blue-900/40 rounded-lg">
                            <p class="text-sm text-blue-800 dark:text-blue-200 mb-1">Total Booking</p>
                            <p class="text-2xl font-bold text-blue-900 dark:text-blue-100">{{ $bookings->count() }}</p>
                        </div>
                        <div class="p-4 bg-green-50 dark:bg-green-900/40 rounded-lg">
                            <p class="text-sm text-green-800 dark:text-green-200 mb-1">Total Pendapatan (Dikonfirmasi)</p>
                            <p class="text-2xl font-bold text-green-900 dark:text-green-100">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-900/40 rounded-lg">
                            <p class="text-sm text-gray-800 dark:text-gray-200 mb-1">Destinasi Aktif</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $destinations->count() }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Ringkasan Pendapatan per Destinasi</h3>
                        @if($revenueData->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-900">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Destinasi</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Booking</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Orang</th>
                                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($revenueData as $data)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $data['destination']->name_232136 ?? '-' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900 dark:text-gray-100">
                                                    {{ $data['total_bookings'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900 dark:text-gray-100">
                                                    {{ $data['total_people'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-900 dark:text-gray-100">
                                                    Rp {{ number_format($data['total_amount'], 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-300">Belum ada data pendapatan untuk filter yang dipilih.</p>
                        @endif
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Detail Booking</h3>
                        @if($bookings->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-900">
                                        <tr>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kode</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Kunjungan</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Destinasi</th>
                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pengguna</th>
                                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Orang</th>
                                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($bookings as $booking)
                                            <tr>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $booking->booking_code_232136 }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ optional($booking->visit_date_232136)->format('d M Y') }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $booking->destination->name_232136 ?? '-' }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $booking->user->name_232136 ?? '-' }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-right text-gray-900 dark:text-gray-100">
                                                    {{ $booking->number_of_people_232136 }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-right text-gray-900 dark:text-gray-100">
                                                    Rp {{ number_format($booking->total_price_232136, 0, ',', '.') }}
                                                </td>
                                                <td class="px-4 py-4 whitespace-nowrap text-sm text-center">
                                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $booking->getStatusBadgeClass() }}">
                                                        {{ $booking->getStatusText() }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-300">Belum ada data booking untuk filter yang dipilih.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
