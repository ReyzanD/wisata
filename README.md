# 🏝️ Wisata Indonesia

<p align="center">
  <strong>Sistem Manajemen Destinasi Wisata Modern</strong><br>
  Dibangun dengan Laravel 11, Tailwind CSS, Alpine.js & Livewire
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=flat&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=flat&logo=tailwind-css" alt="Tailwind">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
</p>

## 📖 Tentang Wisata Indonesia

Wisata Indonesia adalah sistem manajemen destinasi wisata yang komprehensif yang dirancang untuk menampilkan destinasi wisata indah di Indonesia. Platform ini memungkinkan pengguna untuk menemukan destinasi, membaca ulasan, dan berbagi pengalaman mereka, sementara administrator dapat mengelola konten melalui dashboard yang intuitif.

### ✨ Fitur Utama

**Untuk Pengunjung:**
- 🔍 Jelajahi dan cari destinasi wisata
- 📂 Filter berdasarkan kategori (Pantai, Gunung, Budaya, dll.)
- ⭐ Lihat rating dan ulasan dari traveler lain
- 📝 Kirim ulasan dan rating (memerlukan login)
- 🖼️ Lihat galeri foto yang indah
- 📱 Desain responsif penuh untuk mobile dan desktop

**Untuk Administrator:**
- 📊 Dashboard dengan statistik dan analitik
- 🏖️ Kelola destinasi (operasi CRUD)
- 🗂️ Kelola kategori
- 🖼️ Kelola galeri foto dengan upload gambar
- 💬 Kelola ulasan pengguna
- 👥 Manajemen pengguna
- 🔒 Kontrol akses berbasis role

## 🛠️ Teknologi yang Digunakan

- **Backend:** Laravel 11 (PHP 8.2+)
- **Frontend:** Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Authentication:** Laravel Breeze dengan Livewire
- **File Storage:** Laravel Storage (Public Disk)
- **Asset Bundling:** Vite

## 📋 Kebutuhan Sistem

Sebelum instalasi, pastikan Anda memiliki:

- PHP >= 8.2
- Composer
- Node.js >= 18.x & NPM
- MySQL >= 8.0
- Git

## 🚀 Panduan Instalasi

### 1. Clone Repository

```bash
git clone <url-repo-anda>
cd wisata
```

### 2. Install Dependencies PHP

```bash
composer install
```

### 3. Install Dependencies JavaScript

```bash
npm install
```

### 4. Konfigurasi Environment

Salin file environment contoh dan konfigurasikan:

```bash
cp .env.example .env
```

Edit file `.env` dan atur kredensial database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wisata_232136
DB_USERNAME=username_anda
DB_PASSWORD=password_anda

APP_NAME="Wisata Indonesia"
APP_URL=http://localhost:8000
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Buat Database

Buat database MySQL baru:

```sql
CREATE DATABASE wisata_232136;
```

### 7. Jalankan Migrasi

```bash
php artisan migrate
```

### 8. Seed Database (Opsional)

Isi dengan data contoh:

```bash
php artisan db:seed
```

Ini akan membuat:
- User admin
- Kategori contoh
- Destinasi contoh
- Galeri contoh
- Ulasan contoh

### 9. Buat Storage Link

Buat symbolic link untuk penyimpanan file:

```bash
php artisan storage:link
```

### 10. Build Frontend Assets

**Untuk development:**
```bash
npm run dev
```

**Untuk production:**
```bash
npm run build
```

### 11. Jalankan Development Server

Di terminal baru:

```bash
php artisan serve
```

Kunjungi: `http://localhost:8000`

## 👤 Kredensial Admin Default

Setelah seeding database, Anda dapat login sebagai admin:

```
Email: admin@wisata.com
Password: password
```

**⚠️ Penting:** Ubah password admin segera setelah login pertama kali!

## 📂 Struktur Proyek

```
wisata/
├── app/
│   ├── Http/Controllers/      # Application controllers
│   ├── Models/                # Eloquent models
│   └── Livewire/              # Livewire components
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── resources/
│   ├── views/                 # Blade templates
│   │   ├── index.blade.php           # Homepage
│   │   ├── public/                   # Public pages
│   │   ├── dashboard/                # Admin dashboard
│   │   ├── destinations/             # Destination management
│   │   ├── galleries/                # Gallery management
│   │   └── ...                       # Other views
│   ├── css/                   # Stylesheets
│   └── js/                    # JavaScript files
├── routes/
│   └── web.php                # Web routes
├── storage/
│   └── app/public/            # Uploaded files
│       ├── destinations/      # Destination images
│       └── galleries/         # Gallery images
└── public/
    └── storage/               # Symlink to storage
```

