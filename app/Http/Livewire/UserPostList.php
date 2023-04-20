<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserPostList extends Component
{
    use WithPagination;

    public User $user;

    public function render()
    {
        $user_posts = Post::query()->where('user_id', $this->user->id)->paginate();
        return view('livewire.user-post-list', ['user_posts' => $user_posts]);
    }

    public function triggerDelete($post_id)
    {
        $this->emit('triggerPostDelete', $post_id);
    }

    public function deletePost($post_id)
    {
        Post::query()->where('id', $post_id)->delete();
    }
}
