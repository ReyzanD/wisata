# 🏝️ Wisata Indonesia

<p align="center">
  <strong>A Modern Tourism Destination Management System</strong><br>
  Built with Laravel 11, Tailwind CSS, Alpine.js & Livewire
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=flat&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=flat&logo=tailwind-css" alt="Tailwind">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
</p>

## 📖 About Wisata Indonesia

Wisata Indonesia is a comprehensive tourism destination management system designed to showcase Indonesia's beautiful tourist destinations. The platform allows users to discover destinations, read reviews, and share their experiences, while administrators can manage content through an intuitive dashboard.

### ✨ Key Features

**For Visitors:**
- 🔍 Browse and search tourist destinations
- 📂 Filter by categories (Beach, Mountain, Culture, etc.)
- ⭐ View ratings and reviews from other travelers
- 📝 Submit reviews and ratings (requires login)
- 🖼️ View beautiful image galleries
- 📱 Fully responsive design for mobile and desktop

**For Administrators:**
- 📊 Dashboard with statistics and analytics
- 🏖️ Manage destinations (CRUD operations)
- 🗂️ Manage categories
- 🖼️ Manage photo galleries with image upload
- 💬 Manage user reviews
- 👥 User management
- 🔒 Role-based access control

## 🛠️ Tech Stack

- **Backend:** Laravel 11 (PHP 8.2+)
- **Frontend:** Tailwind CSS, Alpine.js
- **Database:** MySQL
- **Authentication:** Laravel Breeze with Livewire
- **File Storage:** Laravel Storage (Public Disk)
- **Asset Bundling:** Vite

## 📋 Requirements

Before installing, make sure you have:

- PHP >= 8.2
- Composer
- Node.js >= 18.x & NPM
- MySQL >= 8.0
- Git

## 🚀 Installation Instructions

### 1. Clone the Repository

```bash
git clone <your-repo-url>
cd wisata
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

Edit `.env` file and set your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wisata_232136
DB_USERNAME=your_username
DB_PASSWORD=your_password

APP_NAME="Wisata Indonesia"
APP_URL=http://localhost:8000
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Create Database

Create a new MySQL database:

```sql
CREATE DATABASE wisata_232136;
```

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Seed the Database (Optional)

Populate with sample data:

```bash
php artisan db:seed
```

This will create:
- Admin user
- Sample categories
- Sample destinations
- Sample galleries
- Sample reviews

### 9. Create Storage Link

Create symbolic link for file storage:

```bash
php artisan storage:link
```

### 10. Build Frontend Assets

**For development:**
```bash
npm run dev
```

**For production:**
```bash
npm run build
```

### 11. Start the Development Server

In a new terminal:

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## 👤 Default Admin Credentials

After seeding the database, you can login as admin:

```
Email: admin@wisata.com
Password: password
```

**⚠️ Important:** Change the admin password immediately after first login!

## 📂 Project Structure

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

## 🗄️ Database Structure

All tables use `_232136` suffix:

- `users` - User accounts
- `categories_232136` - Destination categories
- `destinations_232136` - Tourist destinations
- `galleries_232136` - Image galleries
- `reviews_232136` - User reviews and ratings

## 🎨 Features in Detail

### 1. Image Upload System
- Upload destination main images
- Upload gallery images
- Automatic image validation (max 2MB, JPEG/PNG/JPG/GIF)
- Automatic old image deletion on update
- Smart fallback: Destination image → Gallery image → URL → Placeholder

### 2. Rating System
- 5-star rating display
- Average rating calculation
- Review count display
- Ratings visible on:
  - Homepage destination cards
  - Destination listing
  - Destination detail page

### 3. Search & Filter
- Text search (name, location, description)
- Category filtering
- Pagination support

### 4. Admin Dashboard
- Statistics overview
- Recent destinations list
- Complete CRUD operations for all resources
- User management

## 🔧 Configuration

### File Upload Settings

To change max upload size, edit `php.ini`:

```ini
upload_max_filesize = 2M
post_max_size = 2M
```

### Storage Permissions

Ensure proper permissions:

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 🐛 Troubleshooting

### Images Not Showing?

1. Ensure storage link exists:
   ```bash
   php artisan storage:link
   ```

2. Check folder permissions:
   ```bash
   chmod -R 775 storage/app/public
   ```

### Can't Login?

1. Clear cache:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

2. Re-seed database:
   ```bash
   php artisan migrate:fresh --seed
   ```

### Livewire Not Working?

Make sure `@livewireStyles` and `@livewireScripts` are in `layouts/app.blade.php`

## 📱 Usage Guide

### For End Users:

1. **Browse Destinations:** Visit homepage to see featured destinations
2. **Search:** Use search bar to find specific destinations
3. **Filter:** Select categories to filter destinations
4. **View Details:** Click on any destination to see full details
5. **Submit Review:** Login/Register to submit ratings and reviews

### For Administrators:

1. **Login:** Use admin credentials at `/login`
2. **Dashboard:** View statistics and manage content
3. **Add Destination:**
   - Go to Destinations → Add New
   - Fill in details
   - Upload main image
   - Save
4. **Add Gallery:**
   - Go to Galleries → Add New
   - Upload image OR provide URL
   - Link to destination
5. **Manage Reviews:** View, edit, or delete user reviews

## 🔐 Security

- CSRF protection enabled
- Password hashing with bcrypt
- XSS protection
- SQL injection prevention via Eloquent ORM
- File upload validation
- Role-based access control

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 Notes

- All database tables use `_232136` suffix for uniqueness
- Default storage is in `storage/app/public`
- Images are publicly accessible via `/storage` URL
- Frontend uses Vite for hot module replacement
- Admin area uses Livewire for reactive components

## 🐛 Known Issues

Check `BUGFIX.md` for resolved issues and solutions.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

Developed as part of a tourism management system project.

## 📧 Support

For issues, questions, or contributions, please open an issue on GitHub.

---

<p align="center">Made with ❤️ for Indonesian Tourism</p>
