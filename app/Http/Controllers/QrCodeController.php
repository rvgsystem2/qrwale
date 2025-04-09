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
            'url' => 'required|url|max:2048'
        ]);

        $qr = QrCode::create([
            'user_id' => Auth::id(),
            'url' => $request->input('url')
        ]);

        return response()->json(['success' => true, 'qr' => $qr]);
    }

    // public function destroy($id)
    // {
    //     $qr = QrCode::findOrFail($id);
    //     $qr->delete();

    //     return response()->json(['success' => true]);
    // }

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
