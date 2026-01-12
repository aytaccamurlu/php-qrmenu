FROM php:8.2-apache

# Sistem bağımlılıkları ve PostgreSQL sürücüleri
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git

# PHP PostgreSQL sürücülerini kur (Kilit burası!)
RUN docker-php-ext-install pdo_pgsql

# Apache ayarları
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
COPY . .

# Composer kurulumu
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["apache2-foreground"]