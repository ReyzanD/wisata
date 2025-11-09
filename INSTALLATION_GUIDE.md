# 📖 Wisata Indonesia - Quick Installation Guide

## For Your Friend (Step-by-Step)

Hey! Thanks for checking out this project. Here's how to get it running on your machine.

---

## ✅ Before You Start

Make sure you have installed:
- ✔️ **PHP 8.2 or higher** ([Download](https://www.php.net/downloads))
- ✔️ **Composer** ([Download](https://getcomposer.org/download/))
- ✔️ **Node.js & NPM** ([Download](https://nodejs.org/))
- ✔️ **MySQL** ([Download](https://dev.mysql.com/downloads/mysql/))
- ✔️ **Git** ([Download](https://git-scm.com/downloads))

---

## 🚀 Installation Steps

### Step 1: Get the Code
```bash
# Clone this repository
git clone <repository-url>
cd wisata
```

### Step 2: Install Dependencies
```bash
# Install PHP packages
composer install

# Install JavaScript packages
npm install
```

### Step 3: Setup Environment
```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Configure Database

1. Open **MySQL** and create a database:
```sql
CREATE DATABASE wisata_232136;
```

2. Edit `.env` file with your database info:
```env
DB_DATABASE=wisata_232136
DB_USERNAME=root         # Your MySQL username
DB_PASSWORD=             # Your MySQL password (leave empty if none)
```

### Step 5: Setup Database Tables
```bash
# Create all database tables
php artisan migrate

# Fill with sample data (OPTIONAL but recommended)
php artisan db:seed
```

### Step 6: Setup File Storage
```bash
# Create symbolic link for uploaded images
php artisan storage:link
```

### Step 7: Build Frontend
```bash
# For development (with hot reload)
npm run dev
```
**Keep this terminal running!**

### Step 8: Start Server
Open a **NEW terminal** and run:
```bash
# Start Laravel development server
php artisan serve
```

### Step 9: Open in Browser
Visit: **http://localhost:8000**

🎉 **You're all set!**

---

## 🔑 Login Credentials

After seeding, you can login as admin:

```
Email: admin@wisata.com
Password: password
```

---

## 📝 Common Commands

**Start Development:**
```bash
# Terminal 1 - Frontend
npm run dev

# Terminal 2 - Backend
php artisan serve
```

**Reset Database:**
```bash
php artisan migrate:fresh --seed
```

**Clear Cache:**
```bash
php artisan cache:clear
php artisan config:clear
```

---

## ❓ Troubleshooting

### Problem: "Images not showing"
**Solution:**
```bash
php artisan storage:link
chmod -R 775 storage/app/public
```

### Problem: "Can't login"
**Solution:**
```bash
php artisan migrate:fresh --seed
```

### Problem: "Port 8000 already in use"
**Solution:**
```bash
# Use a different port
php artisan serve --port=8001
```

---

## 📂 What You'll Get

After installation, the site has:
- ✅ Homepage with featured destinations
- ✅ Search and filter functionality
- ✅ User registration and login
- ✅ Admin dashboard at `/login`
- ✅ Sample destinations and reviews

---

## 🎯 Next Steps

1. **Login to admin panel** (`admin@wisata.com` / `password`)
2. **Explore the dashboard**
3. **Add your own destinations**
4. **Upload images**
5. **Test the review system**

---

## 💡 Tips

- **Always keep `npm run dev` running** while developing
- **Use `php artisan serve` to start the backend**
- **Check `BUGFIX.md` if you encounter issues**
- **Read `README.md` for detailed documentation**

---

## 📞 Need Help?

If you get stuck:
1. Check the **Troubleshooting** section above
2. Read `README.md` for more details
3. Check `BUGFIX.md` for known issues
4. Open an issue on GitHub

---

**Happy coding! 🚀**
