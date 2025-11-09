#!/bin/bash
set -e

echo "🚀 Starting deployment..."

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Dump autoload
echo "🔄 Generating optimized autoload..."
composer dump-autoload --optimize --no-dev

# Install Node dependencies
echo "📦 Installing Node dependencies..."
npm ci --legacy-peer-deps

# Build assets
echo "🎨 Building frontend assets..."
npm run build

echo "✅ Build completed successfully!"
