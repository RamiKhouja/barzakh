<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en', 'name_ar', 'short_description_en', 'short_description_ar',
        'description_en', 'description_ar', 'owner_name', 'organization_name',
        'main_image', 'price', 'discount_price', 'is_free', 'is_discount',
        'nb_visits', 'nb_buyers', 'is_featured', 'is_new', 'show', 'is_active',
        'is_sold', 'is_soon',
    ];

    protected $casts = [
        'price' => 'float', 'discount_price' => 'float',
        'is_free' => 'boolean', 'is_discount' => 'boolean',
        'is_featured' => 'boolean', 'is_new' => 'boolean', 'show' => 'boolean',
        'is_active' => 'boolean', 'is_sold' => 'boolean', 'is_soon' => 'boolean',
        'nb_visits' => 'integer', 'nb_buyers' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (Product $product): void {
            if ($product->isDirty('name_en') || blank($product->url)) {
                $product->url = static::uniqueUrl($product->name_en, $product->getKey());
            }
        });
    }

    public static function uniqueUrl(string $name, ?int $ignoreId = null): string
    {
        $baseUrl = Str::slug($name) ?: 'product';
        $url = $baseUrl;
        $suffix = 2;

        while (static::query()->where('url', $url)
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->exists()) {
            $url = $baseUrl.'-'.$suffix++;
        }

        return $url;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }

    public function pictures()
    {
        return $this->hasMany(ProductPicture::class);
    }

    public function videos()
    {
        return $this->hasMany(ProductVideo::class);
    }

    public function audios()
    {
        return $this->hasMany(ProductAudio::class);
    }
}
