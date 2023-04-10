<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    private int $USER_COUNT = 10;
    private int $POST_PER_USER = 5;
    private int $TAG_PER_POST = 3;
    private int $COMMENT_PER_POST = 3;
    private int $VOTE_PER_POST = 3;
    private int $VOTE_PER_COMMENT = 3;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $categories = Category::all();
        echo "Categories Created!\n";

        $tags = Tag::all();
        echo "Tags Created!\n";

        $category_array = $categories->toArray();
        $tag_array = $tags->toArray();


        // create users
        $users = User::factory($this->USER_COUNT)->create();
        echo "Users Created!\n";

        // create posts
        foreach ($users as $user) {

            // create posts per user
            $posts = Post::factory()->set('user_id', $user->id)
                ->set('category_id', $categories[0]->id)->count($this->POST_PER_USER)->create();

            // for each post randomize tags and categories
            foreach ($posts as $post) {
                $cat_index = array_rand($category_array, 1);
                $category = $categories[$cat_index];
                $tag_keys = array_rand($tag_array, $this->TAG_PER_POST);

                foreach ($tag_keys as $tk) {
                    $post->tags()->save($tags[$tk]);
                }

                $post->category_id = $category->id;

                $post->save();
            }
        }
        echo "Posts Created!\n";

        $posts = Post::all();

        // comment and react on posts
        foreach ($posts as $post) {
            $user_idxs = array_rand($users->toArray(), $this->COMMENT_PER_POST);

            foreach ($user_idxs as $user_idx) {
                Comment::factory()->set('post_id', $post->id)->set('user_id', $users[$user_idx]->id)->create();
            }

            $user_idxs = array_rand($users->toArray(), $this->VOTE_PER_POST);

            foreach ($user_idxs as $user_idx) {
                $post->removeVote($users[$user_idx]);
                if (rand(0, 1) == 1) {
                    $post->upVote($users[$user_idx]);
                } else {
                    $post->downVote($users[$user_idx]);
                }
            }
        }
        echo "Comments Created!\n";

        $comments = Comment::all();

        // upvote on comment
        foreach ($comments as $comment) {
            $user_idxs = array_rand($users->toArray(), $this->VOTE_PER_COMMENT);

            foreach ($user_idxs as $user_idx) {
                $comment->removeVote($users[$user_idx]);
                if (rand(0, 1) == 1) {
                    $comment->upVote($users[$user_idx]);
                } else {
                    $comment->downVote($users[$user_idx]);
                }
            }
        }
        echo "Comment Votes Created!\n";


    }
}
