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
            
            // For new dashboard stats
            $totalRevenue = \App\Models\Order::where('payment_status', 'completed')->sum('total_amount');
            $pendingOrders = \App\Models\Order::where('payment_status', 'pending')->count();
            $recentOrders = \App\Models\Order::with(['user', 'items'])->orderBy('created_at', 'desc')->take(5)->get();

            // Admin dùng layout riêng có sidebar (layouts.admin)
            return view('dashboard.admin', compact(
                'totalProducts', 'totalUsers', 'totalOrders', 'user',
                'totalRevenue', 'pendingOrders', 'recentOrders'
            ));
        }

        // User thường dùng layout app.blade.php
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

        // Xóa ảnh cũ nếu có
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Lưu ảnh mới
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return back()->with('success', 'Cập nhật ảnh đại diện thành công!');
    }
}
