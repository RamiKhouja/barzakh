<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductClientController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::whereHas('products', fn ($query) => $query->where('show', true)->where('is_active', true))
            ->orderBy('title_en')
            ->get();

        $products = Product::with('categories')
            ->where('show', true)
            ->where('is_active', true)
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('categories', fn ($categoryQuery) => $categoryQuery->whereKey($request->integer('category')));
            })
            ->orderByDesc('is_featured')
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        $meta_title = __('store.title');
        $meta_description = __('store.description');
        $meta_image = asset('pictures/global/og-main.jpeg');
        $meta_url = url()->current();

        return view('client.products.index', compact('products', 'categories', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
    }

    public function show(string $url)
    {
        $product = Product::with(['categories', 'pictures', 'videos', 'audios'])
            ->where('url', $url)
            ->where('show', true)
            ->where('is_active', true)
            ->firstOrFail();

        $categoryIds = $product->categories->modelKeys();
        $relatedProducts = Product::with('categories')
            ->where('id', '!=', $product->id)
            ->where('show', true)
            ->where('is_active', true)
            ->whereHas('categories', fn ($query) => $query->whereIn('categories.id', $categoryIds))
            ->orderByDesc('is_featured')
            ->orderByDesc('id')
            ->limit(4)
            ->get();

        $youtubeVideos = $product->videos
            ->map(fn ($video) => $this->youtubeEmbedUrl($video->video_url))
            ->filter()
            ->values();

        $lang = app()->getLocale();
        $meta_title = $lang === 'ar' ? $product->name_ar : $product->name_en;
        $meta_description = strip_tags($lang === 'ar' ? $product->short_description_ar : $product->short_description_en);
        $meta_image = $product->main_image ? asset('pictures'.$product->main_image) : asset('pictures/global/og-main.jpeg');
        $meta_url = url()->current();

        return view('client.products.show', compact('product', 'relatedProducts', 'youtubeVideos', 'meta_title', 'meta_description', 'meta_image', 'meta_url'));
    }

    public function cartData(Request $request)
    {
        $ids = collect((array) $request->input('ids'))->filter(fn ($id) => is_numeric($id))->map(fn ($id) => (int) $id)->unique();
        $products = Product::whereIn('id', $ids)->get();

        return response()->json($products->map(fn (Product $product) => [
            'id' => $product->id,
            'name_en' => $product->name_en,
            'name_ar' => $product->name_ar,
            'price' => (float) ($product->is_discount && $product->discount_price !== null ? $product->discount_price : $product->price),
            'image' => $product->main_image ? asset('pictures'.$product->main_image) : asset('pictures/global/og-main.jpeg'),
            'has_qty' => (bool) $product->has_qty,
            'stock' => $product->stock === null ? null : (int) $product->stock,
            'is_sold' => (bool) $product->is_sold,
        ])->values());
    }

    private function youtubeEmbedUrl(string $url): ?string
    {
        $parts = parse_url($url);
        $host = strtolower($parts['host'] ?? '');
        $videoId = null;

        if ($host === 'youtu.be' || $host === 'www.youtu.be') {
            $videoId = trim($parts['path'] ?? '', '/');
        } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com'], true)) {
            if (($parts['path'] ?? '') === '/watch') {
                parse_str($parts['query'] ?? '', $query);
                $videoId = $query['v'] ?? null;
            } elseif (str_starts_with($parts['path'] ?? '', '/embed/')) {
                $videoId = basename($parts['path']);
            } elseif (str_starts_with($parts['path'] ?? '', '/shorts/')) {
                $videoId = basename($parts['path']);
            }
        }

        return $videoId ? 'https://www.youtube.com/embed/'.preg_replace('/[^A-Za-z0-9_-]/', '', $videoId) : null;
    }
}
