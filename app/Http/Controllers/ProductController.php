<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->orderByDesc('id')->paginate(15);

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('title_en')->get();

        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);
        $product = new Product;
        $this->fillProduct($product, $validated, $request);
        $product->save();

        $product->categories()->sync($validated['categories']);
        $this->storeMedia($product, $request);

        return Redirect::route('admin.products')->with('success', __('admin.product_created'));
    }

    public function edit(Product $product)
    {
        $product->load(['pictures', 'videos', 'audios']);
        $categories = Category::orderBy('title_en')->get();
        $selectedCategories = $product->categories()->pluck('categories.id')->all();

        return view('admin.product.edit', compact('product', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request, $product);
        $this->fillProduct($product, $validated, $request);
        $product->save();

        $product->categories()->sync($validated['categories']);
        $this->removeMedia($product, $request);
        $this->storeMedia($product, $request);

        return Redirect::route('admin.products')->with('success', __('admin.product_updated'));
    }

    public function delete(Product $product)
    {
        $product->delete();

        return Redirect::route('admin.products')->with('success', __('admin.product_deleted'));
    }

    private function validateProduct(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'short_description_en' => ['nullable', 'string'],
            'short_description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'description_ar' => ['nullable', 'string'],
            'owner_name' => ['nullable', 'string', 'max:255'],
            'organization_name' => ['nullable', 'string', 'max:255'],
            'main_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:4096'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lte:price'],
            'is_free' => ['nullable'],
            'is_discount' => ['nullable'],
            'is_featured' => ['nullable'],
            'is_new' => ['nullable'],
            'show' => ['nullable'],
            'is_active' => ['nullable'],
            'is_sold' => ['nullable'],
            'is_soon' => ['nullable'],
            'has_qty' => ['nullable'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'pictures' => ['nullable', 'array'],
            'pictures.*' => ['image', 'mimes:jpeg,jpg,png,gif,webp', 'max:4096'],
            'video_urls' => ['nullable', 'array'],
            'video_urls.*' => ['nullable', 'url', 'max:2048'],
            'audio_paths' => ['nullable', 'array'],
            'audio_paths.*' => ['file', 'mimes:mp3,wav,ogg,m4a,aac', 'max:20480'],
            'remove_pictures' => ['nullable', 'array'],
            'remove_pictures.*' => ['integer'],
            'remove_videos' => ['nullable', 'array'],
            'remove_videos.*' => ['integer'],
            'remove_audios' => ['nullable', 'array'],
            'remove_audios.*' => ['integer'],
        ]);
    }

    private function fillProduct(Product $product, array $validated, Request $request): void
    {
        $product->fill([
            'name_en' => $validated['name_en'],
            'name_ar' => $validated['name_ar'],
            'short_description_en' => $validated['short_description_en'] ?? null,
            'short_description_ar' => $validated['short_description_ar'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'description_ar' => $validated['description_ar'] ?? null,
            'owner_name' => $validated['owner_name'] ?? null,
            'organization_name' => $validated['organization_name'] ?? null,
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'] ?? null,
            'is_free' => $request->boolean('is_free'),
            'is_discount' => $request->boolean('is_discount'),
            'is_featured' => $request->boolean('is_featured'),
            'is_new' => $request->boolean('is_new'),
            'show' => $request->boolean('show'),
            'is_active' => $request->boolean('is_active'),
            'is_sold' => $request->boolean('is_sold'),
            'is_soon' => $request->boolean('is_soon'),
            'has_qty' => $request->boolean('has_qty'),
            'stock' => $validated['stock'] ?? 1,
        ]);

        if ($request->hasFile('main_image')) {
            $fileName = time().'_'.Str::random(8).'_'.$request->file('main_image')->getClientOriginalName();
            $request->file('main_image')->storeAs('/products', $fileName, 'pictures');
            $product->main_image = "/products/{$fileName}";
        }
    }

    private function storeMedia(Product $product, Request $request): void
    {
        foreach ($request->file('pictures', []) as $picture) {
            $fileName = time().'_'.Str::random(8).'_'.$picture->getClientOriginalName();
            $picture->storeAs('/products', $fileName, 'pictures');
            $product->pictures()->create(['picture' => "/products/{$fileName}"]);
        }

        foreach (array_filter($request->input('video_urls', [])) as $videoUrl) {
            $product->videos()->create(['video_url' => $videoUrl]);
        }

        foreach ($request->file('audio_paths', []) as $audio) {
            $fileName = time().'_'.Str::random(8).'_'.$audio->getClientOriginalName();
            $audio->storeAs('/products/audio', $fileName, 'pictures');
            $product->audios()->create(['audio_path' => "/products/audio/{$fileName}"]);
        }
    }

    private function removeMedia(Product $product, Request $request): void
    {
        $product->pictures()->whereIn('id', $request->input('remove_pictures', []))->delete();
        $product->videos()->whereIn('id', $request->input('remove_videos', []))->delete();
        $product->audios()->whereIn('id', $request->input('remove_audios', []))->delete();
    }
}
