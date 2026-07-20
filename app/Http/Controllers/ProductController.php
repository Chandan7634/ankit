<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Support\ImageUploader;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('backend.product.index', ['products' => Product::getAllProduct()]);
    }

    public function create()
    {
        return view('backend.product.create', [
            'categories' => Category::parent()->get(),
            'brands'     => Brand::orderBy('title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:200',
            'summary'     => 'required|string',
            'description' => 'nullable|string',
            'photo'       => 'required|array|min:1',
            'photo.*'     => 'image|max:4096',
            'size'        => 'nullable|array',
            'size.*'      => 'nullable|string|max:100',
            'size_price'  => 'nullable|array',
            'size_price.*' => 'nullable|numeric|min:0',
            'stock'       => 'required|numeric|min:0',
            'cat_id'      => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'brand_id'    => 'nullable|exists:brands,id',
            'is_featured' => 'sometimes|boolean',
            'status'      => 'required|in:active,inactive',
            'condition'   => 'required|in:default,new,hot',
            'price'       => 'required|numeric|min:0',
            'discount'    => 'nullable|numeric|min:0|max:100',
        ]);

        $photos    = ImageUploader::storeMany($request->file('photo'), 'product', ...ImageUploader::PRODUCT);
        $sizePrice = $this->buildSizePriceMap($request);
        $slug      = $this->uniqueSlug($request->title, Product::class);

        Product::create(array_merge($request->except(['photo', 'size', 'size_price', '_token']), [
            'slug'        => $slug,
            'photo'       => implode(',', $photos),
            'size'        => implode(',', array_keys($sizePrice)),
            'size_price'  => $sizePrice ? json_encode($sizePrice) : null,
            'is_featured' => $request->boolean('is_featured'),
        ]));

        return redirect()->route('product.index')->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        return view('backend.product.edit', [
            'product'    => Product::findOrFail($id),
            'categories' => Category::parent()->get(),
            'brands'     => Brand::orderBy('title')->get(),
            'items'      => Product::where('id', $id)->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'title'        => 'required|string|max:200',
            'summary'      => 'required|string',
            'description'  => 'nullable|string',
            'photo'        => 'sometimes|array',
            'photo.*'      => 'image|max:4096',
            'size'         => 'nullable|array',
            'size.*'       => 'nullable|string|max:100',
            'size_price'   => 'nullable|array',
            'size_price.*' => 'nullable|numeric|min:0',
            'stock'        => 'required|numeric|min:0',
            'cat_id'       => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'brand_id'     => 'nullable|exists:brands,id',
            'is_featured'  => 'sometimes|boolean',
            'status'       => 'required|in:active,inactive',
            'condition'    => 'required|in:default,new,hot',
            'price'        => 'required|numeric|min:0',
            'discount'     => 'nullable|numeric|min:0|max:100',
        ]);

        $sizePrice = $this->buildSizePriceMap($request);

        $data = $request->except(['photo', 'size', 'size_price', '_token', '_method']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['size']        = implode(',', array_keys($sizePrice));
        $data['size_price']  = $sizePrice ? json_encode($sizePrice) : null;

        if ($request->hasFile('photo')) {
            $data['photo'] = implode(',', ImageUploader::storeMany(
                $request->file('photo'), 'product', ...ImageUploader::PRODUCT
            ));
        }

        $product->fill($data)->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Pair size[] with size_price[] into ['6" Pot' => 299.0, ...].
     * A size row without a price falls back to the base product price.
     */
    private function buildSizePriceMap(Request $request): array
    {
        $map = [];
        foreach ((array) $request->input('size', []) as $i => $size) {
            $size = trim((string) $size);
            if ($size === '') {
                continue;
            }
            $price = $request->input("size_price.$i");
            $map[$size] = is_numeric($price) ? (float) $price : (float) $request->price;
        }
        return $map;
    }

    private function uniqueSlug(string $title, string $model): string
    {
        $slug  = Str::slug($title);
        $count = $model::where('slug', 'like', $slug . '%')->count();
        return $count ? $slug . '-' . now()->format('ymdHis') : $slug;
    }
}
