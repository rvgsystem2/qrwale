<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{
    public function index()
    {
        $urls = ShortUrl::latest()->get();
        return view('shorturls.index', compact('urls'));
    }

    public function create()
    {
        return view('shorturls.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'original_url' => ['required', 'url', 'max:2048'],
        ]);

        $original = trim($request->original_url);

        // unique short code
        do {
            $code = Str::lower(Str::random(6));
        } while (ShortUrl::where('short_code', $code)->exists());

        $row = ShortUrl::create([
            'original_url' => $original,
            'short_code'   => $code,

            // optional guest fields (if columns exist)
            'user_id'      => Auth::check() ? Auth::id() : null,
            'session_id'   => $request->session()->getId(),
            'ip_address'   => $request->ip(),
            'user_agent'   => substr((string)$request->userAgent(), 0, 255),
        ]);

        $shortUrl = url('/s/' . $row->short_code);

        // ✅ If request expects JSON (hero tool) return JSON else redirect
        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success'   => true,
                'id'        => $row->id,
                'short_code'=> $row->short_code,
                'short_url' => $shortUrl,
                'original'  => $row->original_url,
            ]);
        }

        return redirect()->route('shorturls.index')->with('success', 'Short URL created successfully.');
    }

    public function redirect(string $code)
    {
        $item = ShortUrl::where('short_code', $code)->firstOrFail();
        return redirect()->away($item->original_url);
    }

    public function edit(ShortUrl $shorturl)
    {
        return view('shorturls.create', compact('shorturl'));
    }

    public function update(Request $request, ShortUrl $shorturl)
    {
        $request->validate([
            'original_url' => 'required|url',
        ]);

        $shorturl->update([
            'original_url' => $request->original_url,
        ]);

        return redirect()->route('shorturls.index')->with('success', 'Short URL updated.');
    }

    // public function redirect($code)
    // {
    //     $url = ShortUrl::where('short_code', $code)->firstOrFail();
    //     return redirect()->away($url->original_url);
    // }

    public function destroy(ShortUrl $shorturl)
{
    $shorturl->delete();
    return redirect()->route('shorturls.index')->with('success', 'Short URL deleted successfully.');
}

}
