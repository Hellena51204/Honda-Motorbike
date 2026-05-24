<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        // Khởi tạo và lưu trữ tin nhắn vào cơ sở dữ liệu thông qua model ChatMessage
        $message = new ChatMessage();
        $message->message = $request->message;
        $message->is_admin_reply = false;

        if (Auth::check()) {
            $message->user_id = Auth::id(); // Liên kết tin nhắn với ID người dùng nếu đã đăng nhập
        } else {
            $message->session_id = session()->getId(); // Lưu ID phiên làm việc đối với khách vãng lai
        }
        $message->save();

        // Trả về phản hồi JSON cho client
        return response()->json([
            'status' => 'success',
            'reply' => 'Tin nhắn của bạn đã được gửi đến Admin. Chúng tôi sẽ phản hồi sớm nhất!'
        ]);
    }

    public function adminIndex()
    {
        // Truy xuất danh sách khách hàng đã nhắn tin cùng với tin nhắn gần nhất
        $chats = ChatMessage::select('user_id', 'session_id', DB::raw('MAX(created_at) as last_chat'))
            ->groupBy('user_id', 'session_id')
            ->orderBy('last_chat', 'desc')
            ->get();
        return view('admin.chat', compact('chats'));
    }

    public function adminShow($id)
    {
        // Lấy toàn bộ lịch sử tin nhắn dựa trên mã định danh của khách hàng
        $messages = ChatMessage::where('user_id', $id)
            ->orWhere('session_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json($messages);
    }

    public function adminReply(Request $request, $id)
    {
        $message = new ChatMessage();
        $message->message = $request->message;
        $message->is_admin_reply = true; // Gắn cờ xác định tin nhắn này xuất phát từ tài khoản quản trị viên
        $message->user_id = is_numeric($id) ? $id : null;
        $message->session_id = !is_numeric($id) ? $id : null;
        $message->save();

        return response()->json(['status' => 'success']);
    }
}
