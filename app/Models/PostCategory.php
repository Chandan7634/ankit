<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
class PostCategory extends Model
{
    protected $fillable=['title','slug','status'];

    public function posts(){
        return $this->hasMany(Post::class,'post_cat_id','id')->where('status','active');
    }

    public static function findBySlugWithPosts($slug){
        return PostCategory::with('posts')->where('slug',$slug)->first();
    }
}
