<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Destinasi Wisata - Wisata Indonesia</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" x-data="{ open: false }">
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
                    <a href="{{ route('public.destinations') }}" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">Destinasi</a>
                    @auth
                        <a href="{{ route('favorites.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">❤️ Favorit</a>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Login</a>
                    @endauth
                </div>
                <div class="flex items-center sm:hidden">
                    <button @click="open = !open" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Beranda</a>
                <a href="{{ route('public.destinations') }}" class="block px-3 py-2 text-base font-medium text-blue-600 bg-blue-50 rounded-md">Destinasi</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">Jelajahi Destinasi Wisata</h1>
            <p class="text-xl text-blue-100">Temukan tempat wisata impian Anda</p>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white shadow-md -mt-8 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <form method="GET" action="{{ route('public.destinations') }}" class="flex flex-col gap-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari destinasi atau lokasi..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="md:w-64">
                        <select name="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_232136 }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition whitespace-nowrap">
                        Cari
                    </button>
                </div>
                
                <!-- Sort Options -->
                <div class="flex items-center gap-3 pt-2 border-t border-gray-200">
                    <label class="text-sm font-medium text-gray-700 whitespace-nowrap">Urutkan:</label>
                    <select name="sort" onchange="this.form.submit()" class="flex-1 md:flex-none md:w-56 px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                        <option value="highest_rated" {{ request('sort') == 'highest_rated' ? 'selected' : '' }}>Rating Tertinggi</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Destinations Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Results Info -->
        <div class="mb-6 flex items-center justify-between">
            <p class="text-gray-600">
                Menampilkan <span class="font-semibold">{{ $destinations->count() }}</span> dari <span class="font-semibold">{{ $destinations->total() }}</span> destinasi
                @if(request('search'))
                    untuk "<span class="font-semibold text-blue-600">{{ request('search') }}</span>"
                @endif
                @if(request('category'))
                    @php
                        $selectedCategory = $categories->find(request('category'));
                    @endphp
                    @if($selectedCategory)
                        dalam kategori <span class="font-semibold text-blue-600">{{ $selectedCategory->name_232136 }}</span>
                    @endif
                @endif
            </p>
        </div>

        @if($destinations->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($destinations as $destination)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition relative">
                    <a href="{{ route('public.destination.show', $destination->id) }}">
                        <div class="h-48 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                            @if($destination->getImageUrl())
                                <img src="{{ $destination->getImageUrl() }}" alt="{{ $destination->name_232136 }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-white text-6xl">📸</span>
                            @endif
                        </div>
                    </a>
                    
                    <!-- Favorite Button -->
                    @auth
                    <button 
                        @click="toggleFavorite({{ $destination->id }})"
                        x-data="{ 
                            favorited: {{ auth()->user()->favoriteDestinations->contains($destination->id) ? 'true' : 'false' }},
                            toggleFavorite(id) {
                                fetch(`/favorites/toggle/${id}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    this.favorited = !this.favorited;
                                    window.dispatchEvent(new CustomEvent('toast', {
                                        detail: { message: data.message, type: data.status === 'added' ? 'success' : 'info' }
                                    }));
                                });
                            }
                        }"
                        class="absolute top-4 right-4 bg-white p-2 rounded-full shadow-lg hover:scale-110 transition z-10">
                        <svg class="w-6 h-6 transition" :class="favorited ? 'text-red-500 fill-current' : 'text-gray-400'" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path :fill="favorited ? 'currentColor' : 'none'" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" stroke-width="2"/>
                        </svg>
                    </button>
                    @endauth
                    
                    <a href="{{ route('public.destination.show', $destination->id) }}">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-3 py-1 rounded-full">
                                {{ $destination->category->name_232136 ?? 'Umum' }}
                            </span>
                            @if($destination->getReviewCount() > 0)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-sm font-semibold text-gray-700">{{ $destination->getAverageRating() }}</span>
                                <span class="text-xs text-gray-500 ml-1">({{ $destination->getReviewCount() }})</span>
                            </div>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $destination->name_232136 }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($destination->description_232136, 120) }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                {{ $destination->location_232136 ?? 'Indonesia' }}
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">Mulai dari</p>
                                <p class="text-lg font-bold text-green-600">Rp {{ number_format($destination->price_232136, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $destinations->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Tidak Ada Destinasi Ditemukan</h3>
                <p class="text-gray-600">Coba ubah kata kunci pencarian atau filter Anda</p>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Wisata Indonesia</h3>
                    <p class="text-gray-400">Jelajahi keindahan destinasi wisata Indonesia</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Menu</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Beranda</a></li>
                        <li><a href="{{ route('public.destinations') }}" class="text-gray-400 hover:text-white">Destinasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <p class="text-gray-400">Email: info@wisata.com</p>
                    <p class="text-gray-400">Telp: +62 123 4567 890</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Wisata Indonesia. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Toast Notification -->
    <div id="toast-container" x-data="{
        show: false,
        message: '',
        type: 'success',
        init() {
            @if(session('success'))
                this.showToast('{{ session('success') }}', 'success');
            @elseif(session('error'))
                this.showToast('{{ session('error') }}', 'error');
            @elseif(session('warning'))
                this.showToast('{{ session('warning') }}', 'warning');
            @elseif(session('info'))
                this.showToast('{{ session('info') }}', 'info');
            @endif
        },
        showToast(message, type = 'success') {
            this.message = message;
            this.type = type;
            this.show = true;
            setTimeout(() => { this.show = false; }, 5000);
        }
    }" 
    @toast.window="showToast($event.detail.message, $event.detail.type)"
    x-cloak>
        
        <div x-show="show" 
             x-transition:enter="transform ease-out duration-300 transition"
             x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
             x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="max-w-sm w-full shadow-lg rounded-lg pointer-events-auto overflow-hidden"
             :class="{
                'bg-green-50 border-l-4 border-green-500': type === 'success',
                'bg-red-50 border-l-4 border-red-500': type === 'error',
                'bg-yellow-50 border-l-4 border-yellow-500': type === 'warning',
                'bg-blue-50 border-l-4 border-blue-500': type === 'info'
             }">
            
            <div class="p-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg x-show="type === 'success'" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="type === 'error'" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <svg x-show="type === 'warning'" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <svg x-show="type === 'info'" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    
                    <div class="ml-3 w-0 flex-1 pt-0.5">
                        <p class="text-sm font-medium" 
                           :class="{
                              'text-green-900': type === 'success',
                              'text-red-900': type === 'error',
                              'text-yellow-900': type === 'warning',
                              'text-blue-900': type === 'info'
                           }"
                           x-text="message"></p>
                    </div>
                    
                    <div class="ml-4 flex-shrink-0 flex">
                        <button @click="show = false" 
                                class="inline-flex rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2"
                                :class="{
                                   'text-green-500 hover:text-green-600 focus:ring-green-500': type === 'success',
                                   'text-red-500 hover:text-red-600 focus:ring-red-500': type === 'error',
                                   'text-yellow-500 hover:text-yellow-600 focus:ring-yellow-500': type === 'warning',
                                   'text-blue-500 hover:text-blue-600 focus:ring-blue-500': type === 'info'
                                }">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>