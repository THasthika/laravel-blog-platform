<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::factory()->create();

        $tags = Tag::factory()->count(3)->create();

        User::factory()
            ->has(Post::factory()->hasAttached($tags)->set('category_id', $category->id)->count(3))
            ->count(3)
            ->create();

        $user = User::query()->first();

        $post = Post::query()->first();

        $comment = Comment::factory(1)->set('post_id', $post->id)->set('user_id', $user->id)->create()->first();

        $comment->upVote($user);

        Reaction::factory(5)->create();
    }
}
