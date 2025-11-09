#!/bin/bash

echo "⚙️ Caching configuration..."
php artisan config:cache
php artisan route:cache

echo "🗄️ Running migrations..."
php artisan migrate --force

echo "🔗 Linking storage..."
php artisan storage:link

echo "🚀 Starting server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
