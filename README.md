# 🏍️ Honda Motorbike E-commerce & Management System

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Bootstrap 5](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)

> Hệ thống website thương mại điện tử và quản lý kho hàng dành cho đại lý xe máy Honda. Dự án Bài tập lớn học phần Lập trình Web với Framework (Laravel).

---

## 📖 Giới thiệu dự án (About The Project)

**Honda Motorbike E-commerce** là một giải pháp web toàn diện được xây dựng nhằm số hóa quy trình kinh doanh của cửa hàng bán xe máy. Hệ thống được chia làm hai phân hệ chính:
1. **Frontend (Storefront):** Giao diện trực quan, hiện đại giúp khách hàng dễ dàng tìm kiếm, xem chi tiết thông số kỹ thuật các dòng xe (Vision, SH, Air Blade...) và gửi yêu cầu đăng ký mua/lái thử.
2. **Backend (Admin CMS):** Bảng điều khiển mạnh mẽ dành cho quản trị viên để theo dõi doanh thu, quản lý danh mục sản phẩm (CRUD) và xử lý các đơn đặt hàng.

Hệ thống tuân thủ chặt chẽ kiến trúc **MVC**, tích hợp xử lý bảo mật Form Request và tối ưu hóa truy vấn Database.

---

## ✨ Chức năng nổi bật (Key Features)

### 🛒 Dành cho Khách hàng (User Features)
* **Trang chủ (Home):** Banner nổi bật, hiển thị danh sách các mẫu xe bán chạy và các chương trình ưu đãi.
* **Danh mục Sản phẩm (Products):** Tìm kiếm và lọc xe theo các danh mục (Scooter, Premium Scooter, Sport).
* **Chi tiết Sản phẩm:** Xem thông số kỹ thuật chi tiết (Specs), hình ảnh sắc nét và tùy chọn màu sắc.
* **Liên hệ (Contact):** Gửi Form liên hệ nhận tư vấn với hệ thống kiểm duyệt dữ liệu an toàn.

### ⚙️ Dành cho Quản trị viên (Admin Features)
* **Dashboard Thống kê:** Theo dõi biến động doanh thu, tổng số đơn hàng và lượng khách hàng theo thời gian thực.
* **Quản lý Xe máy (Motorcycle Management):** * Thực hiện các thao tác Thêm, Xem, Sửa, Xóa (CRUD).
  * Tích hợp **Soft Deletes (Xóa mềm)**: Bảo vệ dữ liệu kho hàng, hỗ trợ khôi phục xe đã xóa từ Thùng rác.
* **Quản lý Đơn hàng (Order Management):** Theo dõi và thay đổi trạng thái xử lý của từng đơn hàng (Pending, Processing, Completed).
* **Tối ưu hóa (Optimization):** Sử dụng kỹ thuật *Eager Loading* để giải quyết triệt để lỗi N+1 Query khi tải danh sách dữ liệu lớn.

---

## 🛠 Cài đặt & Vận hành (Installation)

Vui lòng làm theo các bước dưới đây để khởi chạy dự án trên môi trường Local (XAMPP/Laragon):

**1. Clone kho lưu trữ về máy**
```bash
git clone [https://github.com/emperor-of-void/laravel-cms-project.git](https://github.com/emperor-of-void/laravel-cms-project.git)
cd honda-motorbike
