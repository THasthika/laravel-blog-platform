<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
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
//        Post::factory()->count(3)->create();

//        Post::factory()->count(10)->has(User::factory(), 'user_id')->create();

//        $this->call([
//            UserSeeder::class
//        ]);
        // (new PostSeeder())->run();
        // (new CommentSeeder())->run();
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
