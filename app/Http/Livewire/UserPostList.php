<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserPostList extends Component
{
    use WithPagination;

    public User $user;

    public function render()
    {
        $user_posts = Post::query()->where('user_id', $this->user->id)->orderBy('created_at', 'desc')->paginate();
        return view('livewire.user-post-list', ['user_posts' => $user_posts]);
    }

    public function triggerDelete($post_id)
    {
        $this->emit('triggerPostDelete', $post_id);
    }

    public function deletePost($post_id)
    {
        $post = Post::query()->where('id', $post_id)->first();
        if (!$post) {
            return;
        }

        if (Auth::user()->id != $post->user_id) {
            session()->flash('error', 'Unauthorised');
            return;
        }

        Post::query()->where('id', $post_id)->delete();
    }
}
