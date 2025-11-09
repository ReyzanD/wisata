# 🚀 Deployment Guide - Wisata Indonesia

## Production Deployment Checklist

### 1. Environment Setup

Update `.env` for production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your-production-host
DB_PORT=3306
DB_DATABASE=wisata_232136
DB_USERNAME=your-production-user
DB_PASSWORD=your-secure-password
```

### 2. Security

```bash
# Generate new app key
php artisan key:generate

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

### 3. Build Assets

```bash
# Build for production
npm run build
```

### 4. File Permissions

```bash
# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 5. Database

```bash
# Run migrations (CAREFUL - backup first!)
php artisan migrate --force

# Optional: Seed if needed
php artisan db:seed --force
```

### 6. Storage Link

```bash
php artisan storage:link
```

### 7. Web Server Configuration

#### Apache (.htaccess)

Already included in `public/.htaccess`

#### Nginx

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/wisata/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 8. SSL Certificate

```bash
# Using Let's Encrypt (Certbot)
sudo certbot --nginx -d yourdomain.com
```

### 9. Cron Jobs

Add to crontab for scheduled tasks:

```bash
* * * * * cd /path/to/wisata && php artisan schedule:run >> /dev/null 2>&1
```

### 10. Queue Workers (Optional)

If using queues:

```bash
# Install Supervisor
sudo apt-get install supervisor

# Create supervisor config
sudo nano /etc/supervisor/conf.d/wisata-worker.conf
```

```ini
[program:wisata-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/wisata/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/wisata/storage/logs/worker.log
```

```bash
# Start supervisor
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start wisata-worker:*
```

## Shared Hosting Deployment

### For cPanel/Shared Hosting:

1. **Upload Files:**
   - Upload all files except `public` folder to root
   - Upload `public` folder contents to `public_html`

2. **Update Paths:**
   
   Edit `public_html/index.php`:
   ```php
   require __DIR__.'/../vendor/autoload.php';
   $app = require_once __DIR__.'/../bootstrap/app.php';
   ```

3. **Setup Database:**
   - Create database via cPanel
   - Import database or run migrations
   - Update `.env` with database credentials

4. **File Permissions:**
   - `storage/` → 755
   - `bootstrap/cache/` → 755

5. **Create Symbolic Link:**
   
   Create `public_html/storage` pointing to `../storage/app/public`

## Post-Deployment

### 1. Test Everything

- ✅ Homepage loads
- ✅ Login works
- ✅ Images display correctly
- ✅ Forms submit properly
- ✅ Admin panel accessible
- ✅ Database connections work

### 2. Monitor Logs

```bash
# View Laravel logs
tail -f storage/logs/laravel.log

# View web server logs
tail -f /var/log/nginx/error.log
```

### 3. Performance Optimization

```bash
# Enable OPcache in php.ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2

# Enable Redis cache (optional)
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### 4. Backup Strategy

**Database Backup:**
```bash
# Create backup script
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u username -p wisata_232136 > backup_$DATE.sql
```

**File Backup:**
```bash
# Backup uploads
tar -czf uploads_backup.tar.gz storage/app/public/
```

## Rollback Plan

If something goes wrong:

1. **Restore Database:**
   ```bash
   mysql -u username -p wisata_232136 < backup.sql
   ```

2. **Restore Files:**
   ```bash
   tar -xzf backup.tar.gz
   ```

3. **Clear Cache:**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```

## Security Checklist

- ✅ `APP_DEBUG=false` in production
- ✅ Strong database passwords
- ✅ SSL certificate installed
- ✅ File permissions set correctly
- ✅ `.env` file not publicly accessible
- ✅ Storage folder not publicly accessible
- ✅ Composer production mode (`--no-dev`)
- ✅ Regular backups scheduled
- ✅ Error logging enabled
- ✅ Rate limiting configured

## Maintenance Mode

```bash
# Enable maintenance mode
php artisan down --refresh=15 --secret="1234"

# Perform updates...

# Disable maintenance mode
php artisan up
```

Access during maintenance: `https://yourdomain.com/1234`

---

**Remember:** Always backup before deploying! 🔒
