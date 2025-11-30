# VgenTech - Laravel 12.x Project

## 🚀 Tổng quan

Dự án Laravel 12.x với Docker, PostgreSQL và Laravel Breeze authentication, được thiết kế cho website giới thiệu sản phẩm máy phát điện.

## 📋 Yêu cầu hệ thống

- Docker & Docker Compose
- Git Bash (Windows)

## 🛠️ Cài đặt và chạy dự án

### 1. Clone project (nếu cần)
```bash
git clone <repository-url>
cd vgentech
```

### 2. Khởi động Docker containers
```bash
docker-compose up -d
```

### 3. Truy cập ứng dụng
- **Website**: http://localhost:9000
- **Database**: localhost:5433
  - User: postgres
  - Password: 123456
  - Database: vgentech

### 4. Dừng containers
```bash
docker-compose down
```

## 🗄️ Cấu trúc Database

Database gồm **15 bảng chính**:

### Bảng quản lý nội dung
1. **categories** - Danh mục sản phẩm (hỗ trợ phân cấp)
2. **products** - Sản phẩm máy phát điện
3. **product_images** - Hình ảnh sản phẩm
4. **projects** - Dự án đã thực hiện
5. **project_images** - Hình ảnh dự án
6. **posts** - Bài viết/tin tức
7. **tags** - Thẻ tag cho bài viết
8. **post_tag** - Liên kết bài viết và tag
9. **recruitments** - Tuyển dụng
10. **pages** - Trang tĩnh
11. **contacts** - Form liên hệ

### Bảng hệ thống
12. **settings** - Cấu hình website
13. **banners** - Banner quảng cáo
14. **testimonials** - Đánh giá khách hàng
15. **product_inquiries** - Yêu cầu báo giá sản phẩm

### Bảng mặc định Laravel
- **users** - Người dùng (Laravel Breeze)
- **password_reset_tokens** - Reset mật khẩu
- **sessions** - Phiên đăng nhập
- **cache** - Cache
- **jobs** - Queue jobs

## 📊 Dữ liệu mẫu

Đã tạo sẵn dữ liệu mẫu bao gồm:

### Categories (9 danh mục)
- Máy phát điện Cummins (+ 3 danh mục con theo công suất)
- Máy phát điện Doosan
- Máy phát điện VMAN
- Phụ kiện & Linh kiện (+ 2 danh mục con)

### Products (5 sản phẩm)
- Máy phát điện Cummins: 50kVA, 100kVA, 250kVA
- Máy phát điện Doosan: 75kVA, 150kVA
- Mỗi sản phẩm có thông số kỹ thuật chi tiết

### Projects (3 dự án)
- Vingroup - 500kVA
- Samsung Bắc Ninh - 3x1000kVA
- Bệnh viện Đa khoa - 300kVA + ATS

### Posts (3 bài viết)
- Hướng dẫn bảo trì máy phát điện
- So sánh Cummins và Doosan
- Lựa chọn công suất phù hợp

### Khác
- 10 Tags
- 12 Settings (thông tin site, liên hệ, social media)
- 3 Banners
- 3 Testimonials

## 🔧 Các lệnh hữu ích

### Migrations
```bash
# Chạy migrations
docker-compose exec app php artisan migrate

# Rollback migrations
docker-compose exec app php artisan migrate:rollback

# Reset và chạy lại tất cả migrations + seeders
docker-compose exec app php artisan migrate:fresh --seed
```

### Seeders
```bash
# Chạy tất cả seeders
docker-compose exec app php artisan db:seed

# Chạy 1 seeder cụ thể
docker-compose exec app php artisan db:seed --class=ProductSeeder
```

### Cache
```bash
# Clear cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

### Truy cập container
```bash
# Truy cập vào container app
docker-compose exec app bash

# Truy cập vào database
docker-compose exec db psql -U postgres -d vgentech
```

## 💬 Chatbot AI

### Cấu hình
1. Cập nhật thông tin API trong `.env`:
   ```env
   OPENAI_API_KEY=your_api_key
   OPENAI_CHAT_MODEL=gpt-4o-mini
   OPENAI_API_ENDPOINT=https://api.openai.com/v1/chat/completions
   ```
2. Chạy migration để tạo bảng lưu phiên chat:
   ```bash
   docker-compose exec app php artisan migrate --path=database/migrations/2025_11_30_000800_create_chatbot_tables.php
   ```

### Sử dụng
- Widget chat hiển thị ở góc phải website, thu thập thông tin (tên, email, số điện thoại, nhu cầu).
- Chatbot trả lời bằng tiếng Việt (có thể đa ngôn ngữ tùy người dùng) thông qua OpenAI.
- Dữ liệu phiên chat lưu vào PostgreSQL trong các bảng `chat_sessions` và `chat_messages`.
- Trang quản trị: `Admin → Chatbot` (đường dẫn `/admin/chat-sessions`) để xem lịch sử, chi tiết hội thoại.

### Tinker (REPL)
```bash
# Mở Laravel Tinker
docker-compose exec app php artisan tinker

