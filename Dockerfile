FROM php:8.5-cli

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libzip-dev \
    nginx

# Extensiones PHP
RUN docker-php-ext-install pdo pdo_mysql zip

WORKDIR /var/www

# Copiar proyecto
COPY . .

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Dependencias Laravel
RUN composer install --no-dev --optimize-autoloader

# Permisos Laravel
RUN chmod -R 775 storage bootstrap/cache

# Storage link (evita 404 en /storage)
RUN php artisan storage:link || true

# Config Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

# Arranque PHP-FPM + Nginx
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"