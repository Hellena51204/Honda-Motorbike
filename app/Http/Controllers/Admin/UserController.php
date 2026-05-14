<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Hiển thị danh sách user cho admin
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Admin cập nhật hạng membership và điểm cho user
     */
    public function updateMembership(Request $request, User $user)
    {
        $request->validate([
            'membership' => 'required|in:none,silver,gold,diamond',
            'membership_points' => 'required|integer|min:0',
        ]);

        $user->update([
            'membership' => $request->membership,
            'membership_points' => $request->membership_points,
        ]);

        return back()->with('success', 'Cập nhật hạng thành viên cho "' . $user->name . '" thành công!');
    }
}
