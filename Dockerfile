FROM php:8.2-fpm

# تثبيت الأدوات اللازمة
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl

# تثبيت إضافات PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# مجلد العمل
WORKDIR /var/www

# نسخ المشروع
COPY . .

# تثبيت مكتبات Laravel
RUN composer install --no-dev --optimize-autoloader

# إعطاء التصاريح للمجلدات
RUN chown -R www-data:www-data storage bootstrap/cache

# تشغيل Laravel عند البدء
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
