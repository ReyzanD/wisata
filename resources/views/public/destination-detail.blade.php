<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $destination->name_232136 }} - Wisata Indonesia</title>
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
                    <a href="{{ route('public.destinations') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 text-sm font-medium">Destinasi</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Dashboard</a>
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
                <a href="{{ route('public.destinations') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 rounded-md">Destinasi</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-gray-50 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('public.destinations') }}" class="hover:text-blue-600">Destinasi</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">{{ $destination->name_232136 }}</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Column -->
            <div class="lg:col-span-2">
                <!-- Hero Image -->
                <div class="mb-8">
                    @if($destination->getImageUrl())
                        <img src="{{ $destination->getImageUrl() }}" alt="{{ $destination->name_232136 }}" class="w-full h-96 object-cover rounded-lg shadow-lg">
                    @else
                        <div class="w-full h-96 bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg shadow-lg flex items-center justify-center">
                            <span class="text-white text-8xl">📸</span>
                        </div>
                    @endif
                </div>

                <!-- Title and Category -->
                <div class="mb-6">
                    <span class="inline-block text-sm font-semibold text-blue-600 bg-blue-100 px-4 py-2 rounded-full mb-4">
                        {{ $destination->category->name_232136 ?? 'Umum' }}
                    </span>
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $destination->name_232136 }}</h1>
                    
                    <div class="flex items-center gap-4 mb-4">
                        @if($destination->getReviewCount() > 0)
                        <div class="flex items-center bg-yellow-50 px-4 py-2 rounded-lg">
                            <div class="flex items-center mr-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $destination->getAverageRating() ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xl font-bold text-gray-900">{{ $destination->getAverageRating() }}</span>
                            <span class="text-gray-600 ml-2">({{ $destination->getReviewCount() }} ulasan)</span>
                        </div>
                        @endif
                        
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            {{ $destination->location_232136 ?? 'Indonesia' }}
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="prose max-w-none mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Tentang Destinasi</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $destination->description_232136 }}</p>
                </div>

                <!-- Gallery -->
                @if($destination->galleries->count() > 1)
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Galeri Foto</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($destination->galleries as $gallery)
                            @if($gallery->getImageUrl())
                                <img src="{{ $gallery->getImageUrl() }}" alt="{{ $gallery->title_232136 }}" class="w-full h-48 object-cover rounded-lg shadow-md hover:shadow-xl transition">
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Reviews -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Ulasan Pengunjung</h2>
                    @if($destination->reviews->count() > 0)
                        <div class="space-y-4">
                            @foreach($destination->reviews as $review)
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($review->user_name_232136, 0, 1)) }}
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="font-semibold text-gray-900">{{ $review->user_name_232136 }}</h4>
                                            <p class="text-sm text-gray-500">{{ $review->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $review->rating_232136 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-700">{{ $review->comment_232136 }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">Belum ada ulasan untuk destinasi ini.</p>
                    @endif

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mt-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Review Form for Authenticated Users -->
                    @auth
                        @php
                            $userHasReviewed = $destination->reviews->where('user_id_232136', auth()->id())->count() > 0;
                        @endphp
                        
                        @if(!$userHasReviewed)
                            <div class="mt-8 bg-gray-50 p-6 rounded-lg border-2 border-blue-200" x-data="{ rating: 5 }">
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Tulis Ulasan Anda</h3>
                                <form method="POST" action="{{ route('destination.review.store', $destination->id) }}">
                                    @csrf
                                    
                                    <!-- Rating -->
                                    <fieldset class="mb-4">
                                        <legend class="block text-sm font-medium text-gray-700 mb-2">Rating *</legend>
                                        <div class="flex gap-1" role="group" aria-label="Pilih rating">
                                            @foreach([1, 2, 3, 4, 5] as $star)
                                            <button type="button" 
                                                    @click="rating = {{ $star }}" 
                                                    class="focus:outline-none p-1"
                                                    aria-label="Rating {{ $star }} dari 5">
                                                <svg class="w-8 h-8 cursor-pointer transition-colors" 
                                                     :class="rating >= {{ $star }} ? 'text-yellow-400' : 'text-gray-300'" 
                                                     fill="currentColor" 
                                                     viewBox="0 0 20 20"
                                                     aria-hidden="true">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            </button>
                                            @endforeach
                                            <input type="hidden" name="rating_232136" x-model="rating" value="5" required>
                                        </div>
                                        @error('rating_232136')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </fieldset>

                                    <!-- Comment -->
                                    <div class="mb-4">
                                        <label for="comment_232136" class="block text-sm font-medium text-gray-700 mb-2">Komentar *</label>
                                        <textarea name="comment_232136" 
                                                  id="comment_232136" 
                                                  rows="4" 
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                                  placeholder="Ceritakan pengalaman Anda di destinasi ini (minimal 10 karakter)..." 
                                                  required>{{ old('comment_232136') }}</textarea>
                                        @error('comment_232136')
                                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        Kirim Ulasan
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="mt-8 bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <p class="text-blue-800">✓ Anda sudah memberikan ulasan untuk destinasi ini.</p>
                            </div>
                        @endif
                    @else
                        <div class="mt-8 bg-gray-50 p-6 rounded-lg border-2 border-gray-200 text-center">
                            <p class="text-gray-700 mb-3">Ingin memberikan ulasan?</p>
                            <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                Login untuk Menulis Ulasan
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Related Destinations -->
                @if($relatedDestinations->count() > 0)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Destinasi Terkait</h3>
                    <div class="space-y-4">
                        @foreach($relatedDestinations as $related)
                        <a href="{{ route('public.destination.show', $related->id) }}" class="block group">
                            <div class="flex gap-3">
                                <div class="w-20 h-20 flex-shrink-0">
                                    @if($related->getImageUrl())
                                        <img src="{{ $related->getImageUrl() }}" alt="{{ $related->name_232136 }}" class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg flex items-center justify-center text-white text-2xl">📸</div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition">{{ $related->name_232136 }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $related->location_232136 }}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
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
</body>
</html>