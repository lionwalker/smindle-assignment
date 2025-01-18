#!/bin/bash

# Copy environment file
cp .env.example .env

# Install composer dependencies using Sail
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --no-interaction --prefer-dist

# Generate application key
./vendor/bin/sail artisan key:generate

# Start containers
./vendor/bin/sail up -d

# Run migrations
./vendor/bin/sail artisan migrate --force

# Build assets (if using npm)
./vendor/bin/sail npm install
./vendor/bin/sail npm run build

# Clear caches
./vendor/bin/sail artisan config:cache
./vendor/bin/sail artisan route:cache
./vendor/bin/sail artisan view:cache

# Restart queue worker to ensure it picks up any code changes
./vendor/bin/sail artisan queue:restart

# Set permissions
chmod -R 777 storage bootstrap/cache