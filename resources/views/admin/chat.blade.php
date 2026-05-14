@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row" style="height: 80vh;">
        <div class="col-md-4 border-end bg-white overflow-auto p-0">
            <div class="p-3 border-bottom honda-red text-white">
                <h5 class="mb-0">Hộp thư hỗ trợ</h5>
            </div>
            <div class="list-group list-group-flush">
                @foreach($chats as $chat)
                <button class="list-group-item list-group-item-action p-3 user-chat-link" data-id="{{ $chat->user_id ?? $chat->session_id }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>{{ $chat->user->name ?? 'Khách lạ (' . substr($chat->session_id, 0, 5) . '...)' }}</strong>
                        <small class="text-muted">{{ $chat->last_chat->diffForHumans() }}</small>
                    </div>
                </button>
                @endforeach
            </div>
        </div>

        <div class="col-md-8 d-flex flex-column bg-light p-0">
            <div id="admin-chat-body" class="flex-grow-1 p-4 overflow-auto" style="background-color: #f0f2f5;">
                <div class="text-center text-muted mt-5">Chọn một hội thoại để bắt đầu trả lời</div>
            </div>

            <div class="p-3 bg-white border-top d-none" id="reply-box">
                <div class="input-group">
                    <input type="text" id="admin-reply-input" class="form-control rounded-pill" placeholder="Nhập phản hồi cho khách...">
                    <button class="btn btn-danger rounded-pill ms-2 px-4" id="btn-admin-reply">Gửi</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Logic Javascript để load tin nhắn khi Admin click vào tên khách hàng
    document.querySelectorAll('.user-chat-link').forEach(btn => {
        btn.onclick = async function() {
            const id = this.dataset.id;
            document.getElementById('reply-box').classList.remove('d-none');
            // Gọi AJAX lấy tin nhắn và in ra #admin-chat-body...
        }
    });
</script>
@endsection