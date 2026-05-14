# Báo Cáo Cấu Trúc Dữ Liệu: Trang Quản Trị (Admin Dashboard)

Báo cáo này phân tích chi tiết nguồn gốc của các dữ liệu hiện đang được hiển thị trên trang Quản trị (Admin Dashboard) của dự án Honda Motorbike. Hệ thống hiện tại là sự kết hợp giữa **Dữ liệu thực tế (Real Data)** từ Database và **Dữ liệu mô phỏng (Mock Data)** nhằm phục vụ mục đích thiết kế giao diện (UI).

---

## 1. Dữ liệu Thực tế (Lấy từ Cơ sở dữ liệu)

Các chỉ số cốt lõi yếu quản lý kinh doanh đã được liên kết trực tiếp với cơ sở dữ liệu MySQL của dự án. Bất kỳ thay đổi nào từ phía người dùng đều sẽ cập nhật ngay lập tức lên các con số này.

| Chỉ số / Bảng | Mô tả logic truy xuất | Truy vấn Eloquent ORM (Laravel) |
| :--- | :--- | :--- |
| **Tổng doanh thu**<br>*(Total Revenue)* | Tổng cộng cột `total_amount` của tất cả đơn hàng đã thanh toán thành công. | `Order::where('payment_status', 'completed')->sum('total_amount')` |
| **Số xe đã bán**<br>*(Units Sold)* | Tổng số lượng đơn hàng đã được tạo trên hệ thống. | `Order::count()` |
| **Khách hàng mới**<br>*(New Customers)* | Tổng số lượng tài khoản người dùng đăng ký (ngoại trừ tài khoản của ban quản trị). | `User::where('role', '!=', 'admin')->count()` |
| **Đơn chờ xử lý**<br>*(Pending Orders)* | Đếm số lượng các đơn hàng đang ở trạng thái chờ thanh toán/chờ xác nhận. | `Order::where('payment_status', 'pending')->count()` |
| **Đơn hàng gần đây**<br>*(Recent Orders)* | Danh sách 5 đơn đặt hàng mới nhất, bao gồm thông tin khách hàng và sản phẩm đặt mua. | `Order::with(['user', 'items'])->orderBy('created_at', 'desc')->take(5)->get()` |

---

## 2. Dữ liệu Mô phỏng (Giao diện mẫu)

Để giao diện hiển thị đẹp mắt và bám sát thiết kế (mockup) được yêu cầu, một số thành phần giao diện hiện đang sử dụng dữ liệu tĩnh (hardcoded) hoặc được sinh ra ngẫu nhiên bằng thuật toán.

> [!NOTE]
> Việc sử dụng dữ liệu mô phỏng là bước tiêu chuẩn trong quá trình thiết kế UI/UX khi cấu trúc Database chưa hỗ trợ đầy đủ các trường dữ liệu cần thiết.

### A. Chỉ số Tăng trưởng (Percentages)
*   **Hiển thị:** Các con số như `+12.5%`, `+8.2%`, `-5.1%`.
*   **Thực trạng:** Là các chuỗi văn bản (text) được gõ cứng vào mã nguồn HTML.
*   **Giải pháp thực tế:** Cần lưu trữ lịch sử dữ liệu theo ngày/tháng để viết thuật toán so sánh (Ví dụ: So sánh tổng doanh thu tháng này với tháng trước).

### B. Biểu đồ Đường (Sparkline Charts)
*   **Hiển thị:** Các đường gợn sóng màu xanh/đỏ dưới mỗi thẻ thống kê.
*   **Thực trạng:** Là các hình vẽ đồ họa vector tĩnh (Static SVG Paths).
*   **Giải pháp thực tế:** Tích hợp thư viện Javascript như **Chart.js** hoặc **ApexCharts**, cung cấp chuỗi dữ liệu (array) doanh thu theo 7 ngày gần nhất để thư viện tự động vẽ biểu đồ.

### C. Quản lý Kho sản phẩm (Stock & Sold)
*   **Hiển thị:** Cột "Tồn kho" (Ví dụ: 32 chiếc) và cột "Đã bán" (Ví dụ: 45 chiếc) tại trang Quản lý Sản phẩm.
*   **Thực trạng:** Bảng `products` trong CSDL hiện tại **chưa có** hai cột `stock` và `sold`. Hệ thống đang dùng thuật toán nội suy ngẫu nhiên dựa trên `id` của sản phẩm để sinh ra con số giả lập cho đẹp mắt.
*   **Mã nguồn giả lập:**
    ```php
    // Công thức tính toán giả lập để hiển thị giao diện
    $stock = ($product->id * 7) % 50 + 2; 
    $sold = ($product->id * 11) % 100 + 10;
    ```

---

## 3. Đề xuất Kế hoạch Nâng cấp (Next Steps)

Để biến Admin Dashboard thành một công cụ quản lý toàn diện với 100% dữ liệu thực, dự án cần thực hiện các bước nâng cấp sau:

1.  **Cập nhật Database (Migration):**
    *   Tạo file migration mới để bổ sung cột `stock` (integer) và `sold` (integer, default 0) vào bảng `products`.
    *   Cập nhật các Logic thanh toán để tự động giảm số lượng `stock` và tăng số lượng `sold` mỗi khi đơn hàng được tạo thành công.
2.  **Xây dựng Logic Thống kê Nâng cao:**
    *   Tạo ra các hàm tính toán sự thay đổi doanh thu (Growth Rate) so với kỳ trước trong `DashboardController`.
3.  **Tích hợp Biểu đồ Động:**
    *   Truyền dữ liệu doanh thu của 7 ngày gần nhất dưới dạng JSON từ Controller ra View.
    *   Sử dụng thư viện vẽ biểu đồ để render các đường gợn sóng chính xác với dữ liệu kinh doanh.
