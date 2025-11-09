# VGenTech EC2 Deployment - Quick Start Guide

## 📋 Prerequisites

- AWS Account
- EC2 Instance (Ubuntu 22.04)
- SSH Key (.pem file)
- Domain name (optional, for SSL)

## 🚀 Quick Deploy (5 minutes)

### 1. SSH vào EC2

```bash
ssh -i your-key.pem ubuntu@<EC2_PUBLIC_IP>
```

### 2. Run setup script (chỉ lần đầu)

```bash
curl -fsSL https://raw.githubusercontent.com/lapgun/vgentech/main/setup-ec2.sh -o setup-ec2.sh
chmod +x setup-ec2.sh
./setup-ec2.sh
```

**Sau đó LOGOUT và LOGIN lại để Docker group có hiệu lực:**
```bash
exit
ssh -i your-key.pem ubuntu@<EC2_PUBLIC_IP>
```

### 3. Cấu hình .env

```bash
cd ~/vgentech
nano .env
```

**Thay đổi:**
- `DB_PASSWORD`: Đặt password mạnh
- `APP_URL`: Thay bằng EC2 IP hoặc domain

### 4. Start application

```bash
docker-compose up -d --build
```

### 5. Setup Laravel

```bash
# Generate APP_KEY
docker-compose exec app php artisan key:generate

# Run migrations
docker-compose exec app php artisan migrate --force

# Seed database (optional)
docker-compose exec app php artisan db:seed --force

# Cache everything
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
docker-compose exec app php artisan storage:link
```

### 6. Configure Nginx

```bash
# Copy nginx config
sudo cp ~/vgentech/nginx-vgentech.conf /etc/nginx/sites-available/vgentech

# Edit config - replace YOUR_EC2_IP_OR_DOMAIN
sudo nano /etc/nginx/sites-available/vgentech

# Enable site
sudo ln -s /etc/nginx/sites-available/vgentech /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default

# Test and reload
sudo nginx -t
sudo systemctl reload nginx
```

### 7. Open website

```
http://<EC2_PUBLIC_IP>
```

## 🔄 Update/Redeploy

```bash
cd ~/vgentech
./deploy.sh
```

## 🔧 Common Commands

```bash
# View logs
docker-compose logs -f app

# Restart containers
docker-compose restart

# Check status
docker-compose ps

# Access app container
docker-compose exec app bash

# Database backup
docker-compose exec db pg_dump -U postgres vgentech > backup.sql
```

## 🛡️ Security Checklist

- [x] Change DB_PASSWORD trong .env
- [x] Set APP_DEBUG=false
- [x] Enable firewall (UFW)
- [x] Restrict SSH to your IP only
- [ ] Setup SSL certificate (Let's Encrypt)
- [ ] Setup automated backups
- [ ] Configure CloudWatch monitoring

## 📊 Costs Estimate (AWS Free Tier)

- **EC2 t2.micro**: $0/month (750 hours free)
- **20GB Storage**: $0/month (30GB free)
- **Data Transfer**: $0/month (15GB out free)

**After Free Tier (~12 months):**
- **EC2 t2.micro**: ~$8/month
- **20GB EBS**: ~$2/month
- **Total**: ~$10/month

## 🆘 Troubleshooting

### Port 8000 already in use
```bash
sudo lsof -i :8000
sudo kill -9 <PID>
docker-compose down && docker-compose up -d
```

### Nginx 502 Bad Gateway
```bash
# Check if app is running
docker-compose ps
docker-compose logs app

# Restart services
docker-compose restart
sudo systemctl restart nginx
```

### Database connection refused
```bash
# Check DB container
docker-compose logs db

# Verify .env DB settings
cat .env | grep DB_
```

### Permission denied
```bash
docker-compose exec app chown -R www:www /var/www/html/storage
docker-compose exec app chmod -R 775 /var/www/html/storage
```

## 📞 Support

- Documentation: `~/vgentech/DEPLOY_EC2.md`
- GitHub: https://github.com/lapgun/vgentech
- Logs: `docker-compose logs -f`

---

**Happy Deploying! 🎉**
