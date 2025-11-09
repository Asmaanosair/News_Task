#!/bin/sh
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

# Step 5: Install npm dependencies
npm install
# Step 5: schedule:run
php artisan schedule:work
# Step 5: queue:work
php artisan queue:work

# Step 6: Start PHP-FPM
exec php-fpm
