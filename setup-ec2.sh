#!/bin/bash

# VGenTech EC2 Initial Setup Script
# Run this script ONCE on fresh EC2 instance

set -e

echo "🚀 Starting EC2 initial setup for VGenTech..."

# Update system
echo "📦 Updating system packages..."
sudo apt update && sudo apt upgrade -y

# Install essential tools
echo "🔧 Installing essential tools..."
sudo apt install -y git curl nano htop

# Install Docker
echo "🐳 Installing Docker..."
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker ubuntu
rm get-docker.sh

# Install Docker Compose
echo "🐙 Installing Docker Compose..."
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Verify installations
echo "✅ Verifying installations..."
docker --version
docker-compose --version

# Install Nginx
echo "🌐 Installing Nginx..."
sudo apt install -y nginx

# Enable Docker on boot
echo "🔄 Enabling Docker to start on boot..."
sudo systemctl enable docker

# Install firewall (optional)
echo "🔥 Setting up firewall..."
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
echo "y" | sudo ufw enable

# Clone project
echo "📥 Cloning VGenTech project..."
cd ~
git clone https://github.com/lapgun/vgentech.git
cd vgentech

# Copy .env
echo "⚙️  Creating .env file..."
cp .env.example .env

echo ""
echo "🎉 Initial setup completed!"
echo ""
echo "📝 Next steps:"
echo "1. Edit .env file: nano ~/vgentech/.env"
echo "2. Generate APP_KEY and set database password"
echo "3. Run: cd ~/vgentech && docker-compose up -d --build"
echo "4. Run: docker-compose exec app php artisan key:generate"
echo "5. Run: docker-compose exec app php artisan migrate --force"
echo "6. Configure Nginx (see DEPLOY_EC2.md)"
echo ""
echo "⚠️  IMPORTANT: Logout and login again for Docker group to take effect"
echo "   Command: exit (then SSH back in)"
echo ""
