#!/bin/bash

# deploy.sh
echo "🚀 Starting deployment process..."

# 1. Copy environment file
echo "📝 Setting up environment file..."
cp .env.example .env

# 2. Install Composer dependencies
echo "📦 Installing Composer dependencies..."
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    composer:latest composer install --optimize-autoloader --no-dev

# 3. Start Docker containers
echo "🐳 Starting Docker containers..."
docker compose up -d

# 4. Wait for database to be ready
echo "⏳ Waiting for database to be ready..."
sleep 30

# 5. Generate application key
echo "🔑 Generating application key..."
docker compose exec laravel.test php artisan key:generate

# 6. Run migrations
echo "🔄 Running database migrations..."
docker compose exec laravel.test php artisan migrate --force

# 7. Clear caches
echo "🧹 Clearing application cache..."
docker compose exec laravel.test php artisan cache:clear
docker compose exec laravel.test php artisan config:clear
docker compose exec laravel.test php artisan route:clear

echo "✅ Deployment completed!"