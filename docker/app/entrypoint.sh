#!/bin/sh

# Fix permissions first
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Step 1: Copy .env if not exists
if [ ! -f /var/www/.env ]; then
  cp /var/www/.env.example /var/www/.env
fi

# Step 2: Install Composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Step 3: Generate application key
php artisan key:generate

# Step 4: Run migrations and seeders
php artisan migrate --seed --force

# Step 5: Generate swagger file
php artisan l5-swagger:generate
php artisan config:clear

# Clear and set permissions again after artisan commands
php artisan cache:clear
php artisan view:clear
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Step 6: schedule:work (run in background)
php artisan schedule:work > /dev/null 2>&1 &

# Step 7: queue:work (run in background)
php artisan queue:work > /dev/null 2>&1 &

# Step 8: fetch articles (one-off)
php artisan app:fetch-articles

# Step 9: Start PHP-FPM
php-fpm -F
