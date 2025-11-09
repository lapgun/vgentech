<?php

// Script để tự động cập nhật translation cho các views
// Chạy: php update_translations.php

$replacements = [
    // Common phrases
    'Trang chủ' => "{{ __('common.home') }}",
    'Giới thiệu' => "{{ __('common.about') }}",
    'Sản phẩm' => "{{ __('common.products') }}",
    'Dự án' => "{{ __('common.projects') }}",
    'Tin tức' => "{{ __('common.blog') }}",
    'Tuyển dụng' => "{{ __('common.recruitment') }}",
    'Liên hệ' => "{{ __('common.contact') }}",
    
    // Actions
    'Xem chi tiết' => "{{ __('common.view_details') }}",
    'Xem tất cả' => "{{ __('common.view_all') }}",
    'Đọc tiếp' => "{{ __('common.read_more') }}",
    'Tìm kiếm' => "{{ __('common.search') }}",
    'Gửi tin nhắn' => "{{ __('common.send_message') }}",
    'Ứng tuyển ngay' => "{{ __('common.apply_now') }}",
    
    // Product related
    'Tất cả sản phẩm' => "{{ __('common.all_products') }}",
    'Danh mục' => "{{ __('common.categories') }}",
    'Liên hệ để biết giá' => "{{ __('common.contact_for_price') }}",
    'Sản phẩm liên quan' => "{{ __('common.related_products') }}",
    'Không tìm thấy sản phẩm nào phù hợp' => "{{ __('common.no_results_found') }}",
    
    // Project related
    'Tất cả dự án' => "{{ __('common.all_projects') }}",
    'Dự án liên quan' => "{{ __('common.related_projects') }}",
    'Không tìm thấy dự án nào phù hợp' => "{{ __('common.no_results_found') }}",
    'Mô tả dự án' => "{{ __('common.project_description') }}",
    'Chi tiết dự án' => "{{ __('common.project_info') }}",
    
    // Contact
    'Liên hệ nhanh' => "{{ __('common.quick_contact') }}",
    'Liên hệ trực tiếp' => "{{ __('common.contact_directly') }}",
    'Thông tin liên hệ' => "{{ __('common.contact_info') }}",
];

$viewsPath = __DIR__ . '/resources/views';

function updateFile($filePath, $replacements) {
    if (!file_exists($filePath)) {
        echo "File not found: $filePath\n";
        return;
    }
    
    $content = file_get_contents($filePath);
    $originalContent = $content;
    
    foreach ($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    if ($content !== $originalContent) {
        file_put_contents($filePath, $content);
        echo "Updated: $filePath\n";
    }
}

echo "Starting translation update...\n\n";

// List all view files to update
$files = [
    'products/show.blade.php',
    'projects/index.blade.php',
    'projects/show.blade.php',
    'blog/index.blade.php',
    'blog/show.blade.php',
    'recruitment/index.blade.php',
    'recruitment/show.blade.php',
];

foreach ($files as $file) {
    $fullPath = $viewsPath . '/' . $file;
    updateFile($fullPath, $replacements);
}

echo "\nDone!\n";
