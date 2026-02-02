<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\ImageManager;

class TempImageController extends Controller
{
    public function category(Request $request){
       // Validate the file
        $validated = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filePath = $request->file('file')->store('category', 'public');

        
        // $destinationPathThumbnail = public_path('category/thumbnail/');
        // $request->file('file')->resize(100,100);
        // $request->file('file')->save($destinationPathThumbnail.$imageName);

        // Return the file path or a URL as JSON
        return response()->json([
            'message' => 'File uploaded successfully',
            'file_path' => $filePath,
            'url' => asset('storage/' . $filePath),  // URL of the uploaded file
        ]);
    }
}
