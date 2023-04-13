<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home(): View
    {
        $latest_posts = Post::query()->orderBy('created_at', 'desc')->limit(5)->get();
        return view('home', ['latest_posts' => $latest_posts]);
    }

    public function dashboard(): View
    {
        return view('dashboard');
    }
}
