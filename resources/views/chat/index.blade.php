@extends('layouts.app')

@section('title', 'Live Chat')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-comment-dots"></i> Live Chat Macah Bakery</h5>
                </div>
                <div class="card-body" style="height: 400px; overflow-y: auto;" id="chat-box">
                    @if($chats->isEmpty())
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-comment fa-3x"></i>
                        <p class="mt-2">Mulai percakapan dengan admin!</p>
                    </div>
                    @else
                        @foreach($chats as $chat)
                        <div class="mb-3">
                            <div class="d-flex {{ $chat->is_from_admin ? 'justify-content-start' : 'justify-content-end' }}">
                                <div class="p-2 rounded {{ $chat->is_from_admin ? 'bg-light' : 'bg-primary text-white' }}" 
                                     style="max-width: 70%;">
                                    <small>{{ $chat->is_from_admin ? 'Admin' : 'Anda' }}</small>
                                    <p class="mb-0">{{ $chat->pesan }}</p>
                                    <small class="text-muted">{{ $chat->created_at ? $chat->created_at->format('H:i') : '' }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="card-footer">
                    <form action="/chat/send" method="POST" class="d-flex">
                        @csrf
                        <input type="text" name="pesan" class="form-control me-2" placeholder="Ketik pesan..." required>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="mt-3 text-center text-muted">
                <small>Jam operasional: 07.00 - 19.00 WIB</small>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;
});
</script>
@endsection