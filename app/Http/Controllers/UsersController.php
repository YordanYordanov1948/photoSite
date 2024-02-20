<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::withCount('photos')->orderBy('photos_count', 'desc')->paginate(10);
        return view('users.index', compact('users'));
    }
}
