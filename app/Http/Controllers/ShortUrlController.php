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
    $data = $request->validate([
        'original_url' => ['required', 'string', 'max:2048'], // ✅ url rule hata diya
    ]);

    $original  = trim($data['original_url']);
    $userId    = Auth::check() ? Auth::id() : null;
    $sessionId = $request->session()->getId();

    // unique short code
    do {
        $code = Str::lower(Str::random(6));
    } while (ShortUrl::where('short_code', $code)->exists());

    $row = ShortUrl::create([
        'original_url' => $original,
        'short_code'   => $code,
        'user_id'      => $userId,
        'session_id'   => $sessionId,
        'ip_address'   => $request->ip(),
        'user_agent'   => substr((string)$request->userAgent(), 0, 255),
    ]);

    $shortUrl = url('/s/' . $row->short_code);

    if ($request->expectsJson() || $request->wantsJson()) {
        return response()->json([
            'success' => true,
            'short_url' => $shortUrl,
            'original'  => $row->original_url,
        ]);
    }

    return redirect()->route('shorturls.index')->with('success', 'Short URL created.');
}


public function redirect($code)
{
    $row = ShortUrl::where('short_code', $code)->firstOrFail();

    $raw = trim((string) $row->original_url);
    $url = $this->normalizeToUrl($raw);

    if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
        return redirect()->away($url);
    }

    // ✅ agar URL valid nahi bana -> ek page show (copy text)
    return view('shorturls.invalid', ['text' => $raw, 'code' => $code]);
}

private function normalizeToUrl(string $raw): ?string
{
    if ($raw === '') return null;

    if (preg_match('~^https?://~i', $raw)) return $raw;

    // IP: 27.0.0.1:8000
    if (preg_match('~^(\d{1,3}\.){3}\d{1,3}(:\d+)?(/.*)?$~', $raw)) {
        return 'http://' . $raw;
    }

    // domain: example.com
    if (preg_match('~^[\w.-]+\.[a-z]{2,}(:\d+)?(/.*)?$~i', $raw)) {
        return 'https://' . $raw;
    }

    return null; // anything else -> cannot redirect
}



   public function storeOld(Request $request)
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

    public function redirectOld(string $code)
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
