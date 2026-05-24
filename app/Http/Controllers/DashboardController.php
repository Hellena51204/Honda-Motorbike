<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $totalProducts = Product::count();
            $totalUsers    = User::where('role', '!=', 'admin')->count();
            $totalOrders   = \App\Models\Order::count();
            
            // Lấy dữ liệu thống kê tổng quan cho Admin Dashboard
            $totalRevenue = \App\Models\Order::where('payment_status', 'completed')->sum('total_amount');
            $pendingOrders = \App\Models\Order::where('payment_status', 'pending')->count();
            $recentOrders = \App\Models\Order::with(['user', 'items'])->orderBy('created_at', 'desc')->take(5)->get();

            // Tính toán dữ liệu doanh thu trong 6 tháng gần nhất để vẽ biểu đồ
            $revenueLabels = [];
            $revenueData = [];
            for ($i = 5; $i >= 0; $i--) {
                $date = \Carbon\Carbon::now()->subMonths($i);
                $revenueLabels[] = "Tháng " . $date->month;
                
                $revenue = \App\Models\Order::where('payment_status', 'completed')
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->sum('total_amount');
                $revenueData[] = $revenue;
            }

            // Thống kê số lượng sản phẩm theo từng danh mục
            $productsByCategory = \App\Models\Product::select('category', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->groupBy('category')
                ->pluck('total', 'category')->toArray();
            
            $categoryLabels = array_keys($productsByCategory);
            $categoryData = array_values($productsByCategory);

            // Trả về giao diện Dashboard dành riêng cho Admin
            return view('dashboard.admin', compact(
                'totalProducts', 'totalUsers', 'totalOrders', 'user',
                'totalRevenue', 'pendingOrders', 'recentOrders',
                'revenueLabels', 'revenueData', 'categoryLabels', 'categoryData'
            ));
        }

        // Trả về giao diện Dashboard mặc định cho người dùng
        return view('dashboard.user', compact('user'));
    }

    /**
     * Cập nhật thông tin cá nhân user
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'email'   => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ], [
            'name.required' => 'Tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng.',
        ]);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }

    /**
     * Upload ảnh đại diện
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'avatar.required' => 'Vui lòng chọn ảnh.',
            'avatar.image'    => 'File phải là ảnh.',
            'avatar.mimes'    => 'Ảnh phải có định dạng jpeg, png, jpg, gif hoặc webp.',
            'avatar.max'      => 'Ảnh không được vượt quá 2MB.',
        ]);

        $user = Auth::user();

        // Xóa tệp ảnh đại diện cũ khỏi hệ thống lưu trữ nếu tồn tại
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Lưu trữ tệp ảnh mới và cập nhật đường dẫn vào cơ sở dữ liệu
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return back()->with('success', 'Cập nhật ảnh đại diện thành công!');
    }
}
