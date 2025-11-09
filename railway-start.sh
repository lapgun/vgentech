#!/bin/bash
set -e

echo "🚀 Starting application..."

# Cache configuration
echo "⚙️  Caching configuration..."
php artisan config:cache

# Cache routes
echo "🗺️  Caching routes..."
php artisan route:cache

# Run migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Create storage link
echo "🔗 Creating storage symlink..."
php artisan storage:link || true

# Start server
echo "✅ Starting Laravel server..."
php artisan serve --host=0.0.0.0 --port=$PORT
