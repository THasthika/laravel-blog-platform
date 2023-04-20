<?php

namespace App\Http\Livewire;

use App\Events\PostCommented;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class CommentHolder extends Component
{

    use WithPagination;

    public Post $post;

    public string $new_comment;

    public function post_comment()
    {
        $comment = new Comment([
            'content' => $this->new_comment,
            'user_id' => Auth::user()->id,
            'post_id' => $this->post->id
        ]);
        $comment->save();
        PostCommented::dispatch($comment);
        $this->new_comment = "";
    }

    public function triggerDeleteComment($comment_id)
    {
        $this->emit('triggerCommentDelete', $comment_id);
    }

    public function deleteComment($comment_id)
    {
        Comment::query()->where('id', $comment_id)->delete();
    }


    public function render()
    {
        return view('livewire.comment-holder', [
            'comments' => Comment::query()->where('post_id', $this->post->id)->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
