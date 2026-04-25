<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route($request->user()->role);
    }

    public function home()
    {
        return view('frontend.index', [
            'featured'       => Product::active()->featured()->orderByDesc('price')->limit(2)->get(),
            'posts'          => Post::active()->orderByDesc('id')->limit(3)->get(),
            'banners'        => Banner::active()->orderByDesc('id')->limit(3)->get(),
            'product_lists'  => Product::active()->orderByDesc('id')->limit(8)->get(),
            'category_lists' => Category::active()->parent()->orderBy('title')->get(),
        ]);
    }

    public function aboutUs()
    {
        return view('frontend.pages.about-us');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function productDetail($slug)
    {
        $product_detail = Product::getProductBySlug($slug);
        abort_if(! $product_detail, 404);
        return view('frontend.pages.product_detail', compact('product_detail'));
    }

    public function productGrids()
    {
        [$products, $recent_products] = $this->buildProductQuery(9);
        return view('frontend.pages.product-grids', compact('products', 'recent_products'));
    }

    public function productLists()
    {
        [$products, $recent_products] = $this->buildProductQuery(6);
        return view('frontend.pages.product-lists', compact('products', 'recent_products'));
    }

    private function buildProductQuery(int $perPage)
    {
        $query = Product::active();

        if (request('category')) {
            $ids = Category::whereIn('slug', explode(',', request('category')))->pluck('id');
            $query->whereIn('cat_id', $ids);
        }

        if (request('brand')) {
            $ids = Brand::whereIn('slug', explode(',', request('brand')))->pluck('id');
            $query->whereIn('brand_id', $ids);
        }

        if (request('price')) {
            $range = explode('-', request('price'));
            if (count($range) === 2) {
                $query->whereBetween('price', [(float) $range[0], (float) $range[1]]);
            }
        }

        match (request('sortBy')) {
            'title' => $query->orderBy('title'),
            'price' => $query->orderBy('price'),
            default => $query->orderByDesc('id'),
        };

        $perPage = (int) (request('show') ?: $perPage);
        $recent  = Product::active()->orderByDesc('id')->limit(3)->get();

        return [$query->paginate($perPage)->withQueryString(), $recent];
    }

    public function productFilter(Request $request)
    {
        $parts = [];

        if ($request->filled('show'))        $parts[] = 'show=' . $request->show;
        if ($request->filled('sortBy'))      $parts[] = 'sortBy=' . $request->sortBy;
        if ($request->filled('price_range')) $parts[] = 'price=' . $request->price_range;

        if ($request->filled('category')) {
            $parts[] = 'category=' . implode(',', $request->category);
        }
        if ($request->filled('brand')) {
            $parts[] = 'brand=' . implode(',', $request->brand);
        }

        $qs    = $parts ? ('?' . implode('&', $parts)) : '';
        $route = $request->routeIs('product-grids') ? 'product-grids' : 'product-lists';

        return redirect()->to(route($route) . $qs);
    }

    public function productSearch(Request $request)
    {
        $request->validate(['search' => 'required|string|max:200']);

        $term     = $request->search;
        $products = Product::active()
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%$term%")
                  ->orWhere('summary', 'like', "%$term%")
                  ->orWhere('description', 'like', "%$term%");
            })
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        $recent_products = Product::active()->orderByDesc('id')->limit(3)->get();

        return view('frontend.pages.product-grids', compact('products', 'recent_products'));
    }

    public function productBrand($slug)
    {
        $brand           = Brand::where('slug', $slug)->firstOrFail();
        $recent_products = Product::active()->orderByDesc('id')->limit(3)->get();
        $products        = Product::active()
            ->where('brand_id', $brand->id)
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        return view('frontend.pages.product-grids', compact('products', 'recent_products'));
    }

    public function productCat($slug)
    {
        $category        = Category::where('slug', $slug)->firstOrFail();
        $recent_products = Product::active()->orderByDesc('id')->limit(3)->get();
        $products        = Product::active()
            ->where('cat_id', $category->id)
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        return view('frontend.pages.product-grids', compact('products', 'recent_products'));
    }

    public function productSubCat($slug, $sub_slug)
    {
        $category        = Category::where('slug', $sub_slug)->firstOrFail();
        $recent_products = Product::active()->orderByDesc('id')->limit(3)->get();
        $products        = Product::active()
            ->where('child_cat_id', $category->id)
            ->orderByDesc('id')
            ->paginate(9)
            ->withQueryString();

        return view('frontend.pages.product-grids', compact('products', 'recent_products'));
    }

    public function blog()
    {
        $query = Post::active();

        if (request('category')) {
            $ids = PostCategory::whereIn('slug', explode(',', request('category')))->pluck('id');
            $query->whereIn('post_cat_id', $ids);
        }

        if (request('tag')) {
            $ids = PostTag::whereIn('slug', explode(',', request('tag')))->pluck('id');
            $query->whereIn('post_tag_id', $ids);
        }

        $perPage      = (int) (request('show') ?: 9);
        $posts        = $query->orderByDesc('id')->paginate($perPage)->withQueryString();
        $recent_posts = Post::active()->orderByDesc('id')->limit(3)->get();

        return view('frontend.pages.blog', compact('posts', 'recent_posts'));
    }

    public function blogDetail($slug)
    {
        $post         = Post::getPostBySlug($slug);
        $recent_posts = Post::active()->orderByDesc('id')->limit(3)->get();
        return view('frontend.pages.blog-detail', compact('post', 'recent_posts'));
    }

    public function blogSearch(Request $request)
    {
        $request->validate(['search' => 'required|string|max:200']);

        $term  = $request->search;
        $posts = Post::active()
            ->where(function ($q) use ($term) {
                $q->where('title', 'like', "%$term%")
                  ->orWhere('summary', 'like', "%$term%")
                  ->orWhere('description', 'like', "%$term%")
                  ->orWhere('quote', 'like', "%$term%");
            })
            ->orderByDesc('id')
            ->paginate(8)
            ->withQueryString();

        $recent_posts = Post::active()->orderByDesc('id')->limit(3)->get();

        return view('frontend.pages.blog', compact('posts', 'recent_posts'));
    }

    public function blogFilter(Request $request)
    {
        $parts = [];
        if ($request->filled('category')) $parts[] = 'category=' . implode(',', $request->category);
        if ($request->filled('tag'))      $parts[] = 'tag=' . implode(',', $request->tag);

        $qs = $parts ? ('?' . implode('&', $parts)) : '';
        return redirect()->to(route('blog') . $qs);
    }

    public function blogByCategory($slug)
    {
        $postCategory = PostCategory::getBlogByCategory($slug);
        $recent_posts = Post::active()->orderByDesc('id')->limit(3)->get();
        return view('frontend.pages.blog', [
            'posts'        => $postCategory->post,
            'recent_posts' => $recent_posts,
        ]);
    }

    public function blogByTag($slug)
    {
        $posts        = Post::getBlogByTag($slug);
        $recent_posts = Post::active()->orderByDesc('id')->limit(3)->get();
        return view('frontend.pages.blog', compact('posts', 'recent_posts'));
    }

    public function login()
    {
        return view('frontend.pages.login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        }

        return back()->with('error', 'Invalid email or password. Please try again.');
    }

    public function logout()
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }

    public function register()
    {
        return view('frontend.pages.register');
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|min:2|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'status'   => 'active',
            'role'     => 'user',
        ]);

        Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active']);

        return redirect()->route('home')->with('success', 'Registered successfully! Welcome!');
    }

    public function showResetForm()
    {
        return view('auth.passwords.old-reset');
    }

    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        return redirect()->route('home')->with('success', 'Thank you for subscribing! We will keep you updated.');
    }
}
