<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'tags', 'summary', 'slug', 'description',
        'photo', 'quote', 'post_cat_id', 'post_tag_id', 'added_by', 'status',
    ];

    // ── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function cat_info()
    {
        return $this->belongsTo(PostCategory::class, 'post_cat_id');
    }

    public function tag_info()
    {
        return $this->belongsTo(PostTag::class, 'post_tag_id');
    }

    public function author_info()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class)
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->with('user_info')
            ->orderByDesc('id');
    }

    public function allComments()
    {
        return $this->hasMany(PostComment::class)->where('status', 'active');
    }

    // ── Static helpers ───────────────────────────────────────────────────────

    public static function getAllPost()
    {
        return static::with(['cat_info', 'author_info'])->orderByDesc('id')->paginate(10);
    }

    public static function getPostBySlug($slug)
    {
        return static::with(['tag_info', 'author_info'])->where('slug', $slug)->active()->first();
    }

    public static function getBlogByTag($slug)
    {
        return static::where('tags', $slug)->paginate(8);
    }

    public static function countActivePost()
    {
        return static::active()->count();
    }
}
