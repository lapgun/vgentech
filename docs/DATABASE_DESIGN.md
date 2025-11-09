# THIẾT KẾ CƠ SỞ DỮ LIỆU - VGENTECH WEBSITE

## Tổng quan
Website giới thiệu và bán sản phẩm máy phát điện của Công ty Cổ phần VGENTECH

## Các chức năng chính
1. **Quản lý sản phẩm** - Hiển thị danh mục và chi tiết các loại máy phát điện
2. **Quản lý dự án** - Showcase các dự án đã thực hiện
3. **Tin tức** - Đăng bài viết, tin tức ngành
4. **Tuyển dụng** - Đăng tin tuyển dụng nhân sự
5. **Liên hệ** - Nhận thông tin liên hệ, yêu cầu báo giá
6. **Trang tĩnh** - Giới thiệu, Cơ sở vật chất

---

## Chi tiết các bảng

### 1. CATEGORIES (Danh mục sản phẩm)
**Mục đích**: Phân loại sản phẩm theo danh mục (có thể có danh mục cha-con)

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| name | VARCHAR(255) | Tên danh mục |
| slug | VARCHAR(255) | URL-friendly name (unique) |
| parent_id | BIGINT | ID danh mục cha (NULL nếu là danh mục gốc) |
| description | TEXT | Mô tả danh mục |
| image | VARCHAR(500) | Ảnh đại diện danh mục |
| sort_order | INTEGER | Thứ tự hiển thị |
| is_active | BOOLEAN | Trạng thái kích hoạt |
| meta_title | VARCHAR(255) | SEO title |
| meta_description | TEXT | SEO description |
| meta_keywords | TEXT | SEO keywords |

**Ví dụ dữ liệu**:
- Máy phát điện Cummins (Ấn Độ, CCEC - China, DCEC - China)
- Máy phát điện Doosan
- Máy phát điện VMAN
- Phụ kiện (Đầu Cos, Cầu dao, Cáp điện)

---

### 2. PRODUCTS (Sản phẩm)
**Mục đích**: Lưu thông tin chi tiết sản phẩm máy phát điện

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| category_id | BIGINT | Khóa ngoại đến categories |
| name | VARCHAR(255) | Tên sản phẩm |
| slug | VARCHAR(255) | URL-friendly (unique) |
| sku | VARCHAR(100) | Mã sản phẩm |
| short_description | TEXT | Mô tả ngắn |
| description | TEXT | Mô tả chi tiết (HTML) |
| specifications | TEXT | Thông số kỹ thuật (JSON/HTML) |
| price | DECIMAL(15,2) | Giá (hoặc NULL nếu "Liên hệ") |
| featured_image | VARCHAR(500) | Ảnh đại diện |
| gallery | TEXT | JSON array các ảnh |
| is_featured | BOOLEAN | Sản phẩm nổi bật |
| is_active | BOOLEAN | Đang bán |
| view_count | INTEGER | Số lượt xem |
| sort_order | INTEGER | Thứ tự hiển thị |

**Thông số kỹ thuật mẫu** (JSON):
```json
{
  "power_output": "500 KVA",
  "engine": "Cummins 6LTAA8.9-G2",
  "alternator": "Stamford UCI274G",
  "voltage": "400V/230V",
  "frequency": "50Hz",
  "fuel_type": "Diesel",
  "fuel_consumption": "120 L/h",
  "dimensions": "3500 x 1500 x 1800 mm",
  "weight": "2500 kg"
}
```

---

### 3. PROJECTS (Dự án)
**Mục đích**: Hiển thị các dự án đã thực hiện để tạo uy tín

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| title | VARCHAR(255) | Tên dự án |
| slug | VARCHAR(255) | URL-friendly |
| client_name | VARCHAR(255) | Tên khách hàng |
| location | VARCHAR(255) | Địa điểm thực hiện |
| project_date | DATE | Ngày hoàn thành |
| short_description | TEXT | Mô tả ngắn |
| description | TEXT | Mô tả chi tiết |
| featured_image | VARCHAR(500) | Ảnh đại diện |
| gallery | TEXT | JSON array ảnh dự án |
| is_featured | BOOLEAN | Dự án tiêu biểu |
| is_active | BOOLEAN | Hiển thị |
| view_count | INTEGER | Số lượt xem |

**Ví dụ**: "Dự án cung cấp máy phát điện 1000KVA cho Bệnh viện Đa khoa Thanh Trì"

---

