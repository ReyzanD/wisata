<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Saya - Wisata Indonesia</title>
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
                    <a href="{{ route('bookings.index') }}" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">Booking Saya</a>
                    <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Dashboard</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Booking Saya</h1>
            <p class="text-gray-600 mt-2">Kelola dan pantau status booking destinasi wisata Anda</p>
        </div>

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

        @if($bookings->count() > 0)
            <div class="space-y-4">
                @foreach($bookings as $booking)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="md:flex">
                        <!-- Destination Image -->
                        <div class="md:w-48 md:flex-shrink-0">
                            @if($booking->destination->getImageUrl())
                                <img src="{{ $booking->destination->getImageUrl() }}" alt="{{ $booking->destination->name_232136 }}" class="h-full w-full object-cover md:h-full md:w-48">
                            @else
                                <div class="h-48 md:h-full w-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white text-6xl">📸</div>
                            @endif
                        </div>

                        <!-- Booking Details -->
                        <div class="p-6 flex-1">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $booking->destination->name_232136 }}</h3>
                                    <p class="text-sm text-gray-600">Kode Booking: <span class="font-mono font-semibold">{{ $booking->booking_code_232136 }}</span></p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $booking->getStatusBadgeClass() }}">
                                    {{ $booking->getStatusText() }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 text-sm">
                                <div>
                                    <p class="text-gray-600">Tanggal Kunjungan</p>
                                    <p class="font-semibold text-gray-900">{{ $booking->visit_date_232136->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Jumlah Orang</p>
                                    <p class="font-semibold text-gray-900">{{ $booking->number_of_people_232136 }} orang</p>
                                </div>
                                <div>
                                    <p class="text-gray-600">Tanggal Booking</p>
                                    <p class="font-semibold text-gray-900">{{ $booking->created_at->format('d M Y') }}</p>
                                </div>
                            </div>

                            @if($booking->special_requests_232136)
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs text-gray-600 font-semibold mb-1">Permintaan Khusus:</p>
                                <p class="text-sm text-gray-700">{{ $booking->special_requests_232136 }}</p>
                            </div>
                            @endif

                            <div class="flex gap-3">
                                <a href="{{ route('bookings.show', $booking->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-semibold">
                                    Lihat Detail
                                </a>
                                
                                @if($booking->status_232136 === 'pending')
                                <form method="POST" action="{{ route('bookings.cancel', $booking->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                    @csrf
                                    <button type="submit" class="bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200 text-sm font-semibold">
                                        Batalkan
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="text-6xl mb-4">📅</div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Booking</h3>
                <p class="text-gray-600 mb-6">Anda belum memiliki booking destinasi wisata</p>
                <a href="{{ route('public.destinations') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
                    Jelajahi Destinasi
                </a>
            </div>
        @endif
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
