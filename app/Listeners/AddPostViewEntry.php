<?php

namespace App\Listeners;

use App\Events\PostViewed;
use App\Models\Post;
use App\Models\PostView;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class AddPostViewEntry
{

    private int $MIN_TIME_DIFF = 30; // 30 seconds

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

        $ip = $request->ip();
        $post_id = $post->id;

        if (empty($ip)) {
            return;
        }

        $existingEntry = PostView::query()->where('post_id', $post_id)->where('client_ip', $ip)->orderBy('created_at', 'desc')->first();

        $shouldAdd = true;

        if ($existingEntry != null) {
            $now = new \DateTime('now');
            $e = new \DateTime($existingEntry->created_at);
            $diff = $now->getTimestamp() - $e->getTimestamp();
            if ($diff < $this->MIN_TIME_DIFF) {
                $shouldAdd = false;
            }
        }

        if ($shouldAdd) {
            $postViewEntry = new PostView([
                'post_id' => $post_id,
                'client_ip' => $ip,
                'created_at' => new \DateTime('now')
            ]);

            $postViewEntry->save();
        }
    }
}
