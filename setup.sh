#!/bin/bash

# Colors for output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${BLUE}=== VgenTech Laravel Setup Script ===${NC}\n"

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo -e "${RED}Error: Docker is not running. Please start Docker Desktop first.${NC}"
    exit 1
fi

echo -e "${GREEN}Step 1: Building Docker images...${NC}"
docker-compose build

echo -e "\n${GREEN}Step 2: Starting containers...${NC}"
docker-compose up -d

echo -e "\n${GREEN}Step 3: Installing Laravel 12.x...${NC}"
docker-compose exec -T app sh -c "composer create-project laravel/laravel:^12.0 vgentech-app && cp -r vgentech-app/. . && rm -rf vgentech-app"

echo -e "\n${GREEN}Step 4: Setting up environment...${NC}"
docker-compose exec -T app cp .env.example .env
docker-compose exec -T app php artisan key:generate

# Update .env file with PostgreSQL database settings
docker-compose exec -T app sh -c "sed -i 's/DB_CONNECTION=.*/DB_CONNECTION=pgsql/' .env"
docker-compose exec -T app sh -c "sed -i 's/DB_HOST=.*/DB_HOST=db/' .env"
docker-compose exec -T app sh -c "sed -i 's/DB_PORT=.*/DB_PORT=5432/' .env"
docker-compose exec -T app sh -c "sed -i 's/DB_DATABASE=.*/DB_DATABASE=vgentech/' .env"
docker-compose exec -T app sh -c "sed -i 's/DB_USERNAME=.*/DB_USERNAME=vgentech/' .env"
docker-compose exec -T app sh -c "sed -i 's/DB_PASSWORD=.*/DB_PASSWORD=vgentech/' .env"

echo -e "\n${GREEN}Step 5: Setting permissions...${NC}"
docker-compose exec -T app chmod -R 775 storage bootstrap/cache

echo -e "\n${GREEN}Step 6: Installing Laravel Breeze...${NC}"
docker-compose exec -T app composer require laravel/breeze --dev
docker-compose exec -T app php artisan breeze:install blade

echo -e "\n${GREEN}Step 7: Installing NPM dependencies...${NC}"
docker-compose exec -T app npm install

echo -e "\n${GREEN}Step 8: Building assets...${NC}"
docker-compose exec -T app npm run build

echo -e "\n${GREEN}Step 9: Running migrations...${NC}"
docker-compose exec -T app php artisan migrate --force

echo -e "\n${BLUE}=== Setup Complete! ===${NC}"
echo -e "\n${GREEN}Your application is ready!${NC}"
echo -e "Application: ${BLUE}http://localhost:9000${NC}"
echo -e "\nDatabase: ${BLUE}PostgreSQL${NC}"
echo -e "Database Name: ${BLUE}vgentech${NC}"
echo -e "Username: ${BLUE}vgentech${NC}"
echo -e "Password: ${BLUE}vgentech${NC}"
echo -e "\n${GREEN}To stop the application:${NC} docker-compose down"
echo -e "${GREEN}To view logs:${NC} docker-compose logs -f"
