FROM php:8.5-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip

RUN docker-php-ext-install pdo pdo_mysql zip

WORKDIR /app

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Permisos Laravel
RUN chmod -R 775 storage bootstrap/cache

# Config Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

# Arranque PHP-FPM + Nginx
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"