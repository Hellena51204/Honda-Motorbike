<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Hiển thị giao diện quên mật khẩu
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Xử lý yêu cầu thay đổi mật khẩu trực tiếp
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.'
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput($request->only('email'))
                         ->withErrors(['email' => 'Không tìm thấy tài khoản với email này.']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        $user->save();

        // Chuyển hướng về trang đăng nhập kèm thông báo thành công
        return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công! Vui lòng đăng nhập bằng mật khẩu mới.');
    }
}