### 4. POSTS (Tin tức)
**Mục đích**: Đăng tin tức, bài viết về ngành, sản phẩm

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| user_id | BIGINT | Người đăng bài |
| title | VARCHAR(255) | Tiêu đề |
| slug | VARCHAR(255) | URL-friendly |
| excerpt | TEXT | Tóm tắt |
| content | TEXT | Nội dung (HTML) |
| featured_image | VARCHAR(500) | Ảnh đại diện |
| is_featured | BOOLEAN | Tin nổi bật |
| is_active | BOOLEAN | Đã xuất bản |
| published_at | TIMESTAMP | Ngày xuất bản |
| view_count | INTEGER | Số lượt xem |

---

### 5. RECRUITMENTS (Tuyển dụng)
**Mục đích**: Đăng tin tuyển dụng nhân sự

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| title | VARCHAR(255) | Tiêu đề tin tuyển dụng |
| slug | VARCHAR(255) | URL-friendly |
| position | VARCHAR(255) | Vị trí tuyển dụng |
| location | VARCHAR(255) | Nơi làm việc |
| salary_range | VARCHAR(100) | Mức lương (vd: "10-15 triệu") |
| job_type | VARCHAR(50) | Full-time/Part-time/Contract |
| quantity | INTEGER | Số lượng cần tuyển |
| deadline | DATE | Hạn nộp hồ sơ |
| description | TEXT | Mô tả công việc |
| requirements | TEXT | Yêu cầu ứng viên |
| benefits | TEXT | Quyền lợi |
| is_active | BOOLEAN | Đang tuyển |

**Ví dụ**: "Tuyển Kỹ thuật viên sửa chữa máy phát điện"

---

### 6. PAGES (Trang tĩnh)
**Mục đích**: Các trang nội dung cố định

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| title | VARCHAR(255) | Tiêu đề trang |
| slug | VARCHAR(255) | URL (vd: "gioi-thieu") |
| content | TEXT | Nội dung (HTML) |
| featured_image | VARCHAR(500) | Ảnh đại diện |
| template | VARCHAR(100) | Template blade sử dụng |
| is_active | BOOLEAN | Kích hoạt |

**Các trang**: Giới thiệu, Cơ sở vật chất, Chính sách bảo hành, Chính sách vận chuyển

---

### 7. CONTACTS (Liên hệ)
**Mục đích**: Lưu thông tin khách hàng liên hệ

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| name | VARCHAR(255) | Tên khách hàng |
| email | VARCHAR(255) | Email |
| phone | VARCHAR(20) | Số điện thoại |
| subject | VARCHAR(255) | Tiêu đề |
| message | TEXT | Nội dung liên hệ |
| ip_address | VARCHAR(45) | IP người gửi |
| is_read | BOOLEAN | Đã đọc chưa |
| replied_at | TIMESTAMP | Thời gian phản hồi |

---

### 8. SETTINGS (Cấu hình)
**Mục đích**: Lưu các thiết lập chung của website

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| key | VARCHAR(100) | Tên key (unique) |
| value | TEXT | Giá trị |
| type | VARCHAR(50) | Kiểu: text, textarea, number, boolean, json |
| group_name | VARCHAR(100) | Nhóm: general, contact, social, seo |
| description | TEXT | Mô tả |

**Ví dụ settings**:
```
site_name: "CÔNG TY CỔ PHẦN VGENTECH"
contact_phone: "024.2280.6868"
contact_hotline: "0938.518.555"
contact_email: "thaitechgtp@gmail.com"
contact_address: "Số 7, Ngõ Thượng Đường 3..."
social_facebook: "https://facebook.com/vgentech"
social_zalo: "0938518555"
```

---

### 9. PRODUCT_IMAGES (Ảnh sản phẩm)
**Mục đích**: Lưu nhiều ảnh cho mỗi sản phẩm

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| product_id | BIGINT | ID sản phẩm |
| image_path | VARCHAR(500) | Đường dẫn ảnh |
| alt_text | VARCHAR(255) | Text mô tả ảnh (SEO) |
| is_primary | BOOLEAN | Ảnh chính |
| sort_order | INTEGER | Thứ tự hiển thị |

---

### 10. PROJECT_IMAGES (Ảnh dự án)
Tương tự PRODUCT_IMAGES nhưng cho dự án

---

### 11. TAGS (Thẻ tag)
**Mục đích**: Gắn tag cho bài viết

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| name | VARCHAR(100) | Tên tag |
| slug | VARCHAR(100) | URL-friendly |

---

### 12. POST_TAG (Quan hệ Posts - Tags)
Bảng trung gian Many-to-Many

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| post_id | BIGINT | ID bài viết |
| tag_id | BIGINT | ID tag |

