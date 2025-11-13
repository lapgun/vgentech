#!/bin/bash

echo "🔧 Fixing Docker permissions and rebuilding..."

# Stop containers
echo "Stopping containers..."
docker-compose down -v

# Fix local permissions (for Windows/Mac)
echo "Setting local permissions..."
chmod -R 777 storage bootstrap/cache 2>/dev/null || true

# Rebuild containers
echo "Rebuilding containers..."
docker-compose build --no-cache

# Start containers
echo "Starting containers..."
docker-compose up -d

# Wait for containers to be ready
echo "Waiting for containers to be ready..."
sleep 10

# Generate key if needed
echo "Generating application key..."
docker-compose exec app php artisan key:generate --force

# Run migrations
echo "Running migrations..."
docker-compose exec app php artisan migrate --force

# Create storage link
echo "Creating storage link..."
docker-compose exec app php artisan storage:link

# Clear and cache
echo "Clearing caches..."
docker-compose exec app php artisan optimize:clear

echo "✅ Done! Application should be running on http://localhost:8000"
docker-compose ps
