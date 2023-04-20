<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::query()->where('id', $id)->first();
        if (!$user) {
            abort(404);
        }
        $post_count = $user->posts->count();
        $user_posts = Post::query()->where('user_id', $user->id)->paginate();
        return view('users.show', ['user' => $user, 'post_count' => $post_count, 'user_posts' => $user_posts]);
    }
}
