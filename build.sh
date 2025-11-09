#!/bin/bash

echo "🚀 Installing Composer dependencies..."
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

echo "📦 Installing NPM dependencies..."
npm ci

echo "🔨 Building assets..."
npm run build

echo "✅ Build complete!"