---

### 13. BANNERS (Banner quảng cáo)
**Mục đích**: Quản lý banner slider, sidebar

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| title | VARCHAR(255) | Tiêu đề banner |
| image | VARCHAR(500) | Ảnh banner |
| link | VARCHAR(500) | Link khi click |
| position | VARCHAR(50) | Vị trí: home_slider, sidebar, footer |
| sort_order | INTEGER | Thứ tự |
| is_active | BOOLEAN | Kích hoạt |
| start_date | TIMESTAMP | Ngày bắt đầu hiển thị |
| end_date | TIMESTAMP | Ngày kết thúc |

---

### 14. TESTIMONIALS (Đánh giá khách hàng)
**Mục đích**: Hiển thị feedback khách hàng

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| customer_name | VARCHAR(255) | Tên khách hàng |
| customer_position | VARCHAR(255) | Chức vụ |
| customer_company | VARCHAR(255) | Công ty |
| avatar | VARCHAR(500) | Ảnh đại diện |
| content | TEXT | Nội dung đánh giá |
| rating | INTEGER | Đánh giá 1-5 sao |
| is_active | BOOLEAN | Hiển thị |

---

### 15. PRODUCT_INQUIRIES (Yêu cầu báo giá)
**Mục đích**: Khách hàng yêu cầu báo giá sản phẩm

| Cột | Kiểu | Mô tả |
|-----|------|-------|
| id | BIGSERIAL | Khóa chính |
| product_id | BIGINT | Sản phẩm yêu cầu báo giá |
| customer_name | VARCHAR(255) | Tên khách hàng |
| customer_email | VARCHAR(255) | Email |
| customer_phone | VARCHAR(20) | SĐT |
| customer_company | VARCHAR(255) | Công ty |
| message | TEXT | Lời nhắn |
| ip_address | VARCHAR(45) | IP |
| is_processed | BOOLEAN | Đã xử lý |
| processed_at | TIMESTAMP | Thời gian xử lý |

---

## Sơ đồ quan hệ (Entity Relationship)

```
CATEGORIES (1) -----> (N) PRODUCTS
                      PRODUCTS (1) -----> (N) PRODUCT_IMAGES
                      PRODUCTS (1) -----> (N) PRODUCT_INQUIRIES

USERS (1) -----> (N) POSTS
                      POSTS (N) <-----> (N) TAGS (thông qua POST_TAG)

PROJECTS (1) -----> (N) PROJECT_IMAGES
```

---

## Indexes (Tối ưu hiệu suất)

```sql
-- Products
CREATE INDEX idx_products_category_id ON products(category_id);
CREATE INDEX idx_products_slug ON products(slug);
CREATE INDEX idx_products_is_active ON products(is_active);
CREATE INDEX idx_products_is_featured ON products(is_featured);

-- Posts
CREATE INDEX idx_posts_user_id ON posts(user_id);
CREATE INDEX idx_posts_slug ON posts(slug);
CREATE INDEX idx_posts_published_at ON posts(published_at);

-- Categories
CREATE INDEX idx_categories_parent_id ON categories(parent_id);
CREATE INDEX idx_categories_slug ON categories(slug);

-- Contacts
CREATE INDEX idx_contacts_is_read ON contacts(is_read);
CREATE INDEX idx_contacts_created_at ON contacts(created_at);
```

---

## Ghi chú bổ sung

### Về giá sản phẩm
- Nhiều sản phẩm hiển thị "Liên hệ" thay vì giá cụ thể
- Trường `price` có thể NULL
- Khi NULL, hiển thị nút "Liên hệ" thay vì giá

### Về SEO
- Mọi bảng chính đều có: `meta_title`, `meta_description`, `meta_keywords`
- Slug phải unique và URL-friendly

### Về upload file
- Ảnh lưu trong `storage/app/public/`
- Path lưu trong DB dạng: `products/abc.jpg`
- Sử dụng Laravel Storage để quản lý

### Về phân quyền
- Sử dụng bảng `users` có sẵn của Laravel Breeze
- Có thể thêm trường `role` (admin, editor, viewer)

---

## Các bước triển khai

1. ✅ Tạo migrations cho từng bảng
2. ⏳ Tạo Models với relationships
3. ⏳ Tạo Seeders với dữ liệu mẫu
4. ⏳ Tạo Controllers và Routes
5. ⏳ Tạo Views với Blade templates
6. ⏳ Tạo Admin panel để quản lý

---

**Người thiết kế**: GitHub Copilot  
**Ngày tạo**: 2025-11-09  
**Version**: 1.0
