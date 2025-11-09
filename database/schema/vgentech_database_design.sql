-- =====================================================
-- VGENTECH DATABASE DESIGN
-- Website giới thiệu sản phẩm máy phát điện
-- =====================================================

-- 1. BẢNG CATEGORIES (Danh mục sản phẩm)
-- Lưu các danh mục sản phẩm như: Máy phát điện Cummins, Doosan, Phụ kiện, v.v.
CREATE TABLE categories (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    parent_id BIGINT NULL REFERENCES categories(id) ON DELETE SET NULL,
    description TEXT NULL,
    image VARCHAR(500) NULL,
    sort_order INTEGER DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    meta_keywords TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 2. BẢNG PRODUCTS (Sản phẩm)
-- Lưu thông tin các sản phẩm máy phát điện
CREATE TABLE products (
    id BIGSERIAL PRIMARY KEY,
    category_id BIGINT NULL REFERENCES categories(id) ON DELETE SET NULL,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    sku VARCHAR(100) NULL, -- Mã sản phẩm
    short_description TEXT NULL,
    description TEXT NULL,
    specifications TEXT NULL, -- Thông số kỹ thuật (JSON hoặc HTML)
    price DECIMAL(15,2) NULL,
    featured_image VARCHAR(500) NULL,
    gallery TEXT NULL, -- JSON array chứa các ảnh
    is_featured BOOLEAN DEFAULT FALSE, -- Sản phẩm nổi bật
    is_active BOOLEAN DEFAULT TRUE,
    view_count INTEGER DEFAULT 0,
    sort_order INTEGER DEFAULT 0,
    
    -- SEO
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    meta_keywords TEXT NULL,
    
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 3. BẢNG PROJECTS (Dự án)
-- Lưu các dự án đã thực hiện
CREATE TABLE projects (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    client_name VARCHAR(255) NULL, -- Tên khách hàng
    location VARCHAR(255) NULL, -- Địa điểm
    project_date DATE NULL, -- Ngày thực hiện
    short_description TEXT NULL,
    description TEXT NULL,
    featured_image VARCHAR(500) NULL,
    gallery TEXT NULL, -- JSON array chứa các ảnh
    is_featured BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    view_count INTEGER DEFAULT 0,
    sort_order INTEGER DEFAULT 0,
    
    -- SEO
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    meta_keywords TEXT NULL,
    
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 4. BẢNG POSTS (Tin tức)
-- Lưu các bài viết tin tức
CREATE TABLE posts (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NULL REFERENCES users(id) ON DELETE SET NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    excerpt TEXT NULL, -- Tóm tắt
    content TEXT NULL,
    featured_image VARCHAR(500) NULL,
    is_featured BOOLEAN DEFAULT FALSE, -- Tin nổi bật
    is_active BOOLEAN DEFAULT TRUE,
    published_at TIMESTAMP NULL,
    view_count INTEGER DEFAULT 0,
    
    -- SEO
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    meta_keywords TEXT NULL,
    
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 5. BẢNG RECRUITMENTS (Tuyển dụng)
-- Lưu thông tin tuyển dụng
CREATE TABLE recruitments (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    position VARCHAR(255) NOT NULL, -- Vị trí tuyển dụng
    location VARCHAR(255) NULL, -- Địa điểm làm việc
    salary_range VARCHAR(100) NULL, -- Mức lương
    job_type VARCHAR(50) NULL, -- Full-time, Part-time, Contract
    quantity INTEGER DEFAULT 1, -- Số lượng cần tuyển
    deadline DATE NULL, -- Hạn nộp hồ sơ
    description TEXT NULL, -- Mô tả công việc
    requirements TEXT NULL, -- Yêu cầu
    benefits TEXT NULL, -- Quyền lợi
    is_active BOOLEAN DEFAULT TRUE,
    view_count INTEGER DEFAULT 0,
    
    -- SEO
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    meta_keywords TEXT NULL,
    
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 6. BẢNG PAGES (Trang tĩnh)
-- Lưu các trang tĩnh: Giới thiệu, Cơ sở vật chất, Liên hệ
CREATE TABLE pages (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content TEXT NULL,
    featured_image VARCHAR(500) NULL,
    template VARCHAR(100) NULL, -- Template sử dụng
    is_active BOOLEAN DEFAULT TRUE,
    sort_order INTEGER DEFAULT 0,
    
    -- SEO
    meta_title VARCHAR(255) NULL,
    meta_description TEXT NULL,
    meta_keywords TEXT NULL,
    
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 7. BẢNG CONTACTS (Liên hệ)
-- Lưu thông tin liên hệ từ khách hàng
CREATE TABLE contacts (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(20) NULL,
    subject VARCHAR(255) NULL,
    message TEXT NULL,
    ip_address VARCHAR(45) NULL,
    is_read BOOLEAN DEFAULT FALSE,
    replied_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 8. BẢNG SETTINGS (Cấu hình website)
-- Lưu các cấu hình chung của website
CREATE TABLE settings (
    id BIGSERIAL PRIMARY KEY,
    key VARCHAR(100) UNIQUE NOT NULL,
    value TEXT NULL,
    type VARCHAR(50) DEFAULT 'text', -- text, textarea, number, boolean, json
    group_name VARCHAR(100) NULL, -- general, contact, social, seo
    description TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 9. BẢNG PRODUCT_IMAGES (Ảnh sản phẩm)
-- Lưu nhiều ảnh cho một sản phẩm
CREATE TABLE product_images (
    id BIGSERIAL PRIMARY KEY,
    product_id BIGINT NOT NULL REFERENCES products(id) ON DELETE CASCADE,
    image_path VARCHAR(500) NOT NULL,
    alt_text VARCHAR(255) NULL,
    is_primary BOOLEAN DEFAULT FALSE,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 10. BẢNG PROJECT_IMAGES (Ảnh dự án)
CREATE TABLE project_images (
    id BIGSERIAL PRIMARY KEY,
    project_id BIGINT NOT NULL REFERENCES projects(id) ON DELETE CASCADE,
    image_path VARCHAR(500) NOT NULL,
    alt_text VARCHAR(255) NULL,
    is_primary BOOLEAN DEFAULT FALSE,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 11. BẢNG TAGS (Thẻ tag)
CREATE TABLE tags (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 12. BẢNG POST_TAG (Quan hệ nhiều-nhiều giữa Posts và Tags)
CREATE TABLE post_tag (
    post_id BIGINT NOT NULL REFERENCES posts(id) ON DELETE CASCADE,
    tag_id BIGINT NOT NULL REFERENCES tags(id) ON DELETE CASCADE,
    PRIMARY KEY (post_id, tag_id)
);

-- 13. BẢNG BANNERS (Banner quảng cáo)
CREATE TABLE banners (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    image VARCHAR(500) NOT NULL,
    link VARCHAR(500) NULL,
    position VARCHAR(50) NULL, -- home_slider, sidebar, footer
    sort_order INTEGER DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    start_date TIMESTAMP NULL,
    end_date TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 14. BẢNG TESTIMONIALS (Đánh giá khách hàng)
CREATE TABLE testimonials (
    id BIGSERIAL PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_position VARCHAR(255) NULL,
    customer_company VARCHAR(255) NULL,
    avatar VARCHAR(500) NULL,
    content TEXT NOT NULL,
    rating INTEGER DEFAULT 5, -- 1-5 sao
    is_active BOOLEAN DEFAULT TRUE,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- 15. BẢNG PRODUCT_INQUIRIES (Yêu cầu báo giá sản phẩm)
CREATE TABLE product_inquiries (
    id BIGSERIAL PRIMARY KEY,
    product_id BIGINT NULL REFERENCES products(id) ON DELETE SET NULL,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NULL,
    customer_phone VARCHAR(20) NULL,
    customer_company VARCHAR(255) NULL,
    message TEXT NULL,
    ip_address VARCHAR(45) NULL,
    is_processed BOOLEAN DEFAULT FALSE,
    processed_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- =====================================================
-- INDEXES cho tối ưu hiệu suất
-- =====================================================

CREATE INDEX idx_products_category_id ON products(category_id);
CREATE INDEX idx_products_slug ON products(slug);
CREATE INDEX idx_products_is_active ON products(is_active);
CREATE INDEX idx_products_is_featured ON products(is_featured);

CREATE INDEX idx_posts_user_id ON posts(user_id);
CREATE INDEX idx_posts_slug ON posts(slug);
CREATE INDEX idx_posts_published_at ON posts(published_at);
CREATE INDEX idx_posts_is_active ON posts(is_active);

CREATE INDEX idx_projects_slug ON projects(slug);
CREATE INDEX idx_projects_is_active ON projects(is_active);

CREATE INDEX idx_recruitments_slug ON recruitments(slug);
CREATE INDEX idx_recruitments_deadline ON recruitments(deadline);
CREATE INDEX idx_recruitments_is_active ON recruitments(is_active);

CREATE INDEX idx_categories_parent_id ON categories(parent_id);
CREATE INDEX idx_categories_slug ON categories(slug);

CREATE INDEX idx_contacts_is_read ON contacts(is_read);
CREATE INDEX idx_contacts_created_at ON contacts(created_at);

-- =====================================================
-- DỮ LIỆU MẪU
-- =====================================================

-- Settings mặc định
INSERT INTO settings (key, value, type, group_name, description) VALUES
('site_name', 'CÔNG TY CỔ PHẦN VGENTECH', 'text', 'general', 'Tên website'),
('site_description', 'Nhập khẩu và phân phối máy phát điện', 'textarea', 'general', 'Mô tả website'),
('contact_address', 'Số 7, Ngõ Thượng Đường 3, Thôn 1, Xã Đông Mỹ, Huyện Thanh Trì, Hà Nội', 'textarea', 'contact', 'Địa chỉ'),
('contact_phone', '024.2280.6868', 'text', 'contact', 'Số điện thoại'),
('contact_hotline', '0938.518.555', 'text', 'contact', 'Hotline'),
('contact_email', 'thaitechgtp@gmail.com', 'text', 'contact', 'Email'),
('social_facebook', 'https://facebook.com/vgentech', 'text', 'social', 'Facebook'),
('social_zalo', '0938518555', 'text', 'social', 'Zalo');

-- Categories mẫu
INSERT INTO categories (name, slug, description, is_active, sort_order) VALUES
('Máy phát điện Cummins', 'may-phat-dien-cummins', 'Các dòng máy phát điện Cummins', TRUE, 1),
('Máy phát điện Doosan', 'may-phat-dien-doosan', 'Các dòng máy phát điện Doosan', TRUE, 2),
('Máy phát điện VMAN', 'may-phat-dien-vman', 'Các dòng máy phát điện VMAN', TRUE, 3),
('Phụ kiện', 'phu-kien', 'Phụ kiện máy phát điện', TRUE, 4);