# Ví dụ query trong tinker:
# \App\Models\Product::where('is_featured', true)->get();
# \App\Models\Category::with('children')->get();
# \App\Models\Post::with('tags')->published()->get();
```

## 📝 Models và Relationships

### Category
```php
$category->parent();      // Category cha
$category->children();    // Categories con
$category->products();    // Sản phẩm trong danh mục
```

### Product
```php
$product->category();     // Danh mục
$product->images();       // Hình ảnh
$product->inquiries();    // Yêu cầu báo giá
```

### Project
```php
$project->images();       // Hình ảnh dự án
```

### Post
```php
$post->author();          // Tác giả (User)
$post->tags();            // Tags
```

### Scopes hữu ích
```php
// Lọc active records
Category::active()->get();
Product::active()->get();
Product::featured()->get();
Post::published()->get();
Banner::active()->position('home_slider')->get();
```

## 🔐 Authentication

Dự án sử dụng **Laravel Breeze** với Blade templates:

- Login: http://localhost:9000/login
- Register: http://localhost:9000/register
- Dashboard: http://localhost:9000/dashboard

**Admin mặc định:**
- Email: admin@vgentech.vn
- Password: password

## 📚 Tài liệu

- [Laravel 12.x Documentation](https://laravel.com/docs/12.x)
- [Laravel Breeze](https://laravel.com/docs/12.x/starter-kits#laravel-breeze)
- [PostgreSQL 16 Documentation](https://www.postgresql.org/docs/16/)
- [Docker Documentation](https://docs.docker.com/)

## 📁 Cấu trúc thư mục quan trọng

```
vgentech/
├── app/
│   └── Models/          # 14 Models với relationships
├── database/
│   ├── migrations/      # 15 migration files
│   ├── seeders/         # 8 seeders với dữ liệu mẫu
│   └── schema/          # SQL schema gốc
├── docs/
│   └── DATABASE_DESIGN.md  # Tài liệu thiết kế database chi tiết
├── docker-compose.yml   # Docker configuration
├── Dockerfile           # PHP 8.3 + PostgreSQL extensions
└── .env                 # Environment variables
```

## 🐛 Troubleshooting

### Container không khởi động
```bash
docker-compose down -v
docker-compose up -d --build
```

### Database connection error
```bash
docker-compose exec app php artisan config:clear
docker-compose restart
```

### Port đã được sử dụng
Sửa file `docker-compose.yml`, thay đổi ports:
- App: `"9000:8000"` → `"XXXX:8000"`
- DB: `"5433:5432"` → `"YYYY:5432"`

### Xem logs
```bash
docker-compose logs app
docker-compose logs db
docker-compose logs -f  # Follow mode
```

## 🎯 Tính năng đã hoàn thành

✅ Docker environment với PHP 8.3 + PostgreSQL 16  
✅ Laravel 12.x (version 12.37.0)  
✅ Laravel Breeze authentication  
✅ 15 bảng database với relationships đầy đủ  
✅ 14 Models với scopes và relationships  
✅ Dữ liệu mẫu cho tất cả bảng  
✅ Support phân cấp Categories (parent-child)  
✅ Many-to-many relationship (Post-Tag)  
✅ SEO fields (meta_title, meta_description, meta_keywords)  
✅ Featured items (products, projects, posts)  
✅ View counter cho products, projects, posts  
✅ Soft dates cho banners (start_date, end_date)  
✅ Gallery support (JSON field cho nhiều ảnh)  
✅ Specifications support (JSON field cho thông số kỹ thuật)  

## 👥 Phát triển tiếp

### Gợi ý các tính năng có thể thêm:

1. **Frontend**
   - Tạo Controllers và Views cho website
   - API endpoints cho mobile app
   - Admin panel với CRUD operations

2. **Tính năng nâng cao**
   - Upload và quản lý hình ảnh
   - Export/Import products
   - Tìm kiếm và lọc sản phẩm
   - So sánh sản phẩm
   - Giỏ hàng và đặt hàng
   - Email notifications
   - Sitemap generator

3. **Tối ưu**
   - Redis cache
   - Queue jobs
   - Image optimization
   - CDN integration
   - Full-text search với PostgreSQL

## 📞 Liên hệ

Để biết thêm thông tin, vui lòng xem file `docs/DATABASE_DESIGN.md`

---

**Phiên bản**: 1.0.0  
**Laravel**: 12.37.0  
**PHP**: 8.3  
**PostgreSQL**: 16  
**Ngày tạo**: 2025-11-09
