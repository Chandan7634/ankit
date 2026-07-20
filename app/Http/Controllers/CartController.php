<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;

class CartController extends Controller
{
    public function addToCart(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        // quick-add uses the first available size (or none for legacy products)
        $size      = array_key_first($product->size_prices);
        $unitPrice = $product->priceForSize($size);

        $cart = Cart::where('user_id', auth()->id())
            ->whereNull('order_id')
            ->where('product_id', $product->id)
            ->where('size', $size)
            ->first();

        if ($cart) {
            if ($product->stock <= $cart->quantity) {
                return back()->with('error', 'Stock not sufficient!');
            }
            $cart->quantity += 1;
            $cart->amount   += $unitPrice;
            $cart->save();
        } else {
            if ($product->stock <= 0) {
                return back()->with('error', 'Product is out of stock.');
            }
            $cart = Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'price'      => $unitPrice,
                'quantity'   => 1,
                'size'       => $size,
                'amount'     => $unitPrice,
            ]);
            Wishlist::where('user_id', auth()->id())
                ->whereNull('cart_id')
                ->update(['cart_id' => $cart->id]);
        }

        return back()->with('success', 'Product added to cart.');
    }

    public function singleAddToCart(Request $request)
    {
        $request->validate([
            'slug'  => 'required|string',
            'quant' => 'required|array',
            'size'  => 'nullable|string|max:100',
        ]);

        $product  = Product::where('slug', $request->slug)->firstOrFail();
        $quantity = (int) ($request->quant[1] ?? 1);

        if ($quantity < 1) {
            return back()->with('error', 'Invalid quantity.');
        }
        if ($product->stock < $quantity) {
            return back()->with('error', 'Out of stock — only ' . $product->stock . ' left.');
        }

        // only accept a size the product actually offers
        $size = $request->size;
        if ($size !== null && ! array_key_exists($size, $product->size_prices)) {
            $size = array_key_first($product->size_prices);
        }
        $unitPrice = $product->priceForSize($size);

        $cart = Cart::where('user_id', auth()->id())
            ->whereNull('order_id')
            ->where('product_id', $product->id)
            ->where('size', $size)
            ->first();

        if ($cart) {
            $newQty = $cart->quantity + $quantity;
            if ($product->stock < $newQty) {
                return back()->with('error', 'Stock not sufficient!');
            }
            $cart->quantity  = $newQty;
            $cart->amount   += $unitPrice * $quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'price'      => $unitPrice,
                'quantity'   => $quantity,
                'size'       => $size,
                'amount'     => $unitPrice * $quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart.');
    }

    public function cartDelete($id)
    {
        $cart = Cart::where('user_id', auth()->id())->whereNull('order_id')->findOrFail($id);
        $cart->delete();
        return back()->with('success', 'Item removed from cart.');
    }

    public function cartUpdate(Request $request)
    {
        if (! $request->quant) {
            return back()->with('error', 'Nothing to update.');
        }

        foreach ($request->quant as $k => $quant) {
            $quant = (int) $quant;
            $id    = $request->qty_id[$k] ?? null;
            $cart  = $id
                ? Cart::where('user_id', auth()->id())->whereNull('order_id')->find($id)
                : null;

            if (! $cart || $quant < 1) {
                continue;
            }
            if ($cart->product->stock < $quant) {
                return back()->with('error', 'Insufficient stock for "' . $cart->product->title . '".');
            }

            $unitPrice      = $cart->product->priceForSize($cart->size);
            $cart->quantity = $quant;
            $cart->price    = $unitPrice;
            $cart->amount   = $unitPrice * $quant;
            $cart->save();
        }

        return back()->with('success', 'Cart updated successfully.');
    }

    public function checkout()
    {
        return view('frontend.pages.checkout');
    }
}
