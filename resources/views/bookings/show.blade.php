<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Booking - Wisata Indonesia</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ open: false }">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-bold text-blue-600">Wisata</span>
                        <span class="text-2xl font-bold text-gray-800">Indonesia</span>
                    </a>
                </div>
                <div class="hidden sm:flex sm:items-center sm:space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Beranda</a>
                    <a href="{{ route('public.destinations') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Destinasi</a>
                    <a href="{{ route('bookings.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Booking Saya</a>
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Success Message -->
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

        <!-- Booking Confirmation Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Booking Berhasil!</h1>
                        <p class="text-blue-100">Simpan kode booking Anda untuk referensi</p>
                    </div>
                    <div class="text-6xl">✓</div>
                </div>
            </div>

            <!-- Booking Code -->
            <div class="p-6 bg-blue-50 border-b border-blue-200">
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-2">Kode Booking</p>
                    <p class="text-3xl font-bold text-blue-600 font-mono">{{ $booking->booking_code_232136 }}</p>
                    <div class="mt-3">
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold {{ $booking->getStatusBadgeClass() }}">
                            {{ $booking->getStatusText() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Destination Details -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Detail Destinasi</h2>
                
                <div class="flex gap-4">
                    @if($booking->destination->getImageUrl())
                        <img src="{{ $booking->destination->getImageUrl() }}" alt="{{ $booking->destination->name_232136 }}" class="w-32 h-32 object-cover rounded-lg">
                    @else
                        <div class="w-32 h-32 bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg flex items-center justify-center text-white text-4xl">📸</div>
                    @endif

                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $booking->destination->name_232136 }}</h3>
                        <div class="space-y-1 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                {{ $booking->destination->location_232136 ?? 'Indonesia' }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                </svg>
                                {{ $booking->destination->category->name_232136 ?? 'Umum' }}
                            </div>
                        </div>
                        <a href="{{ route('public.destination.show', $booking->destination->id) }}" class="inline-block mt-3 text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Lihat Detail Destinasi →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Booking Information -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Informasi Booking</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Tanggal Kunjungan</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $booking->visit_date_232136->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Jumlah Orang</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $booking->number_of_people_232136 }} orang</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Tanggal Booking</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $booking->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Status</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $booking->getStatusText() }}</p>
                    </div>
                </div>

                @if($booking->special_requests_232136)
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-600 font-semibold mb-2">Permintaan Khusus:</p>
                    <p class="text-gray-700">{{ $booking->special_requests_232136 }}</p>
                </div>
                @endif
            </div>

            <!-- Important Information -->
            <div class="p-6 bg-yellow-50 border-b border-yellow-200">
                <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    Informasi Penting
                </h3>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li class="flex items-start">
                        <span class="mr-2">•</span>
                        <span>Booking Anda akan diproses dan dikonfirmasi oleh admin dalam 1-2 hari kerja</span>
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2">•</span>
                        <span>Anda akan menerima notifikasi melalui email saat status booking berubah</span>
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2">•</span>
                        <span>Harap datang 15 menit sebelum waktu kunjungan yang telah dijadwalkan</span>
                    </li>
                    <li class="flex items-start">
                        <span class="mr-2">•</span>
                        <span>Bawa kode booking ini saat melakukan kunjungan</span>
                    </li>
                </ul>
            </div>

            <!-- Actions -->
            <div class="p-6 flex gap-4">
                <a href="{{ route('bookings.index') }}" class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 text-center font-semibold">
                    Lihat Semua Booking
                </a>
                
                @if($booking->status_232136 === 'pending')
                <form method="POST" action="{{ route('bookings.cancel', $booking->id) }}" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                    @csrf
                    <button type="submit" class="w-full bg-red-100 text-red-700 px-6 py-3 rounded-lg hover:bg-red-200 font-semibold">
                        Batalkan Booking
                    </button>
                </form>
                @endif
            </div>
        </div>

        <!-- Additional Actions -->
        <div class="mt-6 text-center">
            <a href="{{ route('public.destinations') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                ← Jelajahi Destinasi Lainnya
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Wisata Indonesia. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
