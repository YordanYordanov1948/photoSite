<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class HomeController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->take(10)->get();
        return view('home.index', compact('photos'));
    }
}
