<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class SitemapController extends Controller
{
    /**
     * Generate and serve the sitemap
     */
    public function index()
    {
        // Cache the sitemap for 24 hours
        $sitemap = Cache::remember('sitemap_xml', 86400, function () {
            return $this->generateSitemap();
        });

        return response($sitemap, 200, [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public, max-age=86400'
        ]);
    }

    /**
     * Generate the sitemap XML
     */
    private function generateSitemap()
    {
        $urls = $this->getPublicUrls();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
        $xml .= '      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
        $xml .= '      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n";
        $xml .= '            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

        foreach ($urls as $url) {
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($url['loc']) . '</loc>' . "\n";
            $xml .= '    <lastmod>' . $url['lastmod'] . '</lastmod>' . "\n";
            $xml .= '    <changefreq>' . $url['changefreq'] . '</changefreq>' . "\n";
            $xml .= '    <priority>' . $url['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Get all public URLs for the sitemap
     */
    private function getPublicUrls()
    {
        $baseUrl = config('app.url');
        $now = Carbon::now()->toW3cString();

        $urls = [
            // Homepage - Highest priority
            [
                'loc' => $baseUrl,
                'lastmod' => $now,
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],

            // Main pages
            [
                'loc' => $baseUrl . '/pricing',
                'lastmod' => $now,
                'changefreq' => 'weekly',
                'priority' => '0.9'
            ],
            [
                'loc' => $baseUrl . '/about-us',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => $baseUrl . '/benefits',
                'lastmod' => $now,
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'loc' => $baseUrl . '/terms-of-services',
                'lastmod' => $now,
                'changefreq' => 'yearly',
                'priority' => '0.5'
            ]
        ];

        // Add dynamic URLs if needed (e.g., blog posts, case studies, etc.)
        // $urls = array_merge($urls, $this->getDynamicUrls());

        return $urls;
    }

    /**
     * Get dynamic URLs (for future use with blog posts, etc.)
     */
    private function getDynamicUrls()
    {
        $urls = [];
        $baseUrl = config('app.url');

        // Example: Add blog posts if they exist
        // $blogPosts = \App\Models\BlogPost::published()->get();
        // foreach ($blogPosts as $post) {
        //     $urls[] = [
        //         'loc' => $baseUrl . '/blog/' . $post->slug,
        //         'lastmod' => $post->updated_at->toW3cString(),
        //         'changefreq' => 'monthly',
        //         'priority' => '0.6'
        //     ];
        // }

        return $urls;
    }

    /**
     * Generate robots.txt content
     */
    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /attorney/\n";
        $content .= "Disallow: /client/\n";
        $content .= "Disallow: /api/\n";
        $content .= "Disallow: /storage/\n";
        $content .= "Disallow: /vendor/\n";
        $content .= "Disallow: /node_modules/\n";
        $content .= "Disallow: /uploads/\n";
        $content .= "Disallow: /documents/\n";
        $content .= "Disallow: /bci-files/\n";
        $content .= "Disallow: /creditors-files/\n";
        $content .= "Disallow: /jubliee-files/\n";
        $content .= "Disallow: /zip/\n";
        $content .= "Disallow: /pemfile/\n";
        $content .= "Disallow: /clear-cache\n";
        $content .= "Disallow: /optimize\n";
        $content .= "Disallow: /route-cache\n";
        $content .= "Disallow: /route-clear\n";
        $content .= "Disallow: /view-clear\n";
        $content .= "Disallow: /config-cache\n";
        $content .= "Disallow: /logs\n";
        $content .= "Disallow: /custom-scripts/\n";
        $content .= "Disallow: /generate-zip\n";
        $content .= "Disallow: /progress\n";
        $content .= "Disallow: /unsubscribe/\n";
        $content .= "Disallow: /manual-upload/\n";
        $content .= "Disallow: /short-form/\n";
        $content .= "Disallow: /form/intake\n";
        $content .= "Disallow: /questionnaire\n";
        $content .= "Disallow: /doc/download/\n";
        $content .= "\n";
        $content .= "Sitemap: " . config('app.url') . "/sitemap.xml\n";

        return response($content, 200, [
            'Content-Type' => 'text/plain',
            'Cache-Control' => 'public, max-age=86400'
        ]);
    }

    /**
     * Clear sitemap cache
     */
    public function clearCache()
    {
        Cache::forget('sitemap_xml');

        return response()->json([
            'success' => true,
            'message' => 'Sitemap cache cleared successfully'
        ]);
    }
}
