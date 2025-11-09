#!/bin/bash

# VGenTech EC2 Deploy Script
# Run this script on EC2 server

set -e

echo "🚀 Starting VGenTech deployment..."

# Navigate to project directory
cd /home/ubuntu/vgentech || cd ~/vgentech

# Pull latest code
echo "📥 Pulling latest code from GitHub..."
git pull origin main

# Stop containers
echo "🛑 Stopping containers..."
docker-compose down

# Build and start containers
echo "🔨 Building and starting containers..."
docker-compose up -d --build

# Wait for containers to be ready
echo "⏳ Waiting for containers to start..."
sleep 15

# Run migrations
echo "🗄️  Running database migrations..."
docker-compose exec -T app php artisan migrate --force

# Clear and cache
echo "🧹 Clearing and caching..."
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache

# Storage link
echo "🔗 Creating storage link..."
docker-compose exec -T app php artisan storage:link || true

# Set permissions
echo "🔐 Setting permissions..."
docker-compose exec -T app chown -R www:www /var/www/html/storage || true
docker-compose exec -T app chmod -R 775 /var/www/html/storage || true

# Check status
echo "✅ Checking container status..."
docker-compose ps

echo ""
echo "🎉 Deployment completed successfully!"
echo "🌐 Website: http://$(curl -s ifconfig.me)"
echo ""
