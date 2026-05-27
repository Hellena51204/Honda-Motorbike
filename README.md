# 🏍️ Honda Motorbike E-commerce & Management System

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Bootstrap 5](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)

> Hệ thống website thương mại điện tử và quản lý kho hàng dành cho đại lý xe máy Honda. Dự án Bài tập lớn học phần Lập trình Web với Framework (Laravel).
---
Website Quản lý Showroom Xe Máy Honda là mã nguồn dự án thuộc học phần **Chuyên đề tốt nghiệp 1**. Mục tiêu của dự án là xây dựng một nền tảng thương mại điện tử thực tế bằng framework Laravel, chuyên biệt cho mảng kinh doanh, dịch vụ hậu mãi và quản lý kho bãi của một showroom xe máy (mô phỏng chuỗi đại lý HEAD Honda).

Ứng dụng được thiết kế tối ưu Responsive trên nền tảng Web, tương thích hoàn hảo và đồng nhất từ môi trường máy tính cá nhân (PC/Desktop) cho đến các thiết bị di động (Mobile/Tablet).

## 👥 Nhóm phát triển

* **Nguyễn Văn Quân** - 20224113 (Nhóm trưởng)
* **Bùi Bảo Khang** - 20224346
* **Trần Anh Trung** - 20224343

---

## ✨ Danh sách toàn bộ tính năng của hệ thống

Hệ thống được phát triển hoàn thiện với quy mô lớn, tích hợp đầy đủ các luồng nghiệp vụ thực tế, bóc tách thành 2 phân hệ độc lập qua hệ thống Middleware: Khách hàng (User Web App) và Quản trị viên (Admin Panel Dashboard).

### 👤 1. Phân hệ Khách hàng (User Web App)

#### 1.1. Xác thực và Quản lý tài khoản (Authentication & Profile)
* **Đăng nhập & Đăng ký:** Xác thực tài khoản thành viên an toàn thông qua cơ chế session nội bộ của Laravel Authentication, áp dụng bộ lọc mã hóa mật khẩu một chiều Bcrypt.
* **Khôi phục mật khẩu:** Tính năng quên mật khẩu kết nối trực tiếp với dịch vụ Mail SMTP của Google để gửi mã xác nhận/link đặt lại mật khẩu về hộp thư Email thực của khách hàng.
* **Quản lý hồ sơ (Profile):** Cho phép thành viên tự cập nhật thông tin cá nhân bao gồm họ tên, số điện thoại, địa chỉ nhận xe.
* **Hệ thống phân hạng & Tích điểm (Membership):** Tự động lưu vết và cộng dồn điểm thưởng (`membership_points`) dựa trên giá trị hóa đơn khi đơn hàng hoàn tất. Tự động thăng hạng (Bạc, Vàng, Kim Cương) để áp dụng chính sách chiết khấu riêng cho thành viên.

#### 1.2. Giao diện Trang chủ & Điều hướng (Home & Layout Components)
* **Banner Quảng cáo (Hero Section):** Hiển thị các chiến dịch marketing nổi bật của Honda Việt Nam với hiệu ứng trượt mượt mà.
* **Điều hướng thông minh:** Sử dụng hệ thống Blade Layouts để xây dựng Header và Footer động, tự động co giãn và thu gọn thành menu Dropdown/Drawer khi truy cập trên thiết bị di động.
* **Khu vực tương tác nhanh:** Tích hợp nút bong bóng Chatbox nổi (Floating Button) kết nối trực tiếp với bộ phận chăm sóc khách hàng trực tuyến thông qua Pusher API.

#### 1.3. Khám phá & Chi tiết Xe máy (Product Catalog)
* **Danh mục sản phẩm:** Phân loại xe máy theo các phân khúc đặc trưng của Honda: Xe tay ga (Scooter), Xe số (Cub), Xe thể thao/Côn tay (Sport).
* **Bộ lọc và Tìm kiếm:** Thanh tìm kiếm thông minh kết hợp bộ lọc danh mục chạy bằng Ajax, hỗ trợ tìm kiếm theo tên dòng xe (SH, Vision, Winner...) hoặc phân loại mà không cần tải lại toàn bộ trang.
* **Trang chi tiết (Product Detail):** Trình bày trực quan thông số kỹ thuật chuyên sâu (Dung tích xilanh, công suất tối đa, mức tiêu hao nhiên liệu, dung tích bình xăng) cùng giá bán lẻ niêm yết công khai.

#### 1.4. Đánh giá & Tương tác (Rating & Review System)
* **Chấm điểm (Rating):** Khách hàng có thể để lại số điểm từ 1 đến 5 sao cho mẫu xe máy đã sở hữu.
* **Bình luận (Review):** Cho phép viết cảm nhận chi tiết. Hệ thống áp dụng chính sách bảo vệ thực tế: chỉ những tài khoản có lịch sử mua dòng xe tương ứng mới có quyền kích hoạt form bình luận nhằm chống tình trạng spam/seeding sản phẩm.

