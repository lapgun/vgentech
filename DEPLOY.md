# Deploy VgenTech lên Laravel Cloud

## Bước 1: Chuẩn bị Git Repository

```bash
# Đã khởi tạo git repository
git add .
git commit -m "Initial commit - VgenTech website"
```

## Bước 2: Tạo Repository trên GitHub/GitLab

1. Vào https://github.com (hoặc GitLab)
2. Tạo repository mới: `vgentech`
3. Copy URL repository

```bash
# Thêm remote origin
git remote add origin https://github.com/YOUR_USERNAME/vgentech.git
git branch -M main
git push -u origin main
```

## Bước 3: Đăng ký Laravel Cloud

1. Vào https://cloud.laravel.com/
2. Đăng nhập bằng GitHub/GitLab account
3. Click "Create New Project"

## Bước 4: Kết nối Repository

1. Chọn repository: `vgentech`
2. Chọn branch: `main`
3. Chọn region gần nhất (Singapore cho VN)

## Bước 5: Cấu hình Database

Laravel Cloud sẽ tự động tạo PostgreSQL database. Lưu credentials:

- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

## Bước 6: Cấu hình Environment Variables

Trong Laravel Cloud dashboard, thêm các biến môi trường:

### Required Variables:
```env
APP_NAME=VgenTech
APP_ENV=production
APP_DEBUG=false
APP_URL=https://vgentech.laravel.app
APP_KEY= # Laravel Cloud sẽ generate

DB_CONNECTION=pgsql
# DB credentials từ bước 5

MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@vgentech.com
MAIL_FROM_NAME=VgenTech
```

## Bước 7: Custom Domain (Optional)

1. Trong Laravel Cloud: Settings → Domains
2. Thêm domain: `vgentech.com`
3. Cấu hình DNS records:

```
Type: CNAME
Name: @
Value: your-app.laravel.app
```

## Bước 8: Deploy

1. Click "Deploy" trong Laravel Cloud dashboard
2. Chờ build process hoàn thành (3-5 phút)
3. Kiểm tra logs nếu có lỗi

## Bước 9: Seed Database (Lần đầu)

Trong Laravel Cloud terminal:

```bash
php artisan db:seed --class=SettingSeeder
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=ProductSeeder
php artisan db:seed --class=ProjectSeeder
php artisan db:seed --class=PostSeeder
php artisan db:seed --class=RecruitmentSeeder
php artisan db:seed --class=BannerSeeder
php artisan db:seed --class=TestimonialSeeder
```

## Bước 10: Kiểm tra Website

1. Truy cập: `https://vgentech.laravel.app`
2. Test các tính năng:
   - Navigation menu
   - Search
   - Contact form
   - Đa ngôn ngữ (vi/en/zh)
   - Upload CV (recruitment)

## Troubleshooting

### Lỗi Storage Permission
```bash
php artisan storage:link
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Lỗi Assets không load
```bash
npm run build
php artisan view:clear
php artisan config:clear
```

### Check Logs
```bash
tail -f storage/logs/laravel.log
```

## Monitoring

Laravel Cloud cung cấp:
- Real-time metrics
- Error tracking
- Performance monitoring
- Automated backups

## Scaling

Khi traffic tăng, trong Settings:
1. Tăng số web workers
2. Enable Redis cache
3. Add queue workers
4. Enable CDN cho assets

## Chi phí dự kiến

- Starter: $19/month (Đủ cho website nhỏ)
- Professional: $49/month (Recommended)
- Business: $199/month (High traffic)

## Support

- Docs: https://cloud.laravel.com/docs
- Discord: https://discord.gg/laravel
- Email: support@laravel.com
