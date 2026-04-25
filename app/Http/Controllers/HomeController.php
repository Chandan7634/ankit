<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PostComment;
use App\Models\ProductReview;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.index');
    }

    public function profile()
    {
        return view('user.users.profile', ['profile' => auth()->user()]);
    }

    public function profileUpdate(Request $request, $id)
    {
        User::findOrFail($id)->fill($request->except(['_token', '_method', 'password']))->save();
        return back()->with('success', 'Profile updated successfully.');
    }

    // ── Orders ───────────────────────────────────────────────────────────────

    public function orderIndex()
    {
        $orders = Order::where('user_id', auth()->id())->orderByDesc('id')->paginate(10);
        return view('user.order.index', compact('orders'));
    }

    public function orderShow($id)
    {
        $order = Order::with('cart_info.product')->findOrFail($id);
        return view('user.order.show', compact('order'));
    }

    public function userOrderDelete($id)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($id);

        if (in_array($order->status, ['process', 'delivered', 'cancel'])) {
            return back()->with('error', 'You cannot delete this order.');
        }

        $order->delete();
        return redirect()->route('user.order.index')->with('success', 'Order deleted successfully.');
    }

    // ── Reviews ──────────────────────────────────────────────────────────────

    public function productReviewIndex()
    {
        return view('user.review.index', ['reviews' => ProductReview::getAllUserReview()]);
    }

    public function productReviewEdit($id)
    {
        return view('user.review.edit', ['review' => ProductReview::findOrFail($id)]);
    }

    public function productReviewUpdate(Request $request, $id)
    {
        $request->validate(['rate' => 'required|integer|between:1,5', 'review' => 'nullable|string']);
        ProductReview::findOrFail($id)->fill($request->only(['rate', 'review']))->save();
        return redirect()->route('user.productreview.index')->with('success', 'Review updated.');
    }

    public function productReviewDelete($id)
    {
        ProductReview::findOrFail($id)->delete();
        return redirect()->route('user.productreview.index')->with('success', 'Review deleted.');
    }

    // ── Comments ─────────────────────────────────────────────────────────────

    public function userComment()
    {
        return view('user.comment.index', ['comments' => PostComment::getAllUserComments()]);
    }

    public function userCommentEdit($id)
    {
        return view('user.comment.edit', ['comment' => PostComment::findOrFail($id)]);
    }

    public function userCommentUpdate(Request $request, $id)
    {
        $request->validate(['message' => 'required|string']);
        PostComment::findOrFail($id)->fill($request->only('message'))->save();
        return redirect()->route('user.post-comment.index')->with('success', 'Comment updated.');
    }

    public function userCommentDelete($id)
    {
        PostComment::findOrFail($id)->delete();
        return back()->with('success', 'Comment deleted.');
    }

    // ── Password ─────────────────────────────────────────────────────────────

    public function changePassword()
    {
        return view('user.layouts.userPasswordChange');
    }

    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password'     => ['required', new MatchOldPassword],
            'new_password'         => ['required', 'min:6'],
            'new_confirm_password' => ['required', 'same:new_password'],
        ]);

        auth()->user()->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('user')->with('success', 'Password changed successfully.');
    }
}
