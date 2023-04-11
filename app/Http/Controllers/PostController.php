<?php

namespace App\Http\Controllers;

use App\Events\PostViewed;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
//        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);

//        if ($page < 1) $page = 1;
//        if ($limit < 1) $limit = 1;
//
//        $skip = ($page - 1) * $limit;
//
////        $posts = Post::all()->skip($skip)->take($limit)->sortBy('created_at');

        $posts = Post::paginate($limit);

        return view('posts.list', ['posts' => $posts]);
//        $res = new Response();
//        $res->setContent(Post::all());
//        return $res;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('posts.create', []);
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

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): Response
    {
        //
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
