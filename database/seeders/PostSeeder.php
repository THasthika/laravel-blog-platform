<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::all()->first();

        if (Post::all()->first()) {
            return;
        }

        $post = new Post();
        $post->user_id = $user->id;
        $post->title = "Hello World";
        $post->content = "Hello World 123";
        $post->subtitle = "Subtitle";

        $post->save();
    }
}
