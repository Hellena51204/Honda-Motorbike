# Kiến trúc và Vai trò các file quan trọng trong dự án Honda Motorbike

Dự án Honda Motorbike được xây dựng trên framework Laravel (PHP), tuân theo mô hình **MVC (Model - View - Controller)**. Dưới đây là thống kê và giải thích vai trò của các file và thư mục quan trọng nhất trong mã nguồn.

## 1. Định tuyến (Routing)
*   **`routes/web.php`**
    *   **Vai trò:** Đây là nơi đăng ký toàn bộ các đường dẫn (URL/Route) của ứng dụng web. Bất kỳ trang nào hiển thị trên trình duyệt đều phải được khai báo ở đây.
    *   **Chức năng chính:** Điều hướng các request từ người dùng đến các Controller tương ứng (VD: `/products` trỏ tới `ProductController@index`). Nó cũng sử dụng Middleware để bảo vệ các trang yêu cầu đăng nhập hoặc quyền Admin.

## 2. Models (Xử lý dữ liệu)
Models đóng vai trò giao tiếp trực tiếp với cơ sở dữ liệu (Database). Mỗi Model đại diện cho một bảng trong CSDL.
*   **`app/Models/User.php`**
    *   **Vai trò:** Quản lý thông tin người dùng (Khách hàng và Admin).
    *   **Chức năng chính:** Xử lý xác thực đăng nhập, lưu trữ thông tin cá nhân (Tên, Email, SĐT, Điểm thành viên) và định nghĩa mối quan hệ với các bảng khác (VD: 1 User có nhiều Orders - Đơn hàng).
*   **`app/Models/Product.php`**
    *   **Vai trò:** Quản lý thông tin sản phẩm (Xe máy).
    *   **Chức năng chính:** Lấy dữ liệu sản phẩm, định nghĩa các cột cho phép thêm/sửa (`$fillable`), và tự động chuyển đổi dữ liệu (VD: JSON màu sắc sang mảng PHP).
*   **`app/Models/Order.php`** & **`OrderItem.php`**
    *   **Vai trò:** Quản lý thông tin Đơn hàng và Chi tiết đơn hàng.

## 3. Controllers (Điều khiển luồng logic)
Controllers nhận request từ Routes, gọi Model để lấy dữ liệu, xử lý logic nghiệp vụ và trả về View (giao diện).
*   **`app/Http/Controllers/ProductController.php`**
    *   **Vai trò:** Xử lý hiển thị danh sách sản phẩm và chi tiết sản phẩm cho khách hàng xem.
*   **`app/Http/Controllers/CartController.php`**
    *   **Vai trò:** Quản lý Giỏ hàng của người dùng.
    *   **Chức năng chính:** Thêm, xóa, tính tổng tiền. Dữ liệu giỏ hàng thường được lưu tạm thời trong Session.
*   **`app/Http/Controllers/OrderController.php`**
    *   **Vai trò:** Quản lý lịch sử đặt hàng.
    *   **Chức năng chính:** Lấy danh sách đơn hàng của một người dùng cụ thể hoặc hiển thị toàn bộ đơn hàng nếu là Admin.
*   **`app/Http/Controllers/DashboardController.php`**
    *   **Vai trò:** Xử lý giao diện Bảng điều khiển (Dashboard).
    *   **Chức năng chính:** Phân quyền hiển thị (Admin thì thấy thống kê doanh thu, khách hàng thì thấy thông tin cá nhân) và xử lý cập nhật hồ sơ, ảnh đại diện.

## 4. Views (Giao diện hiển thị)
Views chứa mã HTML/CSS (thường dùng Blade template) để hiển thị dữ liệu ra màn hình.
*   **`resources/views/layouts/`**
    *   Chứa các file giao diện gốc (khung sườn) như Header, Footer, Sidebar. Các trang khác sẽ kế thừa từ đây (VD: `app.blade.php` cho khách hàng, `admin.blade.php` cho Admin).
*   **`resources/views/dashboard/`**, **`resources/views/admin/`**
    *   Chứa các file giao diện cụ thể theo từng tính năng (VD: `dashboard.user.blade.php` hiển thị hồ sơ cá nhân).

## 5. Cấu hình (Configuration)
*   **`.env`**
    *   **Vai trò:** File cấu hình môi trường cực kỳ quan trọng.
    *   **Chức năng chính:** Lưu trữ thông tin nhạy cảm như kết nối Database (tên DB, mật khẩu), thông tin gửi Email, API key thanh toán (Momo).

> [!NOTE]
> Mô hình MVC giúp dự án tách biệt rõ ràng giữa **Dữ liệu (Model)**, **Giao diện (View)** và **Logic xử lý (Controller)**, giúp code dễ đọc, dễ bảo trì và mở rộng trong tương lai.
