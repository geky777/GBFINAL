# Simple Dockerfile for Laravel app on Render

FROM php:8.2-cli

# Install system dependencies and PHP extensions
RUN apt-get update \
    && apt-get install -y git unzip libzip-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Install PHP dependencies
COPY composer.json composer.lock* ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress

# Copy the rest of the application code
COPY . .

# Ensure SQLite database file exists
RUN mkdir -p database \
    && touch database/database.sqlite

# Prepare environment (.env from example) and generate app key
RUN if [ ! -f .env ]; then cp .env.example .env; fi \
    && php artisan key:generate --force

# Expose the port Render will use
ENV PORT=8080
EXPOSE 8080

# Start the Laravel development server
CMD php artisan serve --host=0.0.0.0 --port=${PORT}
