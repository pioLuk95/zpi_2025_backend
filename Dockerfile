FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libsqlite3-dev \
    libzip-dev \
    zip

RUN docker-php-ext-install zip pdo pdo_sqlite

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

WORKDIR /app
COPY ./WSGmed /app

RUN composer install --no-interaction --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

RUN touch database/database.sqlite
RUN php artisan migrate --force || true
RUN php artisan db:seed --force || true
RUN composer dump-autoload

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
