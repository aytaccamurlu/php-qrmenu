FROM php:8.2-apache

# Sistem kütüphanelerini kur
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# PHP eklentilerini kur
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Apache mod_rewrite'ı aktif et (Laravel rotaları için şart)
RUN a2enmod rewrite

# Çalışma dizini
WORKDIR /var/www/html

# Proje dosyalarını kopyala
COPY . .

# Composer kur
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Klasör izinlerini ayarla
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Portu ayarla
ENV PORT=80
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Başlangıç komutu
CMD ["apache2-foreground"]