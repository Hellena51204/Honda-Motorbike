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
        // Lưu tin nhắn vào Database (Dùng Model ChatMessage đã tạo hôm trước)
        $message = new ChatMessage();
        $message->message = $request->message;
        $message->is_admin_reply = false;

        if (Auth::check()) {
            $message->user_id = Auth::id(); // Nếu đã đăng nhập thì lưu ID
        } else {
            $message->session_id = session()->getId(); // Nếu là khách lạ thì lưu Session
        }
        $message->save();

        // Trả về phản hồi cho JS (Có thể nâng cấp hàm này để nhận diện từ khóa)
        return response()->json([
            'status' => 'success',
            'reply' => 'Tin nhắn của bạn đã được gửi đến Admin. Chúng tôi sẽ phản hồi sớm nhất!'
        ]);
    }

    public function adminIndex()
    {
        // Lấy danh sách các khách hàng có gửi tin nhắn, kèm tin nhắn mới nhất
        $chats = ChatMessage::select('user_id', 'session_id', DB::raw('MAX(created_at) as last_chat'))
            ->groupBy('user_id', 'session_id')
            ->orderBy('last_chat', 'desc')
            ->get();
        return view('admin.chat', compact('chats'));
    }

    public function adminShow($id)
    {
        // Truy vấn lịch sử chat dựa trên user_id (hoặc session_id nếu là khách lạ)
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
        $message->is_admin_reply = true; // Đánh dấu đây là tin nhắn của Admin
        $message->user_id = is_numeric($id) ? $id : null;
        $message->session_id = !is_numeric($id) ? $id : null;
        $message->save();

        return response()->json(['status' => 'success']);
    }
}
