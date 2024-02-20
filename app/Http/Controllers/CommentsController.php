<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Photo;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'photo_id' => 'required|exists:photos,id',
        ]);

        $commentCount = Comment::where('photo_id', $request->photo_id)->count();

        if ($commentCount >= 10) {
            return back()->withErrors(['comment' => 'This photo already has the maximum number of comments.']);
        }

        $comment = new Comment;
        $comment->body = $request->comment;
        $comment->photo_id = $request->photo_id;
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->route('photos.show', ['id' => $request->photo_id])
                         ->with('success', 'Comment added successfully.');
    }
}

