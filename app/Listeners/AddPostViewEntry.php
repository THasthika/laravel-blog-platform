<?php

namespace App\Listeners;

use App\Events\PostViewed;
use App\Models\Post;
use App\Models\PostView;
use Illuminate\Support\Facades\Log;

class AddPostViewEntry
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
    public function handle(PostViewed $event): void
    {
        $post = $event->post;
        $request = $event->request;

        $postViewEntry = new PostView([
            'post_id' => $post->id,
            'client_ip' => $request->ip()
        ]);

        $postViewEntry->save();
    }
}
