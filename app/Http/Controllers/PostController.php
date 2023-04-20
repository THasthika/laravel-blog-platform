<?php

namespace App\Http\Controllers;

use App\Events\PostViewed;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $limit = $request->get('limit', 10);

        $posts = Post::query()->orderBy('created_at', 'desc')->paginate($limit);

        return view('posts.list', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all()->sortBy('name', SORT_ASC);
        return view('posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id): View
    {
        $post = Post::where('id', $id)->first();

        PostViewed::dispatchIf(!!$post, $request, $post);

        $x = Auth::user()->notifications()->get();
        Log::debug($x);

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id): View|Response
    {
        $post = Post::where('id', $id)->first();
        if ($post->user_id != Auth::user()->id) {
            return response(view('errors.403'),403);
        }
        $categories = Category::all()->sortBy('name', SORT_ASC);
        return view('posts.edit', ['categories' => $categories, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        //
    }
}
