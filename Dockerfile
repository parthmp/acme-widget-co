FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    unzip git zip libzip-dev \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock* ./

RUN composer install --no-scripts --no-interaction --prefer-dist --no-progress

COPY . .

CMD ["php", "-a"]