<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QrCodeController extends Controller
{

    public function index()
{
    if (auth()->user()->hasRole('Super Admin')) {
        // 👑 Super Admin: show all QR codes
        $qrcodes = QrCode::with('user')->latest()->get();
    } else {
        // 👤 Regular User: show only own QR codes
        $qrcodes = QrCode::with('user')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    }

    return view('qrcodes.index', compact('qrcodes'));
}

public function store(Request $request)
{
    $request->validate([
        'url' => ['required','url','max:2048'],
    ]);

    $sessionId = $request->session()->getId();
    $userId    = Auth::check() ? Auth::id() : null;

    $qr = QrCode::updateOrCreate(
        [
            'url'        => $request->input('url'),
            'session_id' => $sessionId,
        ],
        [
            'user_id'    => $userId, // ✅ yaha bhi do
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
        ]
    );

    return response()->json(['success' => true, 'qr' => $qr]);
}


 
    public function destroy($id)
{
    $user = auth()->user();

    if (!$user->hasRole('Super Admin')) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ], 403); // Forbidden
    }

    $qr = QrCode::findOrFail($id);
    $qr->delete();

    return response()->json(['success' => true]);
}
}
