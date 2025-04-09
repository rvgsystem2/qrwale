<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QrCodeController extends Controller
{

    public function index()
{
   
    $qrcodes = QrCode::with('user')->latest()->get(); // eager load user if needed

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

public function destroy($id)
{
    $qr = QrCode::findOrFail($id);
    $qr->delete();

    return response()->json(['success' => true]);
}
}
