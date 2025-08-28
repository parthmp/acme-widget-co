FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    libzip-dev \
    && docker-php-ext-install zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock* ./

# Install PHP dependencies
RUN composer install \
    --no-scripts \
    --no-interaction \
    --prefer-dist \
    --no-progress

# Backup vendor folder for later use
RUN cp -r vendor /tmp/vendor

# Copy application code
COPY . .

# Default command
CMD ["tail", "-f", "/dev/null"]