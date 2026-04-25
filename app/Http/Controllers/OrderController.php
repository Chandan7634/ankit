<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\User;
use App\Helpers\Helper;
use App\Notifications\StatusNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(10);
        return view('backend.order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'address1'   => 'required|string|max:255',
            'address2'   => 'nullable|string|max:255',
            'phone'      => 'required|digits_between:7,15',
            'post_code'  => 'nullable|string|max:20',
            'email'      => 'required|email|max:150',
        ]);

        $hasCart = Cart::where('user_id', auth()->id())
            ->whereNull('order_id')
            ->exists();

        if (! $hasCart) {
            return back()->with('error', 'Your cart is empty!');
        }

        $subTotal  = Helper::totalCartPrice();
        $coupon    = session('coupon.value', 0);
        $shipping  = 0;

        if ($request->filled('shipping')) {
            $shipping = (float) Shipping::where('id', $request->shipping)->value('price');
        }

        $order = Order::create([
            'order_number'   => 'ORD-' . strtoupper(Str::random(10)),
            'user_id'        => auth()->id(),
            'shipping_id'    => $request->shipping ?: null,
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'country'        => $request->input('country', 'India'),
            'address1'       => $request->address1,
            'address2'       => $request->address2,
            'post_code'      => $request->post_code,
            'sub_total'      => $subTotal,
            'coupon'         => $coupon ?: null,
            'total_amount'   => max(0, $subTotal + $shipping - $coupon),
            'quantity'       => Helper::cartCount(),
            'payment_method' => 'cod',
            'payment_status' => 'unpaid',
            'status'         => 'new',
        ]);

        Cart::where('user_id', auth()->id())
            ->whereNull('order_id')
            ->update(['order_id' => $order->id]);

        session()->forget('coupon');

        try {
            $admin = User::where('role', 'admin')->first();
            if ($admin) {
                Notification::send($admin, new StatusNotification([
                    'title'     => 'New Order Received',
                    'actionURL' => route('order.show', $order->id),
                    'fas'       => 'fa-file-alt',
                ]));
            }
        } catch (\Exception) {
            // notification failure must not block the order
        }

        return redirect()->route('home')
            ->with('success', 'Order placed successfully. Thank you for shopping with us!');
    }

    public function show($id)
    {
        $order = Order::with('cart_info.product')->findOrFail($id);
        return view('backend.order.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('backend.order.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,process,delivered,cancel',
        ]);

        $order = Order::with('cart.product')->findOrFail($id);

        if ($request->status === 'delivered') {
            foreach ($order->cart as $cartItem) {
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }
        }

        $order->update(['status' => $request->status]);

        return redirect()->route('order.index')
            ->with('success', 'Order status updated successfully.');
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->route('order.index')
            ->with('success', 'Order deleted successfully.');
    }

    public function orderTrack()
    {
        return view('frontend.pages.order-track');
    }

    public function productTrackOrder(Request $request)
    {
        $request->validate(['order_number' => 'required|string']);

        $order = Order::where('user_id', auth()->id())
            ->where('order_number', $request->order_number)
            ->first();

        if (! $order) {
            return back()->with('error', 'Invalid order number. Please try again!');
        }

        $messages = [
            'new'       => ['success', 'Your order has been placed and is awaiting processing.'],
            'process'   => ['success', 'Your order is currently being processed.'],
            'delivered' => ['success', 'Your order has been delivered. Thank you for shopping with us!'],
            'cancel'    => ['error',   'Sorry, your order has been cancelled.'],
        ];

        [$type, $message] = $messages[$order->status] ?? ['error', 'Unknown order status.'];

        return redirect()->route('home')->with($type, $message);
    }

    public function pdf($id)
    {
        $order     = Order::getAllOrder($id);
        $fileName  = $order->order_number . '-' . $order->first_name . '.pdf';
        return Pdf::loadView('backend.order.pdf', compact('order'))->download($fileName);
    }

    public function incomeChart()
    {
        $year  = Carbon::now()->year;
        $items = Order::with('cart_info')
            ->whereYear('created_at', $year)
            ->where('status', 'delivered')
            ->get()
            ->groupBy(fn ($d) => Carbon::parse($d->created_at)->format('m'));

        $result = [];
        foreach ($items as $month => $collection) {
            $m = (int) $month;
            foreach ($collection as $item) {
                $result[$m] = ($result[$m] ?? 0) + $item->cart_info->sum('amount');
            }
        }

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[date('F', mktime(0, 0, 0, $i, 1))] = number_format((float) ($result[$i] ?? 0), 2, '.', '');
        }

        return response()->json($data);
    }
}
