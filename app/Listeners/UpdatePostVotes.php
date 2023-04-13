<?php

namespace App\Listeners;

use App\Events\PostVoted;
use App\Models\PostVote;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdatePostVotes
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostVoted $event): void
    {
        $post = $event->post;

        $post_votes = PostVote::query()->selectRaw('vote_type, COUNT(*) as count')
            ->where('post_id', $post->id)->groupBy(['post_id', 'vote_type'])->get();

        $votes = 0;

        foreach ($post_votes as $v) {
            if ($v->vote_type == 'UP') {
                $votes += $v->count;
            } else {
                $votes -= $v->count;
            }
        }

        $post->vote_count = $votes;
        $post->save();
    }
}
