<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photo::with('user', 'comments')
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return view('admin.photos.index', compact('photos'));
    }

    // Show the form for creating a new photo
    public function create()
    {
        return view('admin.photos.create');
    }

    // Store a newly created photo in storage
    public function store(Request $request)
    {
        // Temporarily output request data to debug
        logger($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('public/photos');

        $userId = auth()->id();

        Photo::create([
            'title' => $request->title,
            'image_path' => Storage::url($path),
            'user_id' => $userId,
        ]);

        return redirect()->route('admin.photos.index')->with('success', 'Photo uploaded successfully.');
    }


    // Show the form for editing the specified photo
    public function edit(Photo $photo)
    {
        return view('admin.photos.edit', compact('photo'));
    }

    // Update the specified photo in storage
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'sometimes|image|max:2048',
        ]);

        $data = $request->only(['title']);

        // Handle image update
        if ($request->hasFile('image')) {

            if ($photo->image_path) {
                Storage::delete($photo->image_path);
            }

            $path = $request->file('image')->store('public/photos');
            $data['image_path'] = Storage::url($path);
        }

        $photo->update($data);

        return redirect()->route('admin.photos.index')->with('success', 'Photo updated successfully.');
    }


    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('admin.photos.index')->with('success', 'Photo deleted successfully.');
    }

    public function showComments(Photo $photo)
    {
        $comments = $photo->comments;

        return view('admin.photos.comments', compact('comments', 'photo'));
    }
}