## 🗄️ Struktur Database

Semua tabel menggunakan suffix `_232136`:

- `users` - Akun pengguna
- `categories_232136` - Kategori destinasi
- `destinations_232136` - Destinasi wisata
- `galleries_232136` - Galeri gambar
- `reviews_232136` - Ulasan dan rating pengguna

## 🎨 Fitur Detail

### 1. Sistem Upload Gambar
- Upload gambar utama destinasi
- Upload gambar galeri
- Validasi gambar otomatis (max 2MB, JPEG/PNG/JPG/GIF)
- Penghapusan gambar lama otomatis saat update
- Fallback pintar: Gambar destinasi → Gambar galeri → URL → Placeholder

### 2. Sistem Rating
- Tampilan rating bintang 5
- Perhitungan rating rata-rata
- Tampilan jumlah ulasan
- Rating terlihat di:
  - Card destinasi homepage
  - Listing destinasi
  - Halaman detail destinasi

### 3. Pencarian & Filter
- Pencarian teks (nama, lokasi, deskripsi)
- Filter kategori
- Dukungan pagination

### 4. Dashboard Admin
- Ringkasan statistik
- Daftar destinasi terbaru
- Operasi CRUD lengkap untuk semua resource
- Manajemen pengguna

## 🔧 Konfigurasi

### Pengaturan Upload File

Untuk mengubah ukuran upload maksimal, edit `php.ini`:

```ini
upload_max_filesize = 2M
post_max_size = 2M
```

### Permissions Storage

Pastikan permissions yang tepat:

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 🐛 Troubleshooting

### Gambar Tidak Muncul?

1. Pastikan storage link ada:
   ```bash
   php artisan storage:link
   ```

2. Periksa permissions folder:
   ```bash
   chmod -R 775 storage/app/public
   ```

### Tidak Bisa Login?

1. Bersihkan cache:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

2. Seed ulang database:
   ```bash
   php artisan migrate:fresh --seed
   ```

### Livewire Tidak Berfungsi?

Pastikan `@livewireStyles` dan `@livewireScripts` ada di `layouts/app.blade.php`

## 📱 Panduan Penggunaan

### Untuk Pengguna:

1. **Jelajahi Destinasi:** Kunjungi homepage untuk melihat destinasi unggulan
2. **Cari:** Gunakan search bar untuk menemukan destinasi spesifik
3. **Filter:** Pilih kategori untuk memfilter destinasi
4. **Lihat Detail:** Klik destinasi untuk melihat detail lengkap
5. **Kirim Ulasan:** Login/Register untuk mengirim rating dan ulasan

### Untuk Administrator:

1. **Login:** Gunakan kredensial admin di `/login`
2. **Dashboard:** Lihat statistik dan kelola konten
3. **Tambah Destinasi:**
   - Ke Destinasi → Tambah Baru
   - Isi detail
   - Upload gambar utama
   - Simpan
4. **Tambah Galeri:**
   - Ke Galeri → Tambah Baru
   - Upload gambar ATAU berikan URL
   - Link ke destinasi
5. **Kelola Ulasan:** Lihat, edit, atau hapus ulasan pengguna

## 🔐 Keamanan

- Perlindungan CSRF aktif
- Password hashing dengan bcrypt
- Perlindungan XSS
- Pencegahan SQL injection via Eloquent ORM
- Validasi upload file
- Kontrol akses berbasis role

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan submit Pull Request.

1. Fork repository ini
2. Buat feature branch (`git checkout -b feature/FiturKeren`)
3. Commit perubahan Anda (`git commit -m 'Tambah fitur keren'`)
4. Push ke branch (`git push origin feature/FiturKeren`)
5. Buka Pull Request

## 📝 Catatan

- Semua tabel database menggunakan suffix `_232136` untuk keunikan
- Storage default ada di `storage/app/public`
- Gambar dapat diakses publik via URL `/storage`
- Frontend menggunakan Vite untuk hot module replacement
- Area admin menggunakan Livewire untuk komponen reaktif

## 🐛 Known Issues

Cek `BUGFIX.md` untuk masalah yang sudah diselesaikan dan solusinya.

## 📄 Lisensi

Proyek ini adalah software open-source dengan lisensi [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Pengembang

Dikembangkan sebagai bagian dari proyek sistem manajemen pariwisata.

## 📧 Dukungan

Untuk issues, pertanyaan, atau kontribusi, silakan buka issue di GitHub.

---

<p align="center">Dibuat dengan ❤️ untuk Pariwisata Indonesia</p>