#### 1.5. Giỏ hàng & Thanh toán điện tử (Shopping Cart & Digital Payments)
* **Quản lý giỏ hàng:** Lưu trữ thông tin xe, màu sắc và phiên bản cần mua. Sử dụng Session kết hợp DB để đồng bộ giỏ hàng của thành viên.
* **Mã giảm giá (Coupon/Voucher):** Cho phép khách hàng nhập các mã khuyến mãi khả dụng để giảm trừ trực tiếp số tiền cần thanh toán trên hóa đơn.
* **Phương thức thanh toán linh hoạt:**
  * Thanh toán tiền mặt / Chuyển khoản trực tiếp khi nhận xe tại Showroom (COD/Nhận tại cửa hàng).
  * **Thanh toán qua cổng MoMo:** Tích hợp trực tiếp cổng API MoMo Sandbox. Khởi tạo giao dịch qua mã QR trực tuyến, bảo bọc tính toàn vẹn dữ liệu thông qua chữ ký số mã hóa HMAC-SHA256, tiếp nhận tín hiệu Callback/IPN từ MoMo gửi về để gạch nợ đơn hàng tự động.

#### 1.6. Dịch vụ Khách hàng & Dashboard cá nhân
* **Đặt lịch lái thử (Test Drive):** Biểu mẫu trực tuyến cho phép chọn dòng xe mong muốn, ngày giờ hẹn và thông tin liên lạc để HEAD sắp xếp nhân viên hỗ trợ.
* **Theo dõi đơn hàng (Order History):** Giao diện riêng giúp khách hàng theo dõi trực quan trạng thái vòng đời của hóa đơn: *Mới tạo $\rightarrow$ Chờ thanh toán $\rightarrow$ Đã thanh toán $\rightarrow$ Đang giao xe $\rightarrow$ Hoàn thành $\rightarrow$ Hủy đơn*.

---

### 👑 2. Phân hệ Quản trị (Admin Dashboard)

#### 2.1. Phân quyền và Bảo mật (Role-based Middleware)
* Hệ thống bảo mật tầng định tuyến sử dụng Laravel Middleware để cô lập phân hệ quản trị. Chỉ những tài khoản có trường `role = 'admin'` mới được phép truy cập vào các URL thuộc `/admin/*`, ngăn chặn triệt để các hành vi tấn công leo thang đặc quyền.

#### 2.2. Bảng Điều Khiển Tổng Quan (Analytics Dashboard)
* Thống kê trực quan các chỉ số tài chính và vận hành của showroom theo thời gian thực: *Tổng doanh thu toàn hệ thống, Tổng số đơn hàng được khởi tạo, Quy mô khách hàng thành viên, Biểu đồ tỷ lệ danh mục xe máy đang kinh doanh*.

#### 2.3. Quản lý Danh mục Xe máy (Product CRUD)
* Nghiệp vụ cốt lõi: Thêm dòng xe mới, cập nhật giá bán, số lượng tồn kho, cấu hình mô tả và thông số kỹ thuật, ẩn/hiện hoặc xóa sản phẩm khỏi website công khai.
* Quản lý hình ảnh: Hỗ trợ upload ảnh đại diện và bộ sưu tập ảnh đa góc độ của xe máy lên máy chủ lưu trữ.

#### 2.4. Điều phối Đơn hàng & Đồng bộ kho bãi (Order Processing)
* Quản lý tập trung toàn bộ hóa đơn của hệ thống showroom. Admin có quyền duyệt xuất kho và chuyển trạng thái đơn hàng sang "Đang giao xe" hoặc "Hủy đơn".
* **Trigger khấu trừ tự động:** Khi một đơn hàng chuyển dịch trạng thái thành công, hệ thống tự động trừ số lượng xe máy tương ứng trong trường `stock` của cơ sở dữ liệu để đảm bảo số liệu realtime.

#### 2.5. Xử lý biểu mẫu và Chăm sóc khách hàng
* **Quản lý Liên hệ (Contacts):** Tiếp nhận, phân loại và xử lý các thư phản hồi, thắc mắc từ mục Liên hệ của khách hàng gửi về.
* **Quản lý Lịch lái thử:** Duyệt hoặc hủy các yêu cầu đăng ký trải nghiệm xe máy ngoài thực tế của khách hàng.

---

## 💻 Kiến trúc & Công nghệ nền tảng

* **Core Framework:** PHP Framework Laravel (Mô hình kiến trúc Model - View - Controller).
* **Database Server:** MySQL Relational Database (Hệ quản trị cơ sở dữ liệu quan hệ).
* **ORM:** Laravel Eloquent ORM (Thao tác cơ sở dữ liệu qua các thực thể Object hướng đối tượng).
* **Frontend Technologies:** HTML5, CSS3, JavaScript, Bootstrap/Tailwind CSS kết hợp Blade Template Engine.
* **Realtime Hub:** Tích hợp Pusher API hỗ trợ truyền tải dữ liệu thời gian thực (hộp thoại chatbox hỗ trợ kỹ thuật).
* **Third-party APIs:** Cổng thanh toán điện tử MoMo (Môi trường test nghiệp vụ).
* **Security Environment:** Sử dụng file cấu hình `.env` để cô lập toàn bộ thông tin nhạy cảm (Database Password, MoMo Secret Keys, Pusher API Keys) khỏi mã nguồn công khai.

---

## 🚀 Hướng dẫn Thiết lập & Chạy dự án cục bộ

Vui lòng thực hiện tuần tự các bước sau để cấu hình và vận hành website trên môi trường Localhost máy tính cá nhân:

### 1. Tải mã nguồn về máy
```bash
git clone [https://github.com/Hellena51204/Honda-Motorbike.git](https://github.com/Hellena51204/Honda-Motorbike.git)
cd Honda-Motorbike
