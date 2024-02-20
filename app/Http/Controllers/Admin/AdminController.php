<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch the last 5 registered users
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        // Fetch the last 5 uploaded photos and their uploader
        $recentPhotos = Photo::with('user')
                          ->orderBy('created_at', 'desc')
                          ->take(5)
                          ->get();

        return view('admin.dashboard', compact('recentUsers', 'recentPhotos'));
    }

}
