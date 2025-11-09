# Deploy Laravel VGenTech lên AWS EC2

## Bước 1: Tạo EC2 Instance

1. **Đăng nhập AWS Console**: https://console.aws.amazon.com/ec2/
2. **Launch Instance**:
   - Name: `vgentech-server`
   - AMI: Ubuntu Server 22.04 LTS (Free tier eligible)
   - Instance type: `t2.micro` (1 vCPU, 1GB RAM - Free tier)
   - Key pair: Tạo mới hoặc chọn existing (lưu file .pem)
   - Security Group: Tạo mới với rules:
     - SSH (22) - Your IP
     - HTTP (80) - 0.0.0.0/0
     - HTTPS (443) - 0.0.0.0/0
   - Storage: 20GB gp3

3. **Launch Instance** và đợi Status = Running

## Bước 2: Connect SSH vào EC2

```bash
# Windows (Git Bash hoặc WSL)
chmod 400 vgentech-key.pem
ssh -i vgentech-key.pem ubuntu@<EC2_PUBLIC_IP>
```

## Bước 3: Install Docker & Docker Compose trên EC2

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker ubuntu

# Install Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Verify installation
docker --version
docker-compose --version

# Logout and login again for docker group to take effect
exit
```

## Bước 4: Clone Project từ GitHub

```bash
# SSH lại vào EC2
ssh -i vgentech-key.pem ubuntu@<EC2_PUBLIC_IP>

# Install Git
sudo apt install git -y

# Clone project
git clone https://github.com/lapgun/vgentech.git
cd vgentech

# Copy .env file
cp .env.example .env
nano .env
```

## Bước 5: Cấu hình .env cho Production

```env
APP_NAME=VGenTech
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://<EC2_PUBLIC_IP>

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=vgentech
DB_USERNAME=postgres
DB_PASSWORD=your_secure_password_here

SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

## Bước 6: Install Dependencies và Start Docker Containers

```bash
# IMPORTANT: Install Composer dependencies FIRST!
docker run --rm -v ~/vgentech:/app composer:latest install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Build and start containers
docker-compose up -d --build

# Wait for containers to be ready
sleep 10

# Verify containers are running (not restarting)
docker-compose ps

# If "app" container is restarting, check logs:
# docker-compose logs app

# Generate APP_KEY
docker-compose exec app php artisan key:generate

# Run migrations
docker-compose exec app php artisan migrate --force

# Seed database (optional)
docker-compose exec app php artisan db:seed --force

# Cache config
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

# Create storage link
docker-compose exec app php artisan storage:link

# Set permissions
docker-compose exec app chown -R www:www /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/storage
```

## Bước 7: Install và Configure Nginx (Reverse Proxy)

```bash
# Install Nginx
sudo apt install nginx -y

# Create Nginx config
sudo nano /etc/nginx/sites-available/vgentech
```

Paste config sau:

```nginx
server {
    listen 80;
    server_name <EC2_PUBLIC_IP>;

    location / {
        proxy_pass http://localhost:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

```bash
# Enable site
sudo ln -s /etc/nginx/sites-available/vgentech /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default

# Test config
sudo nginx -t

# Restart Nginx
sudo systemctl restart nginx
sudo systemctl enable nginx
```

## Bước 8: Setup SSL với Let's Encrypt (Optional)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx -y

# Get SSL certificate (cần domain name)
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal
sudo systemctl enable certbot.timer
```

## Bước 9: Setup Auto-start on Reboot

```bash
# Enable Docker to start on boot
sudo systemctl enable docker

# Docker Compose auto-start
sudo nano /etc/systemd/system/vgentech.service
```

Paste:

```ini
[Unit]
Description=VGenTech Docker Compose
Requires=docker.service
After=docker.service

[Service]
Type=oneshot
RemainAfterExit=yes
WorkingDirectory=/home/ubuntu/vgentech
ExecStart=/usr/local/bin/docker-compose up -d
ExecStop=/usr/local/bin/docker-compose down
TimeoutStartSec=0

[Install]
WantedBy=multi-user.target
```

```bash
# Enable service
sudo systemctl enable vgentech.service
sudo systemctl start vgentech.service
```

## Bước 10: Kiểm tra Website

Truy cập: `http://<EC2_PUBLIC_IP>`

## Monitoring & Maintenance

```bash
# View logs
docker-compose logs -f

# Check container status
docker-compose ps

# Restart containers
docker-compose restart

# Update code
cd /home/ubuntu/vgentech
git pull origin main
docker-compose down
docker-compose up -d --build
docker-compose exec app php artisan migrate --force
docker-compose exec app php artisan config:cache
```

## Security Best Practices

1. **Change default database password** trong .env
2. **Restrict SSH** - Chỉ cho phép IP cụ thể
3. **Enable firewall**:
   ```bash
   sudo ufw allow 22/tcp
   sudo ufw allow 80/tcp
   sudo ufw allow 443/tcp
   sudo ufw enable
   ```
4. **Regular updates**:
   ```bash
   sudo apt update && sudo apt upgrade -y
   ```
5. **Backup database** định kỳ
6. **Monitor disk space**: `df -h`

## Troubleshooting

### Container không start:
```bash
docker-compose logs app
docker-compose logs db
```

### vendor/autoload.php not found:
```bash
# Stop containers
docker-compose down

# Install dependencies first
docker run --rm -v ~/vgentech:/app composer:latest install --no-dev --no-interaction

# Start again
docker-compose up -d --build
```

### Permission denied:
```bash
docker-compose exec app chown -R www:www /var/www/html
```

### Port 8000 đã được dùng:
```bash
sudo lsof -i :8000
sudo kill -9 <PID>
```

### Database connection error:
- Kiểm tra DB_HOST=db trong .env
- Kiểm tra postgres container: `docker-compose ps`

---

## Quick Deploy Script

Tạo file `deploy.sh`:

```bash
#!/bin/bash
cd /home/ubuntu/vgentech
git pull origin main
docker-compose down
docker-compose up -d --build
sleep 10
docker-compose exec -T app php artisan migrate --force
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache
echo "✅ Deploy completed!"
```

```bash
chmod +x deploy.sh
./deploy.sh
```
