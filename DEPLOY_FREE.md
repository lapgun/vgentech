# Deploy VgenTech MIỄN PHÍ

## ✅ Code đã push lên GitHub
Repository: https://github.com/lapgun/vgentech

## 🆓 OPTION 1: Railway.app (RECOMMENDED - Easiest)

### Tính năng:
- ✅ Free $5 credit/month (đủ cho website nhỏ)
- ✅ PostgreSQL database free
- ✅ Auto deploy từ GitHub
- ✅ Custom domain miễn phí
- ✅ SSL certificate tự động

### Các bước:

1. **Đăng ký Railway**
   - Vào: https://railway.app/
   - Click "Login with GitHub"
   - Authorize Railway

2. **Tạo Project mới**
   - Click "New Project"
   - Chọn "Deploy from GitHub repo"
   - Chọn repository: `lapgun/vgentech`
   - Click "Deploy Now"

3. **Add PostgreSQL Database**
   - Click "+ New"
   - Chọn "Database"
   - Chọn "PostgreSQL"
   - Railway sẽ tự động link database

4. **Cấu hình Environment Variables**
   
   Vào Settings → Variables, thêm:
   
   ```env
   APP_NAME=VgenTech
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=${{RAILWAY_PUBLIC_DOMAIN}}
   
   DB_CONNECTION=pgsql
   DB_HOST=${{Postgres.PGHOST}}
   DB_PORT=${{Postgres.PGPORT}}
   DB_DATABASE=${{Postgres.PGDATABASE}}
   DB_USERNAME=${{Postgres.PGUSER}}
   DB_PASSWORD=${{Postgres.PGPASSWORD}}
   
   SESSION_DRIVER=database
   CACHE_DRIVER=database
   ```

5. **Generate APP_KEY**
   
   Trong Railway Terminal:
   ```bash
   php artisan key:generate --show
   ```
   
   Copy key và thêm vào Variables:
   ```env
   APP_KEY=base64:xxx...
   ```

6. **Tạo Procfile cho Railway**

7. **Deploy và Migrate**
   
   Railway sẽ tự động deploy. Sau đó chạy trong Terminal:
   ```bash
   php artisan migrate --force
   php artisan db:seed --class=SettingSeeder
   php artisan db:seed --class=CategorySeeder
   php artisan db:seed --class=BannerSeeder
   php artisan storage:link
   ```

8. **Custom Domain (Optional)**
   - Settings → Domains
   - Add domain: `vgentech.com`
   - Cấu hình DNS:
     ```
     Type: CNAME
     Name: @
     Value: xxx.railway.app
     ```

---

## 🆓 OPTION 2: Render.com

### Tính năng:
- ✅ Free tier
- ✅ PostgreSQL database free
- ✅ Auto deploy từ GitHub
- ✅ SSL tự động
- ⚠️ App sleep sau 15 phút không dùng

### Các bước:

1. **Đăng ký Render**
   - Vào: https://render.com/
   - Sign up with GitHub

2. **Create New Web Service**
   - Dashboard → "New +"
   - "Web Service"
   - Connect repository: `lapgun/vgentech`

3. **Configure Service**
   ```
   Name: vgentech
   Region: Singapore
   Branch: main
   Runtime: PHP
   Build Command: composer install --no-dev && npm ci && npm run build && php artisan config:cache
   Start Command: php artisan serve --host=0.0.0.0 --port=$PORT
   ```

4. **Add PostgreSQL**
   - Dashboard → "New +"
   - "PostgreSQL"
   - Name: vgentech-db
   - Free tier

5. **Environment Variables**
   
   Trong Environment tab:
   ```env
   APP_NAME=VgenTech
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://vgentech.onrender.com
   
   DATABASE_URL=[Copy from PostgreSQL info]
   
   SESSION_DRIVER=database
   CACHE_DRIVER=database
   ```

---

## 🆓 OPTION 3: Fly.io

### Tính năng:
- ✅ Free tier generous
- ✅ PostgreSQL free
- ✅ Custom domain free
- ✅ Global CDN

### Các bước:

1. **Install Fly CLI**
   ```bash
   # Windows PowerShell
   iwr https://fly.io/install.ps1 -useb | iex
   ```

