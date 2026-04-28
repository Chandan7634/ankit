<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Message;
use App\Models\Order;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Shipping;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function messageList()
    {
        return Message::whereNull('read_at')->orderByDesc('created_at')->get();
    }

    public static function getAllCategory()
    {
        return (new Category)->getAllParentWithChild();
    }

    public static function getHeaderCategory()
    {
        $menu = Category::getAllParentWithChild();
        if ($menu->isEmpty()) {
            return;
        }
        echo '<li><a href="javascript:void(0);">Category <i class="ti-angle-down"></i></a><ul class="sub-menu">';
        foreach ($menu as $cat) {
            if ($cat->child_cat->isNotEmpty()) {
                echo '<li><a href="' . route('product-cat', $cat->slug) . '">' . e($cat->title) . ' <i class="ti-angle-right"></i></a>';
                echo '<ul class="level-menu">';
                foreach ($cat->child_cat as $sub) {
                    echo '<li><a href="' . route('product-sub-cat', [$cat->slug, $sub->slug]) . '">' . e($sub->title) . '</a></li>';
                }
                echo '</ul>';
            } else {
                echo '<li><a href="' . route('product-cat', $cat->slug) . '">' . e($cat->title) . '</a>';
            }
            echo '</li>';
        }
        echo '</ul></li>';
    }

    public static function productCategoryList(string $option = 'all')
    {
        if ($option === 'all') {
            return Category::orderByDesc('id')->get();
        }
        return Category::has('products')->orderByDesc('id')->get();
    }

    public static function postTagList(string $option = 'all')
    {
        if ($option === 'all') {
            return PostTag::orderByDesc('id')->get();
        }
        return PostTag::has('posts')->orderByDesc('id')->get();
    }

    public static function postCategoryList(string $option = 'all')
    {
        if ($option === 'all') {
            return PostCategory::orderByDesc('id')->get();
        }
        return PostCategory::has('posts')->orderByDesc('id')->get();
    }

    public static function cartCount()
    {
        if (! Auth::check()) {
            return 0;
        }
        return Cart::where('user_id', auth()->id())->whereNull('order_id')->count();
    }

    public static function getAllProductFromCart()
    {
        if (! Auth::check()) {
            return collect();
        }
        return Cart::with('product')->where('user_id', auth()->id())->whereNull('order_id')->get();
    }

    public static function totalCartPrice()
    {
        if (! Auth::check()) {
            return 0;
        }
        return Cart::where('user_id', auth()->id())->whereNull('order_id')->sum('amount');
    }

    public static function wishlistCount()
    {
        if (! Auth::check()) {
            return 0;
        }
        return Wishlist::where('user_id', auth()->id())->whereNull('cart_id')->count();
    }

    public static function getAllProductFromWishlist()
    {
        if (! Auth::check()) {
            return collect();
        }
        return Wishlist::with('product')->where('user_id', auth()->id())->whereNull('cart_id')->get();
    }

    public static function totalWishlistPrice()
    {
        if (! Auth::check()) {
            return 0;
        }
        return Wishlist::where('user_id', auth()->id())->whereNull('cart_id')->sum('price');
    }

    public static function earningPerMonth()
    {
        $total = 0;
        foreach (Order::where('status', 'delivered')->with('cart_info')->get() as $order) {
            $total += $order->cart_info->sum('amount');
        }
        return number_format((float) $total, 2, '.', '');
    }

    public static function shipping()
    {
        return Shipping::orderByDesc('id')->get();
    }
}
