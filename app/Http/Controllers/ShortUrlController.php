<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
            'original_url' => 'required|url',
        ]);

        $shortCode = Str::random(6);

        ShortUrl::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
        ]);

        return redirect()->route('shorturls.index')->with('success', 'Short URL created successfully.');
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

    public function redirect($code)
    {
        $url = ShortUrl::where('short_code', $code)->firstOrFail();
        return redirect()->away($url->original_url);
    }

    public function destroy(ShortUrl $shorturl)
{
    $shorturl->delete();
    return redirect()->route('shorturls.index')->with('success', 'Short URL deleted successfully.');
}

}
