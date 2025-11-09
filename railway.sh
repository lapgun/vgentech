#!/bin/bash
# Railway deployment script

echo "🚀 Starting deployment..."

# Install dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies
echo "📦 Installing Node dependencies..."
npm ci

# Build assets
echo "🔨 Building assets..."
npm run build

# Clear and cache config
echo "⚙️ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
echo "🗄️ Running migrations..."
php artisan migrate --force

# Link storage
echo "🔗 Linking storage..."
php artisan storage:link

echo "✅ Deployment complete!"
