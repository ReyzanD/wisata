<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking {{ $destination->name_232136 }} - Wisata Indonesia</title>
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
        <!-- Breadcrumb -->
        <div class="mb-6">
            <div class="flex items-center text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('public.destinations') }}" class="hover:text-blue-600">Destinasi</a>
                <span class="mx-2">/</span>
                <a href="{{ route('public.destination.show', $destination->id) }}" class="hover:text-blue-600">{{ $destination->name_232136 }}</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Booking</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Booking Form -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-6">Formulir Booking</h1>

                    <form method="POST" action="{{ route('bookings.store', $destination->id) }}" 
                          x-data="{ 
                              loading: false, 
                              numberOfPeople: {{ old('number_of_people_232136', 1) }},
                              pricePerPerson: {{ $destination->price_232136 }},
                              selectedDate: '{{ old('visit_date_232136') }}',
                              availableCapacity: null,
                              checkingCapacity: false,
                              dailyCapacity: {{ $destination->daily_capacity_232136 }},
                              get totalPrice() {
                                  return this.numberOfPeople * this.pricePerPerson;
                              },
                              formatPrice(price) {
                                  return new Intl.NumberFormat('id-ID').format(price);
                              },
                              async checkCapacity() {
                                  if (!this.selectedDate) return;
                                  this.checkingCapacity = true;
                                  try {
                                      const response = await fetch(`/api/destinations/{{ $destination->id }}/capacity?date=${this.selectedDate}`);
                                      const data = await response.json();
                                      this.availableCapacity = data.available_capacity;
                                  } catch (error) {
                                      console.error('Error checking capacity:', error);
                                  }
                                  this.checkingCapacity = false;
                              }
                          }" 
                          @submit="loading = true"
                          x-init="if(selectedDate) checkCapacity()">
                        @csrf

                        <!-- Visit Date -->
                        <div class="mb-6">
                            <label for="visit_date_232136" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kunjungan *</label>
                            <input type="date" 
                                   name="visit_date_232136" 
                                   id="visit_date_232136" 
                                   x-model="selectedDate"
                                   @change="checkCapacity()"
                                   min="{{ date('Y-m-d') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required
                                   x-bind:readonly="loading">
                            @error('visit_date_232136')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            
                            <!-- Capacity Info -->
                            <div x-show="selectedDate" class="mt-2">
                                <div x-show="checkingCapacity" class="text-sm text-gray-600 flex items-center">
                                    <svg class="animate-spin h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memeriksa kapasitas...
                                </div>
                                <div x-show="!checkingCapacity && availableCapacity !== null" class="text-sm">
                                    <div x-show="availableCapacity > 0" class="p-3 bg-green-50 border-2 border-green-300 rounded-lg">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="text-green-800 font-bold">Slot Tersedia</span>
                                            </div>
                                            <span class="text-2xl font-bold text-green-700" x-text="availableCapacity"></span>
                                        </div>
                                        <div class="text-xs text-green-700 space-y-1">
                                            <p>✓ Anda dapat memesan hingga <strong x-text="availableCapacity"></strong> orang untuk tanggal ini</p>
                                            <p class="text-green-600">Total kapasitas: <span x-text="dailyCapacity"></span> orang/hari</p>
                                        </div>
                                    </div>
                                    <div x-show="availableCapacity === 0" class="flex items-center p-3 bg-red-50 border-2 border-red-300 rounded">
                                        <svg class="w-6 h-6 text-red-600 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-red-700 font-bold">
                                            PENUH - Tidak ada slot tersedia untuk tanggal ini
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Number of People -->
                        <div class="mb-6">
                            <label for="number_of_people_232136" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Orang *</label>
                            <input type="number" 
                                   name="number_of_people_232136" 
                                   id="number_of_people_232136" 
                                   x-model.number="numberOfPeople"
                                   min="1"
                                   max="50"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                   required
                                   x-bind:readonly="loading">
                            @error('number_of_people_232136')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-600 mt-1">Maksimal 50 orang per booking</p>
                        </div>

                        <!-- Price Summary -->
                        <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg border-2 border-blue-200">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-700">Harga per orang:</span>
                                <span class="text-sm font-semibold text-gray-900">Rp <span x-text="formatPrice(pricePerPerson)"></span></span>
                            </div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-700">Jumlah orang:</span>
                                <span class="text-sm font-semibold text-gray-900"><span x-text="numberOfPeople"></span> orang</span>
                            </div>
                            <div x-show="selectedDate && availableCapacity !== null" class="flex justify-between items-center mb-2 text-xs">
                                <span class="text-gray-600">Sisa slot tersedia:</span>
                                <span class="font-bold" :class="availableCapacity > 0 ? 'text-green-600' : 'text-red-600'">
                                    <span x-text="availableCapacity"></span> orang
                                </span>
                            </div>
                            <div class="border-t border-blue-300 my-2 pt-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-base font-bold text-gray-900">Total Harga:</span>
                                    <span class="text-xl font-bold text-blue-600">Rp <span x-text="formatPrice(totalPrice)"></span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Special Requests -->
                        <div class="mb-6">
                            <label for="special_requests_232136" class="block text-sm font-medium text-gray-700 mb-2">Permintaan Khusus (Opsional)</label>
                            <textarea name="special_requests_232136" 
                                      id="special_requests_232136" 
                                      rows="4" 
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                      placeholder="Tuliskan permintaan khusus Anda di sini (contoh: kebutuhan aksesibilitas, alergi makanan, dll.)"
                                      x-bind:readonly="loading">{{ old('special_requests_232136') }}</textarea>
                            @error('special_requests_232136')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Terms -->
                        <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold text-gray-900 mb-2">Syarat & Ketentuan:</h3>
                            <ul class="text-sm text-gray-600 space-y-1 list-disc list-inside">
                                <li>Booking akan diproses dalam 1-2 hari kerja</li>
                                <li>Konfirmasi akan dikirim melalui email yang terdaftar</li>
                                <li>Pembatalan dapat dilakukan sebelum booking dikonfirmasi</li>
                                <li>Harap datang 15 menit sebelum jadwal kunjungan</li>
                                <li class="text-red-600 font-semibold">⚠️ Kapasitas terbatas - Jika penuh, pilih tanggal lain</li>
                            </ul>
                        </div>

                        <!-- Capacity Warning -->
                        <div x-show="selectedDate && !checkingCapacity && availableCapacity !== null && (availableCapacity === 0 || availableCapacity < numberOfPeople)" 
                             class="mb-6 p-4 bg-red-50 border-2 border-red-300 rounded-lg">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <h4 class="text-red-800 font-bold mb-2">⚠️ Kapasitas Tidak Tersedia</h4>
                                    <p class="text-red-700 text-sm mb-2" x-show="availableCapacity === 0">
                                        Destinasi ini sudah penuh untuk tanggal yang dipilih. <strong>Tidak ada slot tersedia (0 orang).</strong>
                                    </p>
                                    <div x-show="availableCapacity > 0 && availableCapacity < numberOfPeople" class="text-red-700 text-sm mb-2">
                                        <p class="mb-1">Kapasitas tidak mencukupi:</p>
                                        <ul class="list-disc list-inside space-y-1 ml-2">
                                            <li>Slot tersedia: <strong class="text-lg" x-text="availableCapacity"></strong> orang</li>
                                            <li>Jumlah yang Anda pilih: <strong class="text-lg" x-text="numberOfPeople"></strong> orang</li>
                                            <li>Kekurangan: <strong class="text-lg" x-text="numberOfPeople - availableCapacity"></strong> orang</li>
                                        </ul>
                                    </div>
                                    <p class="text-red-700 text-sm font-semibold bg-red-100 p-2 rounded">
                                        💡 Silakan pilih tanggal lain atau kurangi jumlah orang menjadi maksimal <span x-show="availableCapacity > 0" x-text="availableCapacity"></span><span x-show="availableCapacity === 0">0</span> orang.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex gap-4">
                            <a href="{{ route('public.destination.show', $destination->id) }}" 
                               class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 text-center font-semibold">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold transition"
                                    x-bind:disabled="loading || (selectedDate && availableCapacity !== null && (availableCapacity === 0 || availableCapacity < numberOfPeople))"
                                    x-bind:class="{ 
                                        'opacity-50 cursor-not-allowed': loading || (selectedDate && availableCapacity !== null && (availableCapacity === 0 || availableCapacity < numberOfPeople)),
                                        'hover:bg-blue-700': !(loading || (selectedDate && availableCapacity !== null && (availableCapacity === 0 || availableCapacity < numberOfPeople)))
                                    }">
                                <span x-show="!loading">Konfirmasi Booking</span>
                                <span x-show="loading" class="flex items-center justify-center">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memproses...
                                </span>
                            </button>
                        </div>
                        
                        <!-- Disabled Button Helper Text -->
                        <p x-show="selectedDate && availableCapacity !== null && (availableCapacity === 0 || availableCapacity < numberOfPeople)" 
                           class="text-xs text-red-600 text-center mt-2 font-semibold">
                            ✗ Booking tidak dapat dilanjutkan - Kapasitas tidak mencukupi
                        </p>
                    </form>
                </div>
            </div>

            <!-- Destination Summary -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Detail Destinasi</h3>
                    
                    @if($destination->getImageUrl())
                        <img src="{{ $destination->getImageUrl() }}" alt="{{ $destination->name_232136 }}" class="w-full h-48 object-cover rounded-lg mb-4">
                    @else
                        <div class="w-full h-48 bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg flex items-center justify-center text-white text-6xl mb-4">📸</div>
                    @endif

                    <h4 class="font-bold text-gray-900 text-lg mb-2">{{ $destination->name_232136 }}</h4>
                    
                    <div class="space-y-2 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            {{ $destination->location_232136 ?? 'Indonesia' }}
                        </div>

                        @if($destination->getReviewCount() > 0)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            {{ $destination->getAverageRating() }} ({{ $destination->getReviewCount() }} ulasan)
                        </div>
                        @endif
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="bg-blue-50 p-3 rounded-lg mb-3">
                            <p class="text-sm text-gray-700 mb-1">Harga per orang</p>
                            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($destination->price_232136, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-gray-100 p-3 rounded-lg mb-3 border-l-4 border-gray-400">
                            <p class="text-xs text-gray-600 mb-1">Kapasitas harian</p>
                            <p class="text-lg font-bold text-gray-800">{{ $destination->daily_capacity_232136 }} <span class="text-xs font-normal">orang/hari</span></p>
                            <p class="text-xs text-gray-500 mt-1">📊 Ketersediaan tergantung tanggal yang dipilih</p>
                        </div>
                        <p class="text-xs text-gray-500 italic">* Booking akan dikonfirmasi oleh admin dalam 1-2 hari kerja</p>
                    </div>
                </div>
            </div>
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
