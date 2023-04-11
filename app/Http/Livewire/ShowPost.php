<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostVote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ShowPost extends Component
{
    public Post $post;

    public function getAllowUpVoteProperty() {
        if (!Auth::user()) {
            return false;
        }

        return $this->post->canUpVoteBy(Auth::user()->id);
    }

    public function getAllowDownVoteProperty() {
        if (!Auth::user()) {
            return false;
        }

        return $this->post->canDownVoteBy(Auth::user()->id);
    }

    public function render()
    {
        return view('livewire.show-post', ['post' => $this->post]);
    }

    public function up_vote()
    {
        if (!Auth::user()) {
            return;
        }
        if (!$this->getAllowDownVoteProperty()) {
            $this->post->removeVoteBy(Auth::user());
        }
        $this->post->upVoteBy(Auth::user());
    }

    public function down_vote() {
        if (!Auth::user()) {
            return;
        }
        if (!$this->getAllowUpVoteProperty()) {
            $this->post->removeVoteBy(Auth::user());
        }
        $this->post->downVoteBy(Auth::user());
    }

    public function remove_vote() {
        if (!Auth::user()) {
            return;
        }
        $this->post->removeVoteBy(Auth::user());
    }
}
