<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data = User::select(
                DB::raw('COUNT(*) as count'),
                DB::raw('DAYNAME(created_at) as day_name'),
                DB::raw('DAY(created_at) as day')
            )
            ->where('created_at', '>', Carbon::today()->subDays(6))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        $array = [['Name', 'Number']];
        foreach ($data as $value) {
            $array[] = [$value->day_name, $value->count];
        }

        return view('backend.index', ['users' => json_encode($array)]);
    }

    public function profile()
    {
        return view('backend.users.profile', ['profile' => auth()->user()]);
    }

    public function profileUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->except(['_token', '_method', 'password']))->save();
        return back()->with('success', 'Profile updated successfully.');
    }

    public function settings()
    {
        return view('backend.setting', ['data' => Settings::first()]);
    }

    public function settingsUpdate(Request $request)
    {
        $request->validate([
            'short_des'   => 'required|string',
            'description' => 'required|string',
            'photo'       => 'required',
            'logo'        => 'required',
            'address'     => 'required|string',
            'email'       => 'required|email',
            'phone'       => 'required|string',
        ]);

        Settings::first()->fill($request->except(['_token', '_method']))->save();

        return redirect()->route('admin')->with('success', 'Settings updated successfully.');
    }

    public function changePassword()
    {
        return view('backend.layouts.changePassword');
    }

    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password'  => ['required', new MatchOldPassword],
            'new_password'      => ['required', 'min:6'],
            'new_confirm_password' => ['required', 'same:new_password'],
        ]);

        auth()->user()->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('admin')->with('success', 'Password changed successfully.');
    }
}
