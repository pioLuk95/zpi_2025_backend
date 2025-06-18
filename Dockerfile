FROM php:8.2-cli


RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libsqlite3-dev \
    libzip-dev \
    zip


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /app
COPY ./WSGmed /app

RUN composer install --no-dev --no-interaction --optimize-autoloader

RUN chmod -R 775 storage bootstrap/cache

RUN touch database/database.sqlite
RUN php artisan migrate --force || true
RUN php artisan db:seed --force || true

CMD php artisan serve --host=0.0.0.0 --port=10000
