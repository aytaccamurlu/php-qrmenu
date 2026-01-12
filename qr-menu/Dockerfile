FROM php:8.2-apache

# Sistem kütüphanelerini kur
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libpq-dev

# PHP eklentilerini kur (MySQL ve PostgreSQL için pdo_mysql pdo_pgsql eklendi)
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Apache mod_rewrite'ı aktif et (Laravel rotaları için şart)
RUN a2enmod rewrite

# Apache'nin Root dizinini Laravel'in PUBLIC klasörüne ayarla (Forbidden hatasını bu çözer)
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Çalışma dizini
WORKDIR /var/www/html

# Proje dosyalarını kopyala
COPY . .

# Composer kur ve bağımlılıkları yükle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Klasör izinlerini ayarla
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Başlangıç komutu
CMD ["apache2-foreground"]