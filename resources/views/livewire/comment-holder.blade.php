<div class="mt-3">
    <div>Comments</div>
    <hr/>
    @if (Auth::user())
    <div class="mt-2">
        <form wire:submit.prevent="post_comment">
            <textarea class="textarea textarea-bordered w-full" placeholder="Write a comment..." wire:model.debounce.500ms="new_comment"></textarea>
            <button type="submit" class="btn btn-sm btn-secondary">Post Comment</button>
        </form>
    </div>
    @endif
    <div>
        @if(sizeof($comments) > 0)
            @foreach($comments as $comment)
                <div class="border my-2 p-2">
                    <div class="flex">
                        <div class="flex-1">
                            {{$comment->content}}
                        </div>
                        @if(Auth::user() && $comment->user_id == Auth::user()->id)
                            <div>
                                <button class="btn btn-sm btn-ghost text-error" wire:click="triggerDeleteComment('{{$comment->id}}')">
                                    <x-icon-trash/>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="">{{$comment->user->username}}</div>
                        <div class="">{{$comment->created_at->diffForHumans()}}</div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="border my-2 p-2 text-center font-bold">
                <div>Be the first one to comment on this post!</div>
            </div>
        @endif
    </div>
    <div>{{$comments->links()}}</div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
        @this.on('triggerCommentDelete', comment_id => {
            Swal.fire({
                title: 'Are You Sure?',
                html: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.value) {
                @this.call('deleteComment', comment_id);
                }
            });
        });
        })
    </script>
</div>