2. **Login và Init**
   ```bash
   fly auth login
   cd /c/Users/Admin/Desktop/VgenTech/vgentech
   fly launch --name vgentech --region sin
   ```

3. **Create PostgreSQL**
   ```bash
   fly postgres create --name vgentech-db --region sin
   fly postgres attach vgentech-db
   ```

4. **Deploy**
   ```bash
   fly deploy
   ```

5. **Run Migrations**
   ```bash
   fly ssh console
   php artisan migrate --force
   php artisan db:seed
   ```

---

## 🆓 OPTION 4: InfinityFree (Shared Hosting)

### Tính năng:
- ✅ Hoàn toàn miễn phí
- ✅ MySQL database
- ✅ Unlimited bandwidth
- ⚠️ Performance giới hạn

### Các bước:

1. **Đăng ký**: https://www.infinityfree.net/
2. **Upload code qua FTP**
3. **Import database**
4. **Configure .env**

---

## 📊 So sánh

| Platform | Free Tier | Database | Performance | Easy Setup |
|----------|-----------|----------|-------------|------------|
| **Railway** | $5/month | PostgreSQL | ⭐⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ |
| **Render** | Yes (sleep) | PostgreSQL | ⭐⭐⭐⭐ | ⭐⭐⭐⭐ |
| **Fly.io** | Generous | PostgreSQL | ⭐⭐⭐⭐⭐ | ⭐⭐⭐ |
| **InfinityFree** | Unlimited | MySQL | ⭐⭐ | ⭐⭐ |

## 🎯 RECOMMENDED: Railway.app

**Lý do:**
1. Dễ setup nhất (1-click deploy)
2. Free credit $5/month đủ dùng
3. PostgreSQL database sẵn
4. Performance tốt
5. Auto deploy khi push code
6. Custom domain free

## 🚀 Quick Start với Railway

```bash
# Code đã ở GitHub rồi, chỉ cần:
1. Vào https://railway.app/
2. Login with GitHub
3. New Project → Deploy from GitHub
4. Chọn lapgun/vgentech
5. Add PostgreSQL
6. Done! Website live trong 5 phút
```

## 📝 Sau khi deploy

Website sẽ có URL: `https://vgentech-xxx.railway.app`

Để chạy seeders:
```bash
# Trong Railway Terminal
php artisan db:seed --class=SettingSeeder
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=BannerSeeder
php artisan db:seed --class=ProductSeeder
php artisan db:seed --class=ProjectSeeder
php artisan db:seed --class=PostSeeder
php artisan db:seed --class=RecruitmentSeeder
php artisan db:seed --class=TestimonialSeeder
```

## 🔧 Troubleshooting

### ⚠️ Lỗi "vendor/autoload.php not found"

**Nguyên nhân:** Composer dependencies chưa được install

**Giải pháp:**

1. **Trong Railway Settings → Deploy**:
   - Build Command: `composer install --no-dev --optimize-autoloader && npm ci && npm run build`
   - Start Command: `php artisan config:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT`

2. **Hoặc chạy manual trong Terminal**:
   ```bash
   composer install --no-dev --optimize-autoloader
   npm ci
   npm run build
   ```

3. **Redeploy**:
   - Railway: Click "Deploy" để rebuild
   - Hoặc push commit mới lên GitHub

### Lỗi 500
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan key:generate
```

### Assets không load
```bash
npm run build
php artisan storage:link
chmod -R 755 storage bootstrap/cache
```

### Database connection failed
```bash
# Check environment variables
php artisan config:clear
php artisan tinker
>>> DB::connection()->getPdo();
```

### Build timeout
- Tăng timeout trong Railway settings
- Hoặc remove dev dependencies: `composer install --no-dev`

### Memory limit exceeded
```bash
# Add to php.ini or .user.ini
memory_limit = 512M
```

## 💡 Tips

1. **Monitor usage**: Railway dashboard shows credit usage
2. **Optimize**: Enable caching để giảm resource
3. **Backup**: Railway tự động backup database
4. **Logs**: Check logs để debug issues

---

Bạn muốn deploy platform nào? Railway là đơn giản nhất! 🚀
