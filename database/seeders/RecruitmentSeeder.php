<?php

namespace Database\Seeders;

use App\Models\Recruitment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RecruitmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Nhân Viên Kinh Doanh Máy Phát Điện',
                'position' => 'Nhân Viên Kinh Doanh',
                'location' => 'Hà Nội',
                'salary_range' => '8.000.000 - 15.000.000 VNĐ + Hoa hồng',
                'job_type' => 'Full-time',
                'quantity' => 3,
                'deadline' => now()->addMonths(2),
                'description' => '<p>VgenTech đang tìm kiếm Nhân viên Kinh doanh nhiệt huyết để mở rộng thị trường máy phát điện tại khu vực miền Bắc.</p>
                    <h5>Mô tả công việc:</h5>
                    <ul>
                        <li>Tư vấn, chào bán sản phẩm máy phát điện cho khách hàng</li>
                        <li>Tìm kiếm, phát triển khách hàng mới (doanh nghiệp, công trình xây dựng, nhà máy)</li>
                        <li>Lập báo giá, thương thảo hợp đồng với khách hàng</li>
                        <li>Chăm sóc và duy trì mối quan hệ với khách hàng cũ</li>
                        <li>Phối hợp với bộ phận kỹ thuật để hỗ trợ khách hàng</li>
                        <li>Báo cáo doanh số và tình hình thị trường định kỳ</li>
                    </ul>',
                'requirements' => '<ul>
                        <li>Tốt nghiệp Cao đẳng trở lên, ưu tiên chuyên ngành Kinh tế, Kỹ thuật</li>
                        <li>Có kinh nghiệm bán hàng B2B, ưu tiên trong lĩnh vực thiết bị công nghiệp</li>
                        <li>Kỹ năng giao tiếp, đàm phán và thuyết phục tốt</li>
                        <li>Có khả năng làm việc độc lập và theo nhóm</li>
                        <li>Chịu được áp lực công việc cao</li>
                        <li>Có laptop và phương tiện đi lại</li>
                        <li>Ưu tiên có kiến thức về máy phát điện, thiết bị điện</li>
                    </ul>',
                'benefits' => '<ul>
                        <li>Lương cứng + Hoa hồng hấp dẫn theo doanh số</li>
                        <li>Thưởng KPI, thưởng dự án lớn</li>
                        <li>Bảo hiểm xã hội, y tế, thất nghiệp đầy đủ</li>
                        <li>Hỗ trợ xăng xe, điện thoại</li>
                        <li>Đào tạo về sản phẩm và kỹ năng bán hàng</li>
                        <li>12 ngày phép năm, nghỉ lễ tết theo quy định</li>
                        <li>Du lịch, team building hàng năm</li>
                        <li>Cơ hội thăng tiến lên Trưởng nhóm, Quản lý kinh doanh</li>
                    </ul>',
                'is_active' => true,
            ],
            [
                'title' => 'Kỹ Thuật Viên Lắp Đặt & Bảo Trì Máy Phát Điện',
                'position' => 'Kỹ Thuật Viên',
                'location' => 'Hà Nội và các tỉnh lân cận',
                'salary_range' => '10.000.000 - 18.000.000 VNĐ',
                'job_type' => 'Full-time',
                'quantity' => 4,
                'deadline' => now()->addMonths(1),
                'description' => '<p>VgenTech cần tuyển Kỹ thuật viên có kinh nghiệm để lắp đặt, bảo trì và sửa chữa máy phát điện cho khách hàng.</p>
                    <h5>Trách nhiệm công việc:</h5>
                    <ul>
                        <li>Lắp đặt máy phát điện tại công trình, nhà máy, doanh nghiệp</li>
                        <li>Bảo trì định kỳ máy phát điện theo quy trình</li>
                        <li>Sửa chữa, khắc phục sự cố kỹ thuật</li>
                        <li>Hướng dẫn khách hàng sử dụng và vận hành máy</li>
                        <li>Kiểm tra, đánh giá tình trạng thiết bị</li>
                        <li>Lập báo cáo kỹ thuật và đề xuất giải pháp</li>
                        <li>Phối hợp với phòng kinh doanh hỗ trợ khách hàng</li>
                    </ul>',
                'requirements' => '<ul>
                        <li>Tốt nghiệp Cao đẳng/Trung cấp chuyên ngành Điện, Cơ khí, Cơ điện tử</li>
                        <li>Có kinh nghiệm 1-2 năm về lắp đặt, bảo trì thiết bị điện hoặc máy phát điện</li>
                        <li>Am hiểu về hệ thống điện, động cơ diesel, máy phát điện</li>
                        <li>Có khả năng đọc bản vẽ kỹ thuật điện</li>
                        <li>Chịu khó, cẩn thận, có trách nhiệm</li>
                        <li>Sẵn sàng đi công tác trong và ngoài tỉnh</li>
                        <li>Có bằng lái xe máy (ưu tiên có bằng lái ô tô)</li>
                    </ul>',
                'benefits' => '<ul>
                        <li>Lương cứng + Phụ cấp đi công tác</li>
                        <li>Thưởng theo hiệu quả công việc</li>
                        <li>Bảo hiểm xã hội, y tế, thất nghiệp đầy đủ</li>
                        <li>Trang bị đồng phục, dụng cụ làm việc</li>
                        <li>Đào tạo kỹ thuật chuyên sâu về máy phát điện</li>
                        <li>Hỗ trợ xăng xe, công tác phí khi đi làm việc</li>
                        <li>Cơ hội thăng tiến lên Trưởng nhóm kỹ thuật</li>
                    </ul>',
                'is_active' => true,
            ],
            [
                'title' => 'Trưởng Phòng Kinh Doanh',
                'position' => 'Trưởng Phòng Kinh Doanh',
                'location' => 'Hà Nội',
                'salary_range' => '20.000.000 - 35.000.000 VNĐ + Thưởng',
                'job_type' => 'Full-time',
                'quantity' => 1,
                'deadline' => now()->addDays(45),
                'description' => '<p>VgenTech tìm kiếm Trưởng phòng Kinh doanh có kinh nghiệm để quản lý và phát triển đội ngũ bán hàng.</p>
                    <h5>Trách nhiệm chính:</h5>
                    <ul>
                        <li>Quản lý và điều hành bộ phận kinh doanh</li>
                        <li>Xây dựng chiến lược kinh doanh, kế hoạch bán hàng</li>
                        <li>Phát triển thị trường mới, tìm kiếm khách hàng tiềm năng</li>
                        <li>Đào tạo, hướng dẫn và đánh giá nhân viên kinh doanh</li>
                        <li>Đàm phán và ký kết hợp đồng với khách hàng lớn</li>
                        <li>Phân tích thị trường, đối thủ cạnh tranh</li>
                        <li>Báo cáo doanh thu và đề xuất giải pháp tăng trưởng</li>
                    </ul>',
                'requirements' => '<ul>
                        <li>Tốt nghiệp Đại học chuyên ngành Kinh tế, Quản trị kinh doanh</li>
                        <li>Có ít nhất 3 năm kinh nghiệm quản lý kinh doanh</li>
                        <li>Ưu tiên có kinh nghiệm trong lĩnh vực thiết bị công nghiệp, máy móc</li>
                        <li>Kỹ năng lãnh đạo, quản lý đội nhóm xuất sắc</li>
                        <li>Khả năng phân tích, hoạch định chiến lược tốt</li>
                        <li>Kỹ năng đàm phán, thuyết phục cao</li>
                        <li>Có mạng lưới khách hàng rộng là một lợi thế</li>
                    </ul>',
                'benefits' => '<ul>
                        <li>Mức lương hấp dẫn + Thưởng theo doanh số công ty</li>
                        <li>Thưởng KPI, thưởng cuối năm</li>
                        <li>Bảo hiểm cao cấp cho bản thân và gia đình</li>
                        <li>Xe công ty hoặc hỗ trợ xăng xe</li>
                        <li>Được tham gia các khóa đào tạo nâng cao</li>
                        <li>Cơ hội thăng tiến lên Giám đốc kinh doanh</li>
                    </ul>',
                'is_active' => true,
            ],
            [
                'title' => 'Nhân Viên Kho Vận',
                'position' => 'Nhân Viên Kho',
                'location' => 'Hà Nội',
                'salary_range' => '7.000.000 - 10.000.000 VNĐ',
                'job_type' => 'Full-time',
                'quantity' => 2,
                'deadline' => now()->addDays(30),
                'description' => '<p>VgenTech cần tuyển Nhân viên kho vận để quản lý hàng hóa và thiết bị máy phát điện.</p>
                    <h5>Nhiệm vụ chính:</h5>
                    <ul>
                        <li>Nhập xuất hàng hóa, máy móc thiết bị</li>
                        <li>Kiểm tra chất lượng, số lượng hàng hóa khi nhận</li>
                        <li>Sắp xếp, bảo quản hàng hóa trong kho</li>
                        <li>Lập phiếu xuất nhập kho</li>
                        <li>Kiểm kê hàng tồn kho định kỳ</li>
                        <li>Phối hợp với bộ phận giao hàng</li>
                        <li>Báo cáo tình trạng hàng tồn kho</li>
                    </ul>',
                'requirements' => '<ul>
                        <li>Tốt nghiệp THPT trở lên</li>
                        <li>Có kinh nghiệm làm việc trong kho là một lợi thế</li>
                        <li>Biết sử dụng xe nâng là một lợi thế</li>
                        <li>Khỏe mạnh, chịu khó, có trách nhiệm</li>
                        <li>Cẩn thận, tỉ mỉ trong công việc</li>
                        <li>Biết sử dụng máy tính cơ bản (Word, Excel)</li>
                    </ul>',
                'benefits' => '<ul>
                        <li>Lương tháng 13, thưởng lễ tết</li>
                        <li>Bảo hiểm xã hội, y tế đầy đủ</li>
                        <li>Làm việc trong môi trường an toàn</li>
                        <li>Trang bị đồng phục, bảo hộ lao động</li>
                        <li>Nghỉ lễ, phép năm theo quy định</li>
                    </ul>',
                'is_active' => true,
            ],
            [
                'title' => 'Nhân Viên Chăm Sóc Khách Hàng',
                'position' => 'Chăm Sóc Khách Hàng',
                'location' => 'Hà Nội',
                'salary_range' => '7.000.000 - 12.000.000 VNĐ',
                'job_type' => 'Full-time',
                'quantity' => 2,
                'deadline' => now()->addMonths(2),
                'description' => '<p>VgenTech tìm kiếm Nhân viên chăm sóc khách hàng để hỗ trợ và tư vấn cho khách hàng về sản phẩm máy phát điện.</p>
                    <h5>Công việc chính:</h5>
                    <ul>
                        <li>Tiếp nhận và xử lý yêu cầu từ khách hàng qua điện thoại, email</li>
                        <li>Tư vấn sản phẩm máy phát điện cho khách hàng</li>
                        <li>Giải đáp thắc mắc về sản phẩm, dịch vụ</li>
                        <li>Theo dõi và chăm sóc khách hàng sau bán hàng</li>
                        <li>Lập lịch bảo trì cho khách hàng</li>
                        <li>Ghi nhận ý kiến phản hồi từ khách hàng</li>
                        <li>Phối hợp với các bộ phận để giải quyết vấn đề</li>
                    </ul>',
                'requirements' => '<ul>
                        <li>Tốt nghiệp Cao đẳng trở lên</li>
                        <li>Có kinh nghiệm chăm sóc khách hàng là một lợi thế</li>
                        <li>Kỹ năng giao tiếp tốt, giọng nói dễ nghe</li>
                        <li>Kiên nhẫn, nhiệt tình, thân thiện</li>
                        <li>Khả năng làm việc dưới áp lực</li>
                        <li>Sử dụng thành thạo máy tính văn phòng</li>
                        <li>Có kiến thức về thiết bị điện là một lợi thế</li>
                    </ul>',
                'benefits' => '<ul>
                        <li>Lương cứng + Thưởng KPI</li>
                        <li>Bảo hiểm đầy đủ theo quy định</li>
                        <li>Đào tạo về sản phẩm và kỹ năng</li>
                        <li>Môi trường làm việc chuyên nghiệp</li>
                        <li>12 ngày phép năm</li>
                        <li>Cơ hội thăng tiến lên Trưởng nhóm CSKH</li>
                    </ul>',
                'is_active' => true,
            ],
            [
                'title' => 'Nhân Viên Kế Toán',
                'position' => 'Kế Toán',
                'location' => 'Hà Nội',
                'salary_range' => '8.000.000 - 13.000.000 VNĐ',
                'job_type' => 'Full-time',
                'quantity' => 1,
                'deadline' => now()->addDays(40),
                'description' => '<p>VgenTech cần tuyển Nhân viên kế toán để quản lý tài chính và kế toán của công ty.</p>
                    <h5>Trách nhiệm công việc:</h5>
                    <ul>
                        <li>Theo dõi công nợ phải thu, phải trả</li>
                        <li>Lập chứng từ kế toán, hóa đơn GTGT</li>
                        <li>Kiểm tra và đối chiếu công nợ với khách hàng, nhà cung cấp</li>
                        <li>Lập báo cáo tài chính định kỳ</li>
                        <li>Quản lý quỹ tiền mặt, chuyển khoản</li>
                        <li>Kê khai thuế, làm việc với cơ quan thuế</li>
                        <li>Lưu trữ hồ sơ chứng từ kế toán</li>
                    </ul>',
                'requirements' => '<ul>
                        <li>Tốt nghiệp Cao đẳng/Đại học chuyên ngành Kế toán, Tài chính</li>
                        <li>Có ít nhất 1 năm kinh nghiệm kế toán</li>
                        <li>Am hiểu luật thuế, chế độ kế toán Việt Nam</li>
                        <li>Sử dụng thành thạo Excel, phần mềm kế toán</li>
                        <li>Tỉ mỉ, cẩn thận, trung thực</li>
                        <li>Có khả năng làm việc độc lập</li>
                    </ul>',
                'benefits' => '<ul>
                        <li>Lương tháng 13, thưởng cuối năm</li>
                        <li>Bảo hiểm xã hội, y tế đầy đủ</li>
                        <li>Nghỉ lễ, tết, phép năm theo quy định</li>
                        <li>Môi trường làm việc ổn định</li>
                        <li>Được đào tạo và nâng cao nghiệp vụ</li>
                    </ul>',
                'is_active' => true,
            ],
            [
                'title' => 'Nhân Viên Lái Xe Giao Hàng',
                'position' => 'Lái Xe',
                'location' => 'Hà Nội',
                'salary_range' => '8.000.000 - 12.000.000 VNĐ',
                'job_type' => 'Full-time',
                'quantity' => 2,
                'deadline' => now()->addDays(35),
                'description' => '<p>VgenTech cần tuyển Lái xe có kinh nghiệm để vận chuyển máy phát điện và thiết bị cho khách hàng.</p>
                    <h5>Công việc chính:</h5>
                    <ul>
                        <li>Lái xe ô tô tải vận chuyển hàng hóa</li>
                        <li>Giao máy phát điện và thiết bị cho khách hàng</li>
                        <li>Hỗ trợ bốc xếp hàng hóa</li>
                        <li>Kiểm tra và bảo dưỡng xe định kỳ</li>
                        <li>Đảm bảo an toàn hàng hóa trong quá trình vận chuyển</li>
                        <li>Lập báo cáo giao hàng hàng ngày</li>
                    </ul>',
                'requirements' => '<ul>
                        <li>Có bằng lái xe B2, C (ưu tiên có C)</li>
                        <li>Có kinh nghiệm lái xe tải 1-2 năm</li>
                        <li>Am hiểu đường sá khu vực Hà Nội và lân cận</li>
                        <li>Khỏe mạnh, chịu khó, trung thực</li>
                        <li>Có tinh thần trách nhiệm cao</li>
                        <li>Chấp hành luật giao thông tốt</li>
                    </ul>',
                'benefits' => '<ul>
                        <li>Lương cứng + Phụ cấp xăng xe, điện thoại</li>
                        <li>Bảo hiểm xã hội, y tế đầy đủ</li>
                        <li>Được trang bị xe công ty</li>
                        <li>Hỗ trợ ăn trưa</li>
                        <li>Nghỉ 1 ngày/tuần, nghỉ lễ tết theo quy định</li>
                    </ul>',
                'is_active' => true,
            ],
            [
                'title' => 'Nhân Viên Marketing Online',
                'position' => 'Marketing',
                'location' => 'Hà Nội',
                'salary_range' => '8.000.000 - 15.000.000 VNĐ',
                'job_type' => 'Full-time',
                'quantity' => 1,
                'deadline' => now()->addDays(25),
                'description' => '<p>VgenTech tìm kiếm Nhân viên Marketing Online để quảng bá sản phẩm máy phát điện trên các nền tảng số.</p>
                    <h5>Nhiệm vụ công việc:</h5>
                    <ul>
                        <li>Xây dựng và triển khai chiến lược marketing online</li>
                        <li>Quản lý fanpage, website, kênh social media</li>
                        <li>Viết content, đăng bài giới thiệu sản phẩm</li>
                        <li>Chạy quảng cáo Facebook, Google Ads</li>
                        <li>Tương tác và chăm sóc khách hàng trên online</li>
                        <li>Phân tích hiệu quả các chiến dịch marketing</li>
                        <li>SEO website, tối ưu từ khóa</li>
                    </ul>',
                'requirements' => '<ul>
                        <li>Tốt nghiệp Cao đẳng/Đại học chuyên ngành Marketing, Truyền thông</li>
                        <li>Có kinh nghiệm 6 tháng - 1 năm về Marketing Online</li>
                        <li>Kỹ năng viết content tốt, sáng tạo</li>
                        <li>Biết chạy quảng cáo Facebook Ads, Google Ads</li>
                        <li>Am hiểu về SEO, Social Media</li>
                        <li>Sử dụng thành thạo Photoshop, Canva</li>
                        <li>Có kiến thức về thiết bị công nghiệp là một lợi thế</li>
                    </ul>',
                'benefits' => '<ul>
                        <li>Lương cứng + Thưởng KPI hàng tháng</li>
                        <li>Bảo hiểm xã hội, y tế đầy đủ</li>
                        <li>Môi trường làm việc sáng tạo, năng động</li>
                        <li>Đào tạo kỹ năng marketing chuyên sâu</li>
                        <li>Cơ hội thăng tiến lên Trưởng phòng Marketing</li>
                    </ul>',
                'is_active' => true,
            ],
        ];

        foreach ($jobs as $job) {
            $job['slug'] = Str::slug($job['title']) . '-' . rand(1000, 9999);
            Recruitment::create($job);
        }
    }
}
