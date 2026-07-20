<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'description', 'cat_id', 'child_cat_id',
        'price', 'brand_id', 'discount', 'status', 'photo', 'size', 'size_price',
        'stock', 'is_featured', 'condition',
    ];

    // ── Accessors ────────────────────────────────────────────────────────────

    /**
     * Size => base price map. Falls back to the product's base price for
     * legacy rows that only have the comma-separated `size` column.
     *
     * @return array<string, float>
     */
    public function getSizePricesAttribute(): array
    {
        $map = json_decode($this->size_price ?? '', true);
        if (is_array($map) && $map !== []) {
            return array_map('floatval', $map);
        }

        $sizes = array_filter(array_map('trim', explode(',', (string) $this->size)));
        return array_fill_keys($sizes, (float) $this->price);
    }

    /** Discounted price for a given size (or the base price when size is unknown). */
    public function priceForSize(?string $size): float
    {
        $base = $this->size_prices[$size] ?? (float) $this->price;
        return round($base - ($base * (float) $this->discount) / 100, 2);
    }

    // ── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function cat_info()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function sub_cat_info()
    {
        return $this->belongsTo(Category::class, 'child_cat_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function getReview()
    {
        return $this->hasMany(ProductReview::class, 'product_id')
            ->with('user_info')
            ->where('status', 'active')
            ->orderByDesc('id');
    }

    public function rel_prods()
    {
        return $this->hasMany(Product::class, 'cat_id', 'cat_id')
            ->with('getReview')
            ->active()
            ->orderByDesc('id')
            ->limit(8);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

    // ── Static helpers ───────────────────────────────────────────────────────

    public static function getAllProduct()
    {
        return static::with(['cat_info', 'sub_cat_info'])->orderByDesc('id')->paginate(10);
    }

    public static function getProductBySlug($slug)
    {
        return static::with(['cat_info', 'rel_prods', 'getReview'])->where('slug', $slug)->first();
    }

    public static function countActiveProduct()
    {
        return static::active()->count();
    }
}
