<?php

namespace App\Listeners;

use App\Events\PostCommented;
use App\Events\PostVoted;
use App\Models\Notification;
use App\Models\PostVote;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UserNotificationManager
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
    public function handle(PostCommented|PostVoted $event): void
    {
        $content = null;
        $user = null;

        if ($event instanceof PostCommented) {
            $comment = $event->comment;
            $user = $comment->user()->first();
            $post = $comment->post()->first();

            $content = $post->title . " commented by " . $user->username;
        } else if ($event instanceof PostVoted) {
            $post = $event->post;
            $byUser = $event->votedBy;
            $action = $event->voteAction;
            $user = $post->user()->first();

            if ($action == PostVote::VOTE_ACTION_UP) {
                $content = $post->title . " voted up by " . $byUser->username;
            } else if ($action == PostVote::VOTE_ACTION_DOWN) {
                $content = $post->title . " voted down by " . $byUser->username;
            } else {
                $content = null;
            }
        }


        if ($user && $content) {
            $notification = new Notification([
                'user_id' => $user->id,
                'content' => $content
            ]);
            $notification->save();
        }

    }
}
