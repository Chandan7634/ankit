<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        return view('backend.banner.index', ['banners' => Banner::orderByDesc('id')->paginate(10)]);
    }

    public function create()
    {
        return view('backend.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:50',
            'description' => 'nullable|string',
            'photo'       => 'required|image|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        $slug  = Str::slug($request->title);
        $count = Banner::where('slug', $slug)->count();
        if ($count > 0) {
            $slug .= '-' . now()->format('ymdHis');
        }

        Banner::create(array_merge($request->except(['_token', 'photo']), [
            'slug'  => $slug,
            'photo' => $request->file('photo')->store('banner', 'public'),
        ]));

        return redirect()->route('banner.index')->with('success', 'Banner added successfully.');
    }

    public function edit($id)
    {
        return view('backend.banner.edit', ['banner' => Banner::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:50',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|max:2048',
            'status'      => 'required|in:active,inactive',
        ]);

        $data = $request->except(['_token', '_method', 'photo']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('banner', 'public');
        }

        $banner->fill($data)->save();

        return redirect()->route('banner.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy($id)
    {
        Banner::findOrFail($id)->delete();
        return redirect()->route('banner.index')->with('success', 'Banner deleted successfully.');
    }
}
