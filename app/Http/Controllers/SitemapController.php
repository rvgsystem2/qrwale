<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
class SitemapController extends Controller
{
    public function index()
    {
        return view('sitemap.index');
    }

    public function generate(Request $request)
    {
        $url = rtrim($request->input('website_url'), '/');

        $client = new Client(['base_uri' => $url]);

        try {
            $response = $client->get('/');
            $html = (string) $response->getBody();

            $crawler = new Crawler($html, $url);
            $links = $crawler->filter('a')->each(function ($node) use ($url) {
                $href = $node->attr('href');
                if (!$href || str_starts_with($href, '#') || str_starts_with($href, 'mailto:') || str_starts_with($href, 'javascript:')) {
                    return null;
                }
                return str_starts_with($href, 'http') ? $href : $url . '/' . ltrim($href, '/');
            });

            $uniqueLinks = collect($links)->filter()->unique();

            $sitemap = Sitemap::create();
            foreach ($uniqueLinks as $link) {
                $sitemap->add(Url::create($link));
            }

            $filename = 'sitemap_' . time() . '.xml';
            $sitemap->writeToFile(public_path($filename));

            return response()->download(public_path($filename));

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to fetch URL. Make sure the site is live and accessible.');
        }
    }
}
