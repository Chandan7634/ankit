<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'photo', 'icon', 'status', 'is_parent', 'parent_id', 'added_by',
    ];

    // ── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeParent($query)
    {
        return $query->where('is_parent', 1);
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function parent_info()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function child_cat()
    {
        return $this->hasMany(Category::class, 'parent_id')->active();
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id')->active();
    }

    public function sub_products()
    {
        return $this->hasMany(Product::class, 'child_cat_id')->active();
    }

    // ── Static helpers ───────────────────────────────────────────────────────

    public static function getAllCategory()
    {
        return static::with('parent_info')->orderByDesc('id')->paginate(10);
    }

    public static function getAllParentWithChild()
    {
        return static::with('child_cat')->parent()->active()->orderBy('title')->get();
    }

    public static function getChildByParentID($id)
    {
        return static::where('parent_id', $id)->orderBy('id')->pluck('title', 'id');
    }

    public static function shiftChild($cat_ids)
    {
        return static::whereIn('id', $cat_ids)->update(['is_parent' => 1]);
    }

    public static function getProductByCat($slug)
    {
        return static::with('products')->where('slug', $slug)->first();
    }

    public static function getProductBySubCat($slug)
    {
        return static::with('sub_products')->where('slug', $slug)->first();
    }

    public static function countActiveCategory()
    {
        return static::active()->count();
    }
}
