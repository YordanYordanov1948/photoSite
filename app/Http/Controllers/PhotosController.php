<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Str;

class PhotosController extends Controller
{

    public function index()
    {
        $photos = Photo::orderBy('created_at', 'desc')->paginate(10);
        return view('photos.index', ['photos' => $photos]);
    }

    public function show($id)
    {
        $photo = Photo::findOrFail($id);
        return view('photos.show', ['photo' => $photo]);
    }

    public function create()
    {
        return view('photos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $photoCount = Photo::where('user_id', auth()->id())->count();

        if ($photoCount >= 10) {
            return redirect()->route('photos.create')->withErrors(['photo' => 'You cannot upload more than 10 photos.']);
        }

        $path = $request->file('photo')->store('public/photos');

        $photo = new Photo;
        $photo->title = 'Photo_' . Str::random(10);
        $photo->image_path = Storage::url($path);
        $photo->user_id = auth()->id();
        $photo->save();

        return redirect()->route('photos')->with('success', 'Photo uploaded successfully.');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        if ($photo->user_id != auth()->id()) {
            abort(403, 'You are not allowed to delete this photo.');
        }

        Storage::delete('public/photos/' . basename($photo->image_path));
        $photo->delete();

        return redirect()->route('photos')->with('success', 'Photo deleted successfully.');
    }

}
