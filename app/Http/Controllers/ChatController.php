<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Tampilkan halaman chat untuk customer
     */
    public function index()
    {
        // Tampilkan chat untuk customer
        if (auth()->check()) {
            $chats = Chat::where('id_pelanggan', auth()->user()->id_pelanggan)
                        ->orderBy('created_at', 'asc')
                        ->get();
        } else {
            $chats = collect();
        }
        
        return view('chat.index', compact('chats'));
    }
    
    /**
     * Dashboard admin untuk live chat
     */
    public function adminIndex()
    {
        $chats = Chat::with(['pelanggan', 'admin'])
                    ->orderBy('created_at', 'asc')
                    ->get();
                    
        $pelangganList = Pelanggan::all();
                    
        return view('admin.chat.index', compact('chats', 'pelangganList'));
    }
    
    /**
     * Kirim pesan chat
     */
    public function send(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string',
            'id_pelanggan' => 'nullable',
            'is_from_admin' => 'boolean'
        ]);
        
        $chat = Chat::create([
            'id_chat' => 'CHAT' . str_pad(Chat::count() + 1, 3, '0', STR_PAD_LEFT),
            'id_pelanggan' => $request->id_pelanggan ?? (auth()->check() ? auth()->user()->id_pelanggan : null),
            'id_admin' => auth()->check() && auth()->user()->role == 'admin' ? auth()->user()->id_admin : null,
            'pesan' => $request->pesan,
            'is_from_admin' => $request->is_from_admin ?? false,
            'created_at' => now()
        ]);
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'chat' => $chat]);
        }
        
        return redirect()->back()->with('success', 'Pesan terkirim!');
    }
    
    /**
     * Tandai pesan sebagai sudah dibaca
     */
    public function markAsRead(Request $request)
    {
        Chat::where('id_pelanggan', $request->id_pelanggan)
            ->where('is_from_admin', true)
            ->update(['is_read' => true]);
            
        return response()->json(['success' => true]);
    }
    
    /**
     * Ambil pesan baru
     */
    public function getNewMessages(Request $request)
    {
        $lastId = $request->last_id ?? 0;
        $chats = Chat::where('id_pelanggan', $request->id_pelanggan)
                    ->where('id_chat', '>', $lastId)
                    ->orderBy('created_at', 'asc')
                    ->get();
                    
        return response()->json(['success' => true, 'chats' => $chats]);
    }
}